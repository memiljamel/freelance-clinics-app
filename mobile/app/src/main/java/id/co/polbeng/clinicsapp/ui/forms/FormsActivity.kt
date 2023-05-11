package id.co.polbeng.clinicsapp.ui.forms

import android.app.DownloadManager
import android.content.Context
import android.content.Intent
import android.net.Uri
import android.os.Bundle
import android.os.Environment
import android.view.Menu
import android.view.MenuInflater
import android.view.MenuItem
import android.widget.Toast
import androidx.activity.viewModels
import androidx.appcompat.app.AppCompatActivity
import androidx.core.view.isVisible
import androidx.lifecycle.Observer
import id.co.polbeng.clinicsapp.R
import id.co.polbeng.clinicsapp.data.local.preferences.UserPreferences
import id.co.polbeng.clinicsapp.databinding.ActivityFormsBinding
import id.co.polbeng.clinicsapp.ui.ViewModelFactory
import id.co.polbeng.clinicsapp.utils.Result
import kotlinx.coroutines.Dispatchers
import kotlinx.coroutines.GlobalScope
import kotlinx.coroutines.launch
import kotlinx.coroutines.withContext
import java.net.HttpURLConnection
import java.net.URL

class FormsActivity : AppCompatActivity() {
    private lateinit var binding: ActivityFormsBinding

    private val viewModel: FormsViewModel by viewModels { ViewModelFactory(this) }

    private var isEnabled: Boolean = false
    private var pdfUrl: String? = null

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityFormsBinding.inflate(layoutInflater)
        setContentView(binding.root)

        setSupportActionBar(binding.toolbar)

        val preferences = UserPreferences(this)
        val user = preferences.getUser()

        if (savedInstanceState == null) {
            viewModel.getHistoryPatient(user.token, user.id)
        }

        viewModel.histories.observe(this, Observer { result ->
            when (result) {
                is Result.Loading -> {
                    isEnabled = false
                    invalidateOptionsMenu()

                    binding.progressBar.isVisible = true
                    binding.pdfView.isVisible = false
                    binding.unableConnection.root.isVisible = false
                }
                is Result.Success -> {
                    isEnabled = true
                    invalidateOptionsMenu()

                    binding.progressBar.isVisible = false
                    binding.pdfView.isVisible = true
                    binding.unableConnection.root.isVisible = false

                    pdfUrl = result.data.forms.file
                    showPdfFromUrl(pdfUrl)
                }
                is Result.Error -> {
                    isEnabled = false
                    invalidateOptionsMenu()

                    binding.progressBar.isVisible = false
                    binding.pdfView.isVisible = false
                    binding.unableConnection.root.isVisible = true
                }
            }
        })
    }

    override fun onPrepareOptionsMenu(menu: Menu?): Boolean {
        val downloadMenu = menu?.findItem(R.id.download)
        downloadMenu?.isEnabled = isEnabled

        return super.onPrepareOptionsMenu(menu)
    }

    override fun onCreateOptionsMenu(menu: Menu?): Boolean {
        val inflater: MenuInflater = menuInflater
        inflater.inflate(R.menu.menu_forms, menu)
        return true
    }

    override fun onOptionsItemSelected(item: MenuItem): Boolean {
        return when (item.itemId) {
            R.id.download -> {
                downloadPdf()
                true
            }
            else -> super.onOptionsItemSelected(item)
        }
    }

    private fun showPdfFromUrl(url: String?) {
        GlobalScope.launch(Dispatchers.IO) {
            try {
                val url = URL(url)
                val connection = url.openConnection() as HttpURLConnection
                connection.requestMethod = "GET"
                connection.connect()

                val inputStream = connection.inputStream
                val byteArray = inputStream.readBytes()
                withContext(Dispatchers.Main) {
                    binding.pdfView.fromBytes(byteArray)
                        .onPageError { page, _ -> }
                        .onError {
                            isEnabled = false
                            invalidateOptionsMenu()

                            binding.progressBar.isVisible = false

                            Toast.makeText(
                                this@FormsActivity,
                                it.message.toString(),
                                Toast.LENGTH_LONG
                            ).show()
                        }
                        .onLoad {
                            isEnabled = true
                            invalidateOptionsMenu()

                            binding.progressBar.isVisible = false
                        }
                        .spacing(8)
                        .load()
                }
            } catch (e: Exception) {
                e.printStackTrace()
            }
        }
    }

    private fun downloadPdf() {
        val request = DownloadManager.Request(Uri.parse(pdfUrl))
            .setMimeType("application/pdf")
            .setAllowedNetworkTypes(DownloadManager.Request.NETWORK_WIFI or DownloadManager.Request.NETWORK_MOBILE)
            .setTitle("Treatment History")
            .setNotificationVisibility(DownloadManager.Request.VISIBILITY_VISIBLE_NOTIFY_COMPLETED)
            .setDestinationInExternalPublicDir(
                Environment.DIRECTORY_DOWNLOADS,
                "Treatment History.pdf"
            )

        val manager = getSystemService(Context.DOWNLOAD_SERVICE) as DownloadManager
        manager.enqueue(request)
    }

    override fun onSupportNavigateUp(): Boolean {
        onBackPressed()
        return true
    }
}