package id.co.polbeng.clinicsapp.ui.home

import android.content.Intent
import android.os.Bundle
import android.view.Menu
import android.view.MenuInflater
import android.view.MenuItem
import android.view.View
import android.widget.Toast
import androidx.activity.viewModels
import androidx.appcompat.app.AppCompatActivity
import androidx.core.view.isVisible
import androidx.lifecycle.lifecycleScope
import com.google.android.material.snackbar.Snackbar
import id.co.polbeng.clinicsapp.R
import id.co.polbeng.clinicsapp.data.local.preferences.UserPreferences
import id.co.polbeng.clinicsapp.databinding.ActivityHomeBinding
import id.co.polbeng.clinicsapp.ui.ViewModelFactory
import id.co.polbeng.clinicsapp.ui.about.AboutActivity
import id.co.polbeng.clinicsapp.ui.doctor.DoctorActivity
import id.co.polbeng.clinicsapp.ui.forms.FormsActivity
import id.co.polbeng.clinicsapp.ui.login.LoginActivity
import id.co.polbeng.clinicsapp.ui.patient.PatientActivity
import id.co.polbeng.clinicsapp.ui.queue.QueueActivity
import id.co.polbeng.clinicsapp.ui.settings.SettingsActivity
import id.co.polbeng.clinicsapp.utils.Result
import kotlinx.coroutines.launch

class HomeActivity : AppCompatActivity(), View.OnClickListener {
    private lateinit var binding: ActivityHomeBinding

    private val viewModel: HomeViewModel by viewModels { ViewModelFactory(this) }

    private var isLoading: Boolean = false

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityHomeBinding.inflate(layoutInflater)
        setContentView(binding.root)

        setSupportActionBar(binding.toolbar)
        supportActionBar?.setDisplayShowTitleEnabled(false)

        binding.btnAbout.setOnClickListener(this)
        binding.btnDoctor.setOnClickListener(this)
        binding.btnPatient.setOnClickListener(this)
        binding.btnQueue.setOnClickListener(this)
        binding.btnForms.setOnClickListener(this)
    }

    override fun onClick(p0: View?) {
        when (p0?.id) {
            R.id.btn_about -> {
                val aboutActivity = Intent(this, AboutActivity::class.java)
                startActivity(aboutActivity)
            }
            R.id.btn_doctor -> {
                val doctorActivity = Intent(this, DoctorActivity::class.java)
                startActivity(doctorActivity)
            }
            R.id.btn_patient -> {
                val patientActivity = Intent(this, PatientActivity::class.java)
                startActivity(patientActivity)
            }
            R.id.btn_queue -> {
                val queueActivity = Intent(this, QueueActivity::class.java)
                startActivity(queueActivity)
            }
            R.id.btn_forms -> {
                val formsActivity = Intent(this, FormsActivity::class.java)
                startActivity(formsActivity)
            }
        }
    }

    override fun onCreateOptionsMenu(menu: Menu?): Boolean {
        val inflater: MenuInflater = menuInflater
        inflater.inflate(R.menu.menu_home, menu)
        return true
    }

    override fun onPrepareOptionsMenu(menu: Menu?): Boolean {
        menu?.findItem(R.id.logout)?.isEnabled = !isLoading

        return super.onPrepareOptionsMenu(menu)
    }

    override fun onOptionsItemSelected(item: MenuItem): Boolean {
        return when (item.itemId) {
            R.id.settings -> {
                val settingsActivity = Intent(this, SettingsActivity::class.java)
                startActivity(settingsActivity)
                true
            }
            R.id.logout -> {
                val preferences = UserPreferences(this)
                val user = preferences.getUser()

                lifecycleScope.launch {
                    viewModel.logout(user.token).collect { result ->
                        when (result) {
                            is Result.Loading -> {
                                isLoading = true
                                binding.progressBar.isVisible = true
                            }
                            is Result.Success -> {
                                isLoading = false
                                binding.progressBar.isVisible = false

                                preferences.removeUser()

                                Toast.makeText(
                                    this@HomeActivity,
                                    resources.getString(R.string.successful_logout_message),
                                    Toast.LENGTH_SHORT
                                ).show()

                                val loginActivity =
                                    Intent(this@HomeActivity, LoginActivity::class.java)
                                startActivity(loginActivity)
                                finish()
                            }
                            is Result.Error -> {
                                isLoading = false
                                binding.progressBar.isVisible = false

                                Snackbar.make(
                                    binding.root,
                                    result.message,
                                    Snackbar.LENGTH_INDEFINITE
                                ).setAction("OK") {}.show()
                            }
                        }
                    }
                }

                true
            }
            else -> super.onOptionsItemSelected(item)
        }
    }
}