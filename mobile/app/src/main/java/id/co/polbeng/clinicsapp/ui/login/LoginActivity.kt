package id.co.polbeng.clinicsapp.ui.login

import android.content.Intent
import android.os.Bundle
import android.text.Annotation
import android.text.Spannable
import android.text.SpannableString
import android.text.SpannedString
import android.text.method.LinkMovementMethod
import android.text.style.ClickableSpan
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
import id.co.polbeng.clinicsapp.databinding.ActivityLoginBinding
import id.co.polbeng.clinicsapp.ui.ViewModelFactory
import id.co.polbeng.clinicsapp.ui.forgot.ForgotActivity
import id.co.polbeng.clinicsapp.ui.home.HomeActivity
import id.co.polbeng.clinicsapp.ui.register.RegisterActivity
import id.co.polbeng.clinicsapp.utils.Result
import id.co.polbeng.clinicsapp.utils.rule.ApiRule
import kotlinx.coroutines.launch

class LoginActivity : AppCompatActivity(), View.OnClickListener {
    private lateinit var binding: ActivityLoginBinding

    private val viewModel: LoginViewModel by viewModels { ViewModelFactory(this) }

    private val registerScreen = object : ClickableSpan() {
        override fun onClick(p0: View) {
            val registerActivity = Intent(this@LoginActivity, RegisterActivity::class.java)
            startActivity(registerActivity)
        }
    }

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityLoginBinding.inflate(layoutInflater)
        setContentView(binding.root)

        binding.tvForgot.setOnClickListener(this)
        binding.btnLogin.setOnClickListener(this)

        val registerText = getText(R.string.have_not_an_account) as SpannedString
        val registerAnnotations = registerText.getSpans(
            0,
            registerText.length,
            Annotation::class.java
        )
        val registerSpannable = SpannableString(registerText)

        for (annotation in registerAnnotations) {
            if (annotation.key == ANNOTATION_KEY) {
                val fontName = annotation.value
                if (fontName == ANNOTATION_REGISTER) {
                    registerSpannable.setSpan(
                        registerScreen,
                        registerText.getSpanStart(annotation),
                        registerText.getSpanEnd(annotation),
                        Spannable.SPAN_EXCLUSIVE_EXCLUSIVE
                    )
                }
            }
        }
        binding.tvRegister.text = registerSpannable
        binding.tvRegister.movementMethod = LinkMovementMethod.getInstance()
    }

    override fun onClick(p0: View?) {
        when (p0?.id) {
            R.id.tv_forgot -> {
                val forgotActivity = Intent(this, ForgotActivity::class.java)
                startActivity(forgotActivity)
            }
            R.id.btn_login -> {
                if (validateFields()) {
                    val email = binding.edtEmail.text.toString().trim()
                    val password = binding.edtPassword.text.toString().trim()

                    lifecycleScope.launch {
                        viewModel.login(
                            email,
                            password
                        ).collect { result ->
                            when (result) {
                                is Result.Loading -> {
                                    binding.btnLogin.isEnabled = false
                                    binding.progressBar.isVisible = true
                                }
                                is Result.Success -> {
                                    binding.btnLogin.isEnabled = true
                                    binding.progressBar.isVisible = false

                                    val user = User(
                                        id = result.data.user.id,
                                        name = result.data.user.name,
                                        email = result.data.user.email,
                                        phoneNumber = result.data.user.phoneNumber,
                                        avatar = result.data.user.avatar,
                                        token = result.data.token
                                    )
                                    val preferences = UserPreferences(this@LoginActivity)
                                    preferences.setUser(user)

                                    binding.edtEmail.text?.clear()
                                    binding.edtPassword.text?.clear()

                                    Toast.makeText(
                                        this@LoginActivity,
                                        resources.getString(R.string.successful_login_message),
                                        Toast.LENGTH_SHORT
                                    ).show()

                                    val homeActivity =
                                        Intent(this@LoginActivity, HomeActivity::class.java)
                                    startActivity(homeActivity)
                                    finish()
                                }
                                is Result.Error -> {
                                    binding.btnLogin.isEnabled = true
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

        return isEmailValid && isPasswordValid
    }

    companion object {
        private const val ANNOTATION_KEY = "link"
        private const val ANNOTATION_REGISTER = "register"
    }
}