package id.co.polbeng.clinicsapp.ui.reset

import android.content.Intent
import android.net.Uri
import android.os.Bundle
import android.view.View
import android.widget.Toast
import androidx.activity.viewModels
import androidx.appcompat.app.AppCompatActivity
import androidx.core.view.isVisible
import androidx.lifecycle.lifecycleScope
import com.google.android.material.snackbar.Snackbar
import com.wajahatkarim3.easyvalidation.core.view_ktx.validator
import id.co.polbeng.clinicsapp.R
import id.co.polbeng.clinicsapp.data.local.preferences.UserPreferences
import id.co.polbeng.clinicsapp.data.model.User
import id.co.polbeng.clinicsapp.data.remote.response.ErrorItemResponse
import id.co.polbeng.clinicsapp.databinding.ActivityResetBinding
import id.co.polbeng.clinicsapp.ui.ViewModelFactory
import id.co.polbeng.clinicsapp.ui.home.HomeActivity
import id.co.polbeng.clinicsapp.utils.Result
import id.co.polbeng.clinicsapp.utils.rule.ApiRule
import kotlinx.coroutines.launch

class ResetActivity : AppCompatActivity(), View.OnClickListener {
    private lateinit var binding: ActivityResetBinding

    private val viewModel: ResetViewModel by viewModels { ViewModelFactory(this) }

    private var token: String? = null

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityResetBinding.inflate(layoutInflater)
        setContentView(binding.root)

        setSupportActionBar(binding.toolbar)

        val action: String? = intent?.action
        val data: Uri? = intent?.data

        token = data?.getQueryParameter("token")

        binding.btnReset.setOnClickListener(this)
    }

    override fun onClick(p0: View?) {
        when (p0?.id) {
            R.id.btn_reset -> {
                if (validateFields()) {
                    val email = binding.edtEmail.text.toString().trim()
                    val password = binding.edtPassword.text.toString().trim()
                    val passwordConfirmation =
                        binding.edtPasswordConfirmation.text.toString().trim()

                    lifecycleScope.launch {
                        viewModel.resetPassword(
                            token,
                            email,
                            password,
                            passwordConfirmation
                        ).collect { result ->
                            when (result) {
                                is Result.Loading -> {
                                    binding.btnReset.isEnabled = false
                                    binding.progressBar.isVisible = true
                                }
                                is Result.Success -> {
                                    binding.btnReset.isEnabled = true
                                    binding.progressBar.isVisible = false

                                    val user = User(
                                        id = result.data.user.id,
                                        name = result.data.user.name,
                                        email = result.data.user.email,
                                        phoneNumber = result.data.user.phoneNumber,
                                        avatar = result.data.user.avatar,
                                        token = result.data.token
                                    )
                                    val preferences = UserPreferences(this@ResetActivity)
                                    preferences.setUser(user)

                                    binding.edtEmail.text?.clear()
                                    binding.edtPassword.text?.clear()
                                    binding.edtPasswordConfirmation.text?.clear()

                                    Toast.makeText(
                                        this@ResetActivity,
                                        resources.getString(R.string.successful_reset_message),
                                        Toast.LENGTH_SHORT
                                    ).show()

                                    val homeActivity =
                                        Intent(this@ResetActivity, HomeActivity::class.java)
                                    startActivity(homeActivity)
                                    finish()
                                }
                                is Result.Error -> {
                                    binding.btnReset.isEnabled = true
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
        val isEmailValid = binding.edtEmail.validator()
            .nonEmpty()
            .validEmail()
            .addRule(ApiRule(errors?.email))
            .addErrorCallback { binding.lytEmail.error = it }
            .addSuccessCallback { binding.lytEmail.isErrorEnabled = false }
            .check()

        val isPasswordValid = binding.edtPassword.validator()
            .nonEmpty()
            .minLength(8)
            .maxLength(70)
            .addRule(ApiRule(errors?.password))
            .addErrorCallback { binding.lytPassword.error = it }
            .addSuccessCallback { binding.lytPassword.isErrorEnabled = false }
            .check()

        val isPasswordConfirmationValid = binding.edtPasswordConfirmation.validator()
            .textEqualTo(binding.edtPassword.text.toString())
            .addRule(ApiRule(errors?.passwordConfirmation))
            .addErrorCallback { binding.lytPasswordConfirmation.error = it }
            .addSuccessCallback { binding.lytPasswordConfirmation.isErrorEnabled = false }
            .check()

        return isEmailValid && isPasswordValid && isPasswordConfirmationValid
    }

    override fun onSupportNavigateUp(): Boolean {
        onBackPressed()
        return true
    }
}
