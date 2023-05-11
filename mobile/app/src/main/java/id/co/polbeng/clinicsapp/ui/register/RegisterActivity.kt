package id.co.polbeng.clinicsapp.ui.register

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
import id.co.polbeng.clinicsapp.databinding.ActivityRegisterBinding
import id.co.polbeng.clinicsapp.ui.ViewModelFactory
import id.co.polbeng.clinicsapp.ui.home.HomeActivity
import id.co.polbeng.clinicsapp.utils.Result
import id.co.polbeng.clinicsapp.utils.rule.ApiRule
import kotlinx.coroutines.launch

class RegisterActivity : AppCompatActivity(), View.OnClickListener {
    private lateinit var binding: ActivityRegisterBinding

    private val viewModel: RegisterViewModel by viewModels { ViewModelFactory(this) }

    private val serviceScreen = object : ClickableSpan() {
        override fun onClick(p0: View) {
            Toast.makeText(
                this@RegisterActivity,
                "Term of Service",
                Toast.LENGTH_SHORT
            ).show()
        }
    }

    private val policyScreen = object : ClickableSpan() {
        override fun onClick(p0: View) {
            Toast.makeText(
                this@RegisterActivity,
                "Privacy Policy",
                Toast.LENGTH_SHORT
            ).show()
        }
    }

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityRegisterBinding.inflate(layoutInflater)
        setContentView(binding.root)

        setSupportActionBar(binding.toolbar)

        binding.cbxCondition.setOnCheckedChangeListener { _, isChecked ->
            binding.btnRegister.isEnabled = isChecked
        }

        val conditionText = getText(R.string.service_and_policy) as SpannedString
        val conditionAnnotations = conditionText.getSpans(
            0,
            conditionText.length,
            Annotation::class.java
        )
        val conditionSpannable = SpannableString(conditionText)

        for (annotation in conditionAnnotations) {
            if (annotation.key == ANNOTATION_KEY) {
                val fontName = annotation.value
                if (fontName == ANNOTATION_SERVICE) {
                    conditionSpannable.setSpan(
                        serviceScreen,
                        conditionText.getSpanStart(annotation),
                        conditionText.getSpanEnd(annotation),
                        Spannable.SPAN_EXCLUSIVE_EXCLUSIVE
                    )
                } else if (fontName == ANNOTATION_POLICY) {
                    conditionSpannable.setSpan(
                        policyScreen,
                        conditionText.getSpanStart(annotation),
                        conditionText.getSpanEnd(annotation),
                        Spannable.SPAN_EXCLUSIVE_EXCLUSIVE
                    )
                }
            }
        }
        binding.tvCondition.text = conditionSpannable
        binding.tvCondition.movementMethod = LinkMovementMethod.getInstance()

        binding.btnRegister.setOnClickListener(this)
    }

    override fun onClick(p0: View?) {
        when (p0?.id) {
            R.id.btn_register -> {
                if (validateFields()) {
                    val name = binding.edtName.text.toString().trim()
                    val email = binding.edtEmail.text.toString().trim()
                    val password = binding.edtPassword.text.toString().trim()
                    val passwordConfirmation =
                        binding.edtPasswordConfirmation.text.toString().trim()

                    lifecycleScope.launch {
                        viewModel.register(
                            name,
                            email,
                            password,
                            passwordConfirmation
                        ).collect { result ->
                            when (result) {
                                is Result.Loading -> {
                                    binding.btnRegister.isEnabled = false
                                    binding.progressBar.isVisible = true
                                }
                                is Result.Success -> {
                                    binding.btnRegister.isEnabled = true
                                    binding.progressBar.isVisible = false

                                    val user = User(
                                        id = result.data.user.id,
                                        name = result.data.user.name,
                                        email = result.data.user.email,
                                        phoneNumber = result.data.user.phoneNumber,
                                        avatar = result.data.user.avatar,
                                        token = result.data.token
                                    )
                                    val preferences = UserPreferences(this@RegisterActivity)
                                    preferences.setUser(user)

                                    binding.edtName.text?.clear()
                                    binding.edtEmail.text?.clear()
                                    binding.edtPassword.text?.clear()
                                    binding.edtPasswordConfirmation.text?.clear()

                                    Toast.makeText(
                                        this@RegisterActivity,
                                        resources.getString(R.string.successful_register_message),
                                        Toast.LENGTH_SHORT
                                    ).show()

                                    val homeActivity =
                                        Intent(this@RegisterActivity, HomeActivity::class.java)
                                    startActivity(homeActivity)
                                    finish()
                                }
                                is Result.Error -> {
                                    binding.btnRegister.isEnabled = true
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

        return isNameValid && isEmailValid && isPasswordValid && isPasswordConfirmationValid
    }

    override fun onSupportNavigateUp(): Boolean {
        onBackPressed()
        return true
    }

    companion object {
        private const val ANNOTATION_KEY = "link"
        private const val ANNOTATION_SERVICE = "service"
        private const val ANNOTATION_POLICY = "policy"
    }
}