package id.co.polbeng.clinicsapp.ui.forgot

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
import id.co.polbeng.clinicsapp.data.remote.response.ErrorItemResponse
import id.co.polbeng.clinicsapp.databinding.ActivityForgotBinding
import id.co.polbeng.clinicsapp.ui.ViewModelFactory
import id.co.polbeng.clinicsapp.utils.Result
import id.co.polbeng.clinicsapp.utils.rule.ApiRule
import kotlinx.coroutines.launch

class ForgotActivity : AppCompatActivity(), View.OnClickListener {
    private lateinit var binding: ActivityForgotBinding

    private val viewModel: ForgotViewModel by viewModels { ViewModelFactory(this) }

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityForgotBinding.inflate(layoutInflater)
        setContentView(binding.root)

        setSupportActionBar(binding.toolbar)

        binding.btnForgot.setOnClickListener(this)
    }

    override fun onClick(p0: View?) {
        when (p0?.id) {
            R.id.btn_forgot -> {
                if (validateFields()) {
                    val email = binding.edtEmail.text.toString().trim()

                    lifecycleScope.launch {
                        viewModel.forgotPassword(email).collect { result ->
                            when (result) {
                                is Result.Loading -> {
                                    binding.btnForgot.isEnabled = false
                                    binding.progressBar.isVisible = true
                                }
                                is Result.Success -> {
                                    binding.btnForgot.isEnabled = true
                                    binding.progressBar.isVisible = false

                                    binding.edtEmail.text?.clear()

                                    Toast.makeText(
                                        this@ForgotActivity,
                                        resources.getString(R.string.successful_forgot_message),
                                        Toast.LENGTH_SHORT
                                    ).show()
                                }
                                is Result.Error -> {
                                    binding.btnForgot.isEnabled = true
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

        return isEmailValid
    }

    override fun onSupportNavigateUp(): Boolean {
        onBackPressed()
        return true
    }
}