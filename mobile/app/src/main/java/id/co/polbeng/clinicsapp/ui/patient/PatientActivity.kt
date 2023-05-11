package id.co.polbeng.clinicsapp.ui.patient

import android.content.Intent
import android.os.Bundle
import android.view.View
import android.widget.ArrayAdapter
import android.widget.Toast
import androidx.activity.viewModels
import androidx.appcompat.app.AppCompatActivity
import androidx.core.view.isVisible
import androidx.lifecycle.Observer
import androidx.lifecycle.lifecycleScope
import com.google.android.material.snackbar.Snackbar
import com.wajahatkarim3.easyvalidation.core.view_ktx.validator
import id.co.polbeng.clinicsapp.R
import id.co.polbeng.clinicsapp.data.local.preferences.UserPreferences
import id.co.polbeng.clinicsapp.data.model.Specialist
import id.co.polbeng.clinicsapp.data.model.Status
import id.co.polbeng.clinicsapp.data.model.Type
import id.co.polbeng.clinicsapp.data.model.User
import id.co.polbeng.clinicsapp.data.remote.response.DoctorItemResponse
import id.co.polbeng.clinicsapp.data.remote.response.ErrorItemResponse
import id.co.polbeng.clinicsapp.databinding.ActivityPatientBinding
import id.co.polbeng.clinicsapp.ui.ViewModelFactory
import id.co.polbeng.clinicsapp.ui.queue.QueueActivity
import id.co.polbeng.clinicsapp.utils.Result
import id.co.polbeng.clinicsapp.utils.rule.ApiRule
import id.co.polbeng.clinicsapp.utils.rule.DateFormatRule
import kotlinx.coroutines.launch

class PatientActivity : AppCompatActivity(), View.OnClickListener {
    private lateinit var binding: ActivityPatientBinding
    private lateinit var user: User

    private var typeValue: String? = null
    private var statusValue: String? = null
    private var specialistValue: String? = null

    private val viewModel: PatientViewModel by viewModels { ViewModelFactory(this) }

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityPatientBinding.inflate(layoutInflater)
        setContentView(binding.root)

        setSupportActionBar(binding.toolbar)

        val preferences = UserPreferences(this)
        user = preferences.getUser()

        val typeList = listOf<Type>(
            Type(resources.getString(R.string.label_general), GENERAL),
            Type(resources.getString(R.string.label_jkn), JKN)
        )
        val patientsAdapter = ArrayAdapter(this, R.layout.item_dropdown, typeList.map { it.text })
        binding.edtType.setAdapter(patientsAdapter)
        binding.edtType.setOnItemClickListener { _, _, position, _ ->
            typeValue = typeList[position].value
        }

        val statusList = listOf<Status>(
            Status(resources.getString(R.string.label_married), MARRIED),
            Status(resources.getString(R.string.label_single), SINGLE)
        )
        val statusAdapter = ArrayAdapter(this, R.layout.item_dropdown, statusList.map { it.text })
        binding.edtStatus.setAdapter(statusAdapter)
        binding.edtStatus.setOnItemClickListener { _, _, position, _ ->
            statusValue = statusList[position].value
        }

        val bundle = intent.extras
        if (bundle != null) {
            val specialistExtra =
                bundle.getParcelable<DoctorItemResponse>(EXTRA_SPECIALIST) as DoctorItemResponse
            binding.edtSpecialist.setText(specialistExtra.specialist, false)
            specialistValue = specialistExtra.id
        }

        if (savedInstanceState == null) {
            viewModel.getAllDoctors(user.token)
        }

        viewModel.doctors.observe(this, Observer { result ->
            when (result) {
                is Result.Loading -> {
                    binding.edtSpecialist.isEnabled = false
                    binding.progressBar.isVisible = true
                }
                is Result.Success -> {
                    binding.edtSpecialist.isEnabled = true
                    binding.progressBar.isVisible = false

                    val specialist = result.data.doctor.map { Specialist(it.id, it.specialist) }
                    val specialistAdapter =
                        ArrayAdapter(this, R.layout.item_dropdown, specialist.map { it.specialist })
                    specialistAdapter.notifyDataSetChanged()
                    binding.edtSpecialist.setAdapter(specialistAdapter)
                    binding.edtSpecialist.setOnItemClickListener { _, _, position, _ ->
                        specialistValue = specialist[position].id
                    }
                }
                is Result.Error -> {
                    binding.edtSpecialist.isEnabled = true
                    binding.progressBar.isVisible = false

                    Snackbar.make(
                        binding.root,
                        result.message,
                        Snackbar.LENGTH_INDEFINITE
                    ).setAction("OK") {}.show()
                }
            }
        })

        binding.btnRegistration.setOnClickListener(this)
    }

    override fun onClick(p0: View?) {
        when (p0?.id) {
            R.id.btn_registration -> {
                if (validateFields()) {
                    val name = binding.edtName.text.toString().trim()
                    val dateOfBirth = binding.edtDateOfBirth.text.toString().trim()
                    val address = binding.edtAddress.text.toString().trim()
                    val type = typeValue.toString().trim()
                    val allergy = binding.edtAllergy.text.toString().trim()
                    val status = statusValue.toString().trim()
                    val gender =
                        if (binding.rgGender.checkedRadioButtonId == R.id.rb_male) MALE else FEMALE
                    val specialist = specialistValue.toString().trim()

                    lifecycleScope.launch {
                        viewModel.storePatientRegistration(
                            user.token,
                            name,
                            dateOfBirth,
                            address,
                            type,
                            allergy,
                            status,
                            gender,
                            specialist
                        ).collect { result ->
                            when (result) {
                                is Result.Loading -> {
                                    binding.btnRegistration.isEnabled = false
                                    binding.progressBar.isVisible = true
                                }
                                is Result.Success -> {
                                    binding.btnRegistration.isEnabled = true
                                    binding.progressBar.isVisible = false

                                    binding.edtName.text?.clear()
                                    binding.edtDateOfBirth.text?.clear()
                                    binding.edtAddress.text?.clear()
                                    binding.edtType.setSelection(0)
                                    binding.edtAllergy.text?.clear()
                                    binding.edtStatus.setSelection(0)
                                    binding.rgGender.check(R.id.rb_male)
                                    binding.edtSpecialist.text?.clear()

                                    Toast.makeText(
                                        this@PatientActivity,
                                        resources.getString(R.string.successful_registration_message),
                                        Toast.LENGTH_SHORT
                                    ).show()

                                    val queueActivity =
                                        Intent(this@PatientActivity, QueueActivity::class.java)
                                    startActivity(queueActivity)
                                    finish()
                                }
                                is Result.Error -> {
                                    binding.btnRegistration.isEnabled = true
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

    private fun validateFields(errors: ErrorItemResponse? = null): Boolean {
        val isNameValid = binding.edtName.validator()
            .nonEmpty()
            .minLength(3)
            .maxLength(70)
            .addRule(ApiRule(errors?.name))
            .addErrorCallback { binding.lytName.error = it }
            .addSuccessCallback { binding.lytName.isErrorEnabled = false }
            .check()

        val isDateOfBirthValid = binding.edtDateOfBirth.validator()
            .nonEmpty()
            .addRule(DateFormatRule())
            .addRule(ApiRule(errors?.dateOfBirth))
            .addErrorCallback { binding.lytDateOfBirth.error = it }
            .addSuccessCallback { binding.lytDateOfBirth.isErrorEnabled = false }
            .check()

        val isAddressValid = binding.edtAddress.validator()
            .nonEmpty()
            .regex("^[a-zA-Z0-9 .,/-]*$")
            .addRule(ApiRule(errors?.address))
            .addErrorCallback { binding.lytAddress.error = it }
            .addSuccessCallback { binding.lytAddress.isErrorEnabled = false }
            .check()

        val isTypeValid = binding.edtType.validator()
            .nonEmpty()
            .addRule(ApiRule(errors?.patient))
            .addErrorCallback { binding.lytType.error = it }
            .addSuccessCallback { binding.lytType.isErrorEnabled = false }
            .check()

        val isAllergyValid = binding.edtAllergy.validator()
            .nonEmpty()
            .minLength(3)
            .maxLength(70)
            .addRule(ApiRule(errors?.allergy))
            .addErrorCallback { binding.lytAllergy.error = it }
            .addSuccessCallback { binding.lytAllergy.isErrorEnabled = false }
            .check()

        val isStatusValid = binding.edtStatus.validator()
            .nonEmpty()
            .addRule(ApiRule(errors?.status))
            .addErrorCallback { binding.lytStatus.error = it }
            .addSuccessCallback { binding.lytStatus.isErrorEnabled = false }
            .check()

        val isSpecialistValid = binding.edtSpecialist.validator()
            .nonEmpty()
            .minLength(3)
            .maxLength(70)
            .addRule(ApiRule(errors?.doctorId))
            .addErrorCallback { binding.lytSpecialist.error = it }
            .addSuccessCallback { binding.lytSpecialist.isErrorEnabled = false }
            .check()

        return isNameValid && isDateOfBirthValid && isAddressValid && isTypeValid && isAllergyValid && isStatusValid && isSpecialistValid
    }

    override fun onSupportNavigateUp(): Boolean {
        onBackPressed()
        return true
    }

    companion object {
        private const val MARRIED = "Married"
        private const val SINGLE = "Single"
        private const val GENERAL = "General"
        private const val JKN = "JKN"
        private const val MALE = "Male"
        private const val FEMALE = "Female"

        const val EXTRA_SPECIALIST = "extra_specialist"
    }
}