package id.co.polbeng.clinicsapp.ui.settings

import android.os.Bundle
import androidx.appcompat.app.AppCompatActivity
import androidx.fragment.app.commit
import id.co.polbeng.clinicsapp.R
import id.co.polbeng.clinicsapp.databinding.ActivitySettingsBinding
import id.co.polbeng.clinicsapp.ui.preference.PreferenceFragment

class SettingsActivity : AppCompatActivity() {
    private lateinit var binding: ActivitySettingsBinding

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivitySettingsBinding.inflate(layoutInflater)
        setContentView(binding.root)

        setSupportActionBar(binding.toolbar)

        val fragmentManager = supportFragmentManager
        val preferencesFragment = PreferenceFragment()
        val fragment = fragmentManager.findFragmentByTag(PreferenceFragment::class.java.simpleName)

        if (fragment !is PreferenceFragment) {
            fragmentManager.commit {
                add(R.id.container, preferencesFragment, PreferenceFragment::class.java.simpleName)
            }
        }
    }

    override fun onSupportNavigateUp(): Boolean {
        onBackPressed()
        return true
    }
}