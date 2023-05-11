package id.co.polbeng.clinicsapp.ui.queue

import android.os.Bundle
import androidx.appcompat.app.AppCompatActivity
import id.co.polbeng.clinicsapp.databinding.ActivityQueueBinding

class QueueActivity : AppCompatActivity() {
    private lateinit var binding: ActivityQueueBinding

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityQueueBinding.inflate(layoutInflater)
        setContentView(binding.root)
    }

    override fun onSupportNavigateUp(): Boolean {
        onBackPressed()
        return true
    }
}