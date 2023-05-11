package id.co.polbeng.clinicsapp.ui.preference

import android.content.Intent
import android.content.SharedPreferences
import android.os.Bundle
import android.provider.Settings
import androidx.appcompat.app.AppCompatDelegate
import androidx.preference.Preference
import androidx.preference.PreferenceFragmentCompat
import androidx.preference.SwitchPreference
import id.co.polbeng.clinicsapp.R
import id.co.polbeng.clinicsapp.ui.change.ChangeActivity
import id.co.polbeng.clinicsapp.ui.profile.ProfileActivity

class PreferenceFragment : PreferenceFragmentCompat(),
    SharedPreferences.OnSharedPreferenceChangeListener {
    private lateinit var EDIT_PROFILE: String
    private lateinit var CHANGE_PASSWORD: String
    private lateinit var THEME: String
    private lateinit var NOTIFICATIONS: String
    private lateinit var LOCALE: String

    private lateinit var themePreference: SwitchPreference
    private lateinit var notificationPreference: SwitchPreference

    override fun onCreatePreferences(savedInstanceState: Bundle?, rootKey: String?) {
        addPreferencesFromResource(R.xml.preferences)
        init()
        setSummaries()
    }

    private fun init() {
        EDIT_PROFILE = resources.getString(R.string.key_edit_profile)
        CHANGE_PASSWORD = resources.getString(R.string.key_change_password)
        THEME = resources.getString(R.string.key_theme)
        NOTIFICATIONS = resources.getString(R.string.key_notifications)
        LOCALE = resources.getString(R.string.key_locale)

        themePreference = findPreference<SwitchPreference>(THEME) as SwitchPreference
        notificationPreference = findPreference<SwitchPreference>(NOTIFICATIONS) as SwitchPreference
    }

    override fun onResume() {
        super.onResume()
        preferenceScreen.sharedPreferences.registerOnSharedPreferenceChangeListener(this)
    }

    override fun onPause() {
        super.onPause()
        preferenceScreen.sharedPreferences.unregisterOnSharedPreferenceChangeListener(this)
    }

    override fun onSharedPreferenceChanged(sharedPreferences: SharedPreferences, key: String) {
        if (key == THEME) {
            if (sharedPreferences.getBoolean(THEME, false)) {
                AppCompatDelegate.setDefaultNightMode(AppCompatDelegate.MODE_NIGHT_YES)
                themePreference.isChecked = true
            } else {
                AppCompatDelegate.setDefaultNightMode(AppCompatDelegate.MODE_NIGHT_NO)
                themePreference.isChecked = false
            }
        }

        if (key == NOTIFICATIONS) {
            notificationPreference.isChecked = sharedPreferences.getBoolean(NOTIFICATIONS, true)
        }
    }

    override fun onPreferenceTreeClick(preference: Preference?): Boolean {
        return when (preference?.key) {
            EDIT_PROFILE -> {
                val profileActivity = Intent(requireActivity(), ProfileActivity::class.java)
                startActivity(profileActivity)
                true
            }
            CHANGE_PASSWORD -> {
                val changeActivity = Intent(requireActivity(), ChangeActivity::class.java)
                startActivity(changeActivity)
                true
            }
            LOCALE -> {
                val localeSettings = Intent(Settings.ACTION_LOCALE_SETTINGS)
                startActivity(localeSettings)
                true
            }
            else -> super.onPreferenceTreeClick(preference)
        }
    }

    private fun setSummaries() {
        val sharedPreferences = preferenceManager.sharedPreferences
        themePreference.isChecked = sharedPreferences.getBoolean(THEME, false)
        notificationPreference.isChecked = sharedPreferences.getBoolean(NOTIFICATIONS, true)
    }
}