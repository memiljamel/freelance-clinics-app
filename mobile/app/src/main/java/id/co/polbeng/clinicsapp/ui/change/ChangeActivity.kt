package id.co.polbeng.clinicsapp.ui.change

import android.content.Intent
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
import id.co.polbeng.clinicsapp.data.remote.response.ErrorItemResponse
import id.co.polbeng.clinicsapp.databinding.ActivityChangeBinding
import id.co.polbeng.clinicsapp.ui.ViewModelFactory
import id.co.polbeng.clinicsapp.ui.login.LoginActivity
import id.co.polbeng.clinicsapp.utils.Result
import id.co.polbeng.clinicsapp.utils.rule.ApiRule
import kotlinx.coroutines.launch

class ChangeActivity : AppCompatActivity(), View.OnClickListener {
    private lateinit var binding: ActivityChangeBinding

    private val viewModel: ChangeViewModel by viewModels { ViewModelFactory(this) }

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityChangeBinding.inflate(layoutInflater)
        setContentView(binding.root)

        setSupportActionBar(binding.toolbar)

        binding.btnChange.setOnClickListener(this)
    }

    override fun onClick(p0: View?) {
        when (p0?.id) {
            R.id.btn_change -> {
                if (validateFields()) {
                    val currentPassword = binding.edtCurrentPassword.text.toString().trim()
                    val password = binding.edtPassword.text.toString().trim()
                    val passwordConfirmation =
                        binding.edtPasswordConfirmation.text.toString().trim()

                    val preferences = UserPreferences(this)
                    val user = preferences.getUser()

                    lifecycleScope.launch {
                        viewModel.changePassword(
                            user.token,
                            user.id,
                            currentPassword,
                            password,
                            passwordConfirmation
                        ).collect { result ->
                            when (result) {
                                is Result.Loading -> {
                                    binding.btnChange.isEnabled = false
                                    binding.progressBar.isVisible = true
                                }
                                is Result.Success -> {
                                    binding.btnChange.isEnabled = true
                                    binding.progressBar.isVisible = false

                                    preferences.removeUser()

                                    binding.edtCurrentPassword.text?.clear()
                                    binding.edtPassword.text?.clear()
                                    binding.edtPasswordConfirmation.text?.clear()

                                    Toast.makeText(
                                        this@ChangeActivity,
                                        resources.getString(R.string.successful_change_message),
                                        Toast.LENGTH_SHORT
                                    ).show()

                                    val loginActivity =
                                        Intent(this@ChangeActivity, LoginActivity::class.java)
                                    startActivity(loginActivity)
                                    finish()
                                }
                                is Result.Error -> {
                                    binding.btnChange.isEnabled = true
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
        val isCurrentPasswordValid = binding.edtCurrentPassword.validator()
            .nonEmpty()
            .minLength(8)
            .maxLength(70)
            .addRule(ApiRule(errors?.currentPassword))
            .addErrorCallback { binding.lytCurrentPassword.error = it }
            .addSuccessCallback { binding.lytCurrentPassword.isErrorEnabled = false }
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

        return isCurrentPasswordValid && isPasswordValid && isPasswordConfirmationValid
    }

    override fun onSupportNavigateUp(): Boolean {
        onBackPressed()
        return true
    }
}