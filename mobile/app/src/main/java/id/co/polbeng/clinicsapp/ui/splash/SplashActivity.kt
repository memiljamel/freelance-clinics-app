package id.co.polbeng.clinicsapp.ui.splash

import android.annotation.SuppressLint
import android.content.Intent
import android.os.Bundle
import androidx.appcompat.app.AppCompatActivity
import androidx.appcompat.app.AppCompatDelegate
import androidx.core.splashscreen.SplashScreen.Companion.installSplashScreen
import androidx.preference.PreferenceManager
import id.co.polbeng.clinicsapp.R
import id.co.polbeng.clinicsapp.data.local.preferences.UserPreferences
import id.co.polbeng.clinicsapp.databinding.ActivitySplashBinding
import id.co.polbeng.clinicsapp.ui.home.HomeActivity
import id.co.polbeng.clinicsapp.ui.login.LoginActivity

@SuppressLint("CustomSplashScreen")
class SplashActivity : AppCompatActivity() {
    private lateinit var binding: ActivitySplashBinding
    private lateinit var THEME: String

    override fun onCreate(savedInstanceState: Bundle?) {
        val splashScreen = installSplashScreen()

        super.onCreate(savedInstanceState)
        binding = ActivitySplashBinding.inflate(layoutInflater)
        setContentView(binding.root)

        THEME = resources.getString(R.string.key_theme)
        setTheme()

        splashScreen.setKeepOnScreenCondition { true }
        checkCredentials()
    }

    private fun setTheme() {
        val preferenceManager = PreferenceManager.getDefaultSharedPreferences(this)

        if (preferenceManager.getBoolean(THEME, false)) {
            AppCompatDelegate.setDefaultNightMode(AppCompatDelegate.MODE_NIGHT_YES)
        } else {
            AppCompatDelegate.setDefaultNightMode(AppCompatDelegate.MODE_NIGHT_NO)
        }
    }

    private fun checkCredentials() {
        val preferences = UserPreferences(this)
        val user = preferences.getUser()

        if (user.token.isNullOrEmpty()) {
            val loginActivity = Intent(this, LoginActivity::class.java)
            startActivity(loginActivity)
            finish()
        } else {
            val homeActivity = Intent(this, HomeActivity::class.java)
            startActivity(homeActivity)
            finish()
        }
    }
}