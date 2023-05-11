package id.co.polbeng.clinicsapp.ui.profile

import android.Manifest
import android.content.Intent
import android.content.pm.PackageManager
import android.graphics.BitmapFactory
import android.net.Uri
import android.os.Bundle
import android.provider.MediaStore
import android.view.View
import android.widget.Toast
import androidx.activity.result.contract.ActivityResultContracts
import androidx.activity.viewModels
import androidx.appcompat.app.AlertDialog
import androidx.appcompat.app.AppCompatActivity
import androidx.core.app.ActivityCompat
import androidx.core.content.ContextCompat
import androidx.core.content.FileProvider
import androidx.core.view.isVisible
import androidx.lifecycle.lifecycleScope
import com.bumptech.glide.Glide
import com.bumptech.glide.request.RequestOptions
import com.google.android.material.snackbar.Snackbar
import com.wajahatkarim3.easyvalidation.core.view_ktx.validator
import id.co.polbeng.clinicsapp.R
import id.co.polbeng.clinicsapp.data.local.preferences.UserPreferences
import id.co.polbeng.clinicsapp.data.model.User
import id.co.polbeng.clinicsapp.data.remote.response.ErrorItemResponse
import id.co.polbeng.clinicsapp.databinding.ActivityProfileBinding
import id.co.polbeng.clinicsapp.ui.ViewModelFactory
import id.co.polbeng.clinicsapp.utils.*
import id.co.polbeng.clinicsapp.utils.rule.ApiRule
import kotlinx.coroutines.launch
import okhttp3.MediaType.Companion.toMediaType
import okhttp3.MediaType.Companion.toMediaTypeOrNull
import okhttp3.RequestBody
import okhttp3.RequestBody.Companion.asRequestBody
import okhttp3.RequestBody.Companion.toRequestBody
import java.io.File

class ProfileActivity : AppCompatActivity(), View.OnClickListener {
    private lateinit var binding: ActivityProfileBinding
    private lateinit var currentPhotoPath: String
    private lateinit var preferences: UserPreferences
    private lateinit var user: User

    private val viewModel: ProfileViewModel by viewModels { ViewModelFactory(this) }

    private var getFile: File? = null

    override fun onRequestPermissionsResult(
        requestCode: Int,
        permissions: Array<String>,
        grantResults: IntArray
    ) {
        super.onRequestPermissionsResult(requestCode, permissions, grantResults)
        if (requestCode == REQUEST_CODE_PERMISSIONS) {
            if (!allPermissionsGranted()) {
                Toast.makeText(
                    this,
                    "Tidak mendapatkan permission.",
                    Toast.LENGTH_SHORT
                ).show()
                finish()
            }
        }
    }

    private fun allPermissionsGranted() = REQUIRED_PERMISSIONS.all {
        ContextCompat.checkSelfPermission(baseContext, it) == PackageManager.PERMISSION_GRANTED
    }

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityProfileBinding.inflate(layoutInflater)
        setContentView(binding.root)

        setSupportActionBar(binding.toolbar)

        if (!allPermissionsGranted()) {
            ActivityCompat.requestPermissions(
                this,
                REQUIRED_PERMISSIONS,
                REQUEST_CODE_PERMISSIONS
            )
        }

        preferences = UserPreferences(this)
        user = preferences.getUser()

        Glide.with(this)
            .load(user.avatar)
            .apply(RequestOptions().override(120, 120))
            .into(binding.ivAvatar)
        binding.edtName.setText(user.name)
        binding.edtEmail.setText(user.email)
        binding.edtPhoneNumber.setText(user.phoneNumber)

        binding.ibChoose.setOnClickListener(this)
        binding.btnUpdate.setOnClickListener(this)
    }

    override fun onClick(p0: View?) {
        when (p0?.id) {
            R.id.ib_choose -> {
                AlertDialog.Builder(this)
                    .setTitle(resources.getString(R.string.select_source))
                    .setItems(resources.getStringArray(R.array.sources)) { _, which ->
                        when (which) {
                            0 -> resourceFromCamera()
                            1 -> resourceFromGallery()
                        }
                    }
                    .show()
            }
            R.id.btn_update -> {
                if (validateFields()) {
                    val name = binding.edtName.text.toString().trim()
                    val phoneNumber = binding.edtPhoneNumber.text.toString().trim()

                    val data: HashMap<String, RequestBody> = HashMap()
                    data["_method"] = "PATCH".toRequestBody("text/plain".toMediaType())
                    data["name"] = name.toRequestBody("text/plain".toMediaType())
                    data["phone_number"] = phoneNumber.toRequestBody("text/plain".toMediaType())

                    if (getFile != null) {
                        val file = reduceFileImage(getFile as File)
                        val requestImageFile = file.asRequestBody("image/jpeg".toMediaTypeOrNull())
                        data["avatar\"; filename=\"${file.name}\""] = requestImageFile
                    }

                    lifecycleScope.launch {
                        viewModel.updateUser(user.token, user.id, data).collect { result ->
                            when (result) {
                                is Result.Loading -> {
                                    binding.btnUpdate.isEnabled = false
                                    binding.progressBar.isVisible = true
                                }
                                is Result.Success -> {
                                    binding.btnUpdate.isEnabled = true
                                    binding.progressBar.isVisible = false

                                    val newUser = User(
                                        id = result.data.user.id,
                                        name = result.data.user.name,
                                        email = result.data.user.email,
                                        phoneNumber = result.data.user.phoneNumber,
                                        avatar = result.data.user.avatar,
                                        token = user.token
                                    )
                                    preferences.setUser(newUser)

                                    Toast.makeText(
                                        this@ProfileActivity,
                                        resources.getString(R.string.successful_profile_message),
                                        Toast.LENGTH_SHORT
                                    ).show()
                                }
                                is Result.Error -> {
                                    binding.btnUpdate.isEnabled = true
                                    binding.progressBar.isVisible = false

                                    if (result.code == 422) {
                                        validateFields(result.data?.errors)
                                    } else {
                                        Snackbar.make(
                                            binding.root,
                                            result.message,
                                            Snackbar.LENGTH_INDEFINITE
                                        ).setAction("OK") {}.show()
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    private fun resourceFromCamera() {
        val intent = Intent(MediaStore.ACTION_IMAGE_CAPTURE)
        intent.resolveActivity(packageManager)

        createCustomTempFile(application).also { file ->
            val photoURI: Uri = FileProvider.getUriForFile(
                this@ProfileActivity,
                "id.co.polbeng.clinicsapp",
                file
            )
            currentPhotoPath = file.absolutePath
            intent.putExtra(MediaStore.EXTRA_OUTPUT, photoURI)
            launcherIntentCamera.launch(intent)
        }
    }

    private val launcherIntentCamera = registerForActivityResult(
        ActivityResultContracts.StartActivityForResult()
    ) { result ->
        if (result.resultCode == RESULT_OK) {
            val myFile = File(currentPhotoPath)
            val myImage = rotateBitmap(
                BitmapFactory.decodeFile(myFile.path),
                true
            )

            getFile = myFile

            Glide.with(this)
                .load(myImage)
                .apply(RequestOptions().override(120, 120))
                .into(binding.ivAvatar)
        }
    }

    private fun resourceFromGallery() {
        val intent = Intent(Intent.ACTION_GET_CONTENT)
        intent.type = "image/*"
        val chooser = Intent.createChooser(intent, "Choose a Picture")
        launcherIntentGallery.launch(chooser)
    }

    private val launcherIntentGallery = registerForActivityResult(
        ActivityResultContracts.StartActivityForResult()
    ) { result ->
        if (result.resultCode == RESULT_OK) {
            val selectedImg: Uri = result.data?.data as Uri
            val myFile = uriToFile(selectedImg, this@ProfileActivity)

            getFile = myFile

            Glide.with(this)
                .load(selectedImg)
                .apply(RequestOptions().override(120, 120))
                .into(binding.ivAvatar)
        }
    }

    private fun validateFields(errors: ErrorItemResponse? = null): Boolean {
        val isNameValid = binding.edtName.validator()
            .nonEmpty()
            .minLength(3)
            .maxLength(70)
            .addRule(ApiRule(errors?.name))
            .addErrorCallback { binding.lytName.error = it }
            .addSuccessCallback { binding.lytName.isErrorEnabled = false }
            .check()

        val isPhoneNumberValid = binding.edtPhoneNumber.validator()
            .onlyNumbers()
            .minLength(11)
            .maxLength(14)
            .addRule(ApiRule(errors?.phoneNumber))
            .addErrorCallback { binding.lytPhoneNumber.error = it }
            .addSuccessCallback { binding.lytPhoneNumber.isErrorEnabled = false }
            .check()

        return isNameValid && isPhoneNumberValid
    }

    override fun onSupportNavigateUp(): Boolean {
        onBackPressed()
        return true
    }

    companion object {
        private val REQUIRED_PERMISSIONS = arrayOf(Manifest.permission.CAMERA)
        private const val REQUEST_CODE_PERMISSIONS = 10
    }
}