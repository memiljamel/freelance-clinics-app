package id.co.polbeng.clinicsapp.ui.about

import android.annotation.SuppressLint
import android.content.Intent
import android.graphics.Bitmap
import android.net.Uri
import android.os.Bundle
import android.webkit.WebResourceRequest
import android.webkit.WebView
import android.webkit.WebViewClient
import androidx.appcompat.app.AppCompatActivity
import androidx.core.content.ContextCompat
import androidx.core.view.isVisible
import androidx.swiperefreshlayout.widget.SwipeRefreshLayout
import id.co.polbeng.clinicsapp.BuildConfig
import id.co.polbeng.clinicsapp.R
import id.co.polbeng.clinicsapp.databinding.ActivityAboutBinding

class AboutActivity : AppCompatActivity(), SwipeRefreshLayout.OnRefreshListener {
    private lateinit var binding: ActivityAboutBinding

    @SuppressLint("SetJavaScriptEnabled")
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityAboutBinding.inflate(layoutInflater)
        setContentView(binding.root)

        setSupportActionBar(binding.toolbar)

        binding.lytSwipeRefresh.setOnRefreshListener(this)
        binding.lytSwipeRefresh.setColorSchemeColors(
            ContextCompat.getColor(
                this,
                R.color.red_500
            )
        )

        binding.webView.settings.javaScriptEnabled = true
        binding.webView.webViewClient = MyWebView()
        binding.webView.loadUrl(HOST_URL)
    }

    override fun onRefresh() {
        binding.webView.reload()
        binding.lytSwipeRefresh.isRefreshing = true
    }

    override fun onSupportNavigateUp(): Boolean {
        onBackPressed()
        return true
    }

    override fun onBackPressed() {
        if (binding.webView.canGoBack()) {
            binding.webView.goBack()
        } else {
            super.onBackPressed()
        }
    }

    companion object {
        private const val HOST_URL = BuildConfig.HOST_URL
    }

    inner class MyWebView : WebViewClient() {
        override fun shouldOverrideUrlLoading(
            view: WebView?,
            request: WebResourceRequest?
        ): Boolean {
            if (Uri.parse(request?.url.toString()).host == HOST_URL) {
                view?.loadUrl(request?.url.toString())
                return false
            }

            val actionView = Intent(Intent.ACTION_VIEW, Uri.parse(request?.url.toString()))
            startActivity(actionView)
            return true
        }

        override fun onPageStarted(view: WebView?, url: String?, favicon: Bitmap?) {
            super.onPageStarted(view, url, favicon)
            binding.progressBar.isVisible = true
        }

        override fun onPageFinished(view: WebView?, url: String?) {
            super.onPageFinished(view, url)
            binding.progressBar.isVisible = false
            binding.lytSwipeRefresh.isRefreshing = false
        }
    }
}