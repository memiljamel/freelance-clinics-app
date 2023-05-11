package id.co.polbeng.clinicsapp.ui.doctor

import android.app.SearchManager
import android.content.Context
import android.content.Intent
import android.os.Bundle
import androidx.activity.viewModels
import androidx.appcompat.app.AppCompatActivity
import androidx.appcompat.widget.SearchView
import androidx.core.view.isVisible
import androidx.lifecycle.Observer
import androidx.paging.LoadState
import androidx.recyclerview.widget.LinearLayoutManager
import id.co.polbeng.clinicsapp.R
import id.co.polbeng.clinicsapp.data.local.preferences.UserPreferences
import id.co.polbeng.clinicsapp.databinding.ActivityDoctorBinding
import id.co.polbeng.clinicsapp.ui.ViewModelFactory
import id.co.polbeng.clinicsapp.ui.patient.PatientActivity

class DoctorActivity : AppCompatActivity() {
    private lateinit var binding: ActivityDoctorBinding

    private val viewModel: DoctorViewModel by viewModels { ViewModelFactory(this) }

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityDoctorBinding.inflate(layoutInflater)
        setContentView(binding.root)

        setSupportActionBar(binding.toolbar)

        val doctorAdapter = DoctorAdapter { doctor ->
            val patientActivity = Intent(this, PatientActivity::class.java)
            patientActivity.putExtra(PatientActivity.EXTRA_SPECIALIST, doctor)
            startActivity(patientActivity)
            finish()
        }

        doctorAdapter.addLoadStateListener { loadState ->
            if (
                loadState.refresh is LoadState.NotLoading &&
                loadState.append.endOfPaginationReached &&
                doctorAdapter.itemCount < 1
            ) {
                binding.progressBar.isVisible = false
                binding.rvDoctors.isVisible = false
                binding.emptyData.root.isVisible = true
                binding.lytSwipeRefresh.isRefreshing = false
                return@addLoadStateListener
            }

            when (loadState.refresh) {
                is LoadState.Loading -> {
                    binding.progressBar.isVisible = true
                    binding.rvDoctors.isVisible = false
                    binding.unableConnection.root.isVisible = false
                }
                is LoadState.NotLoading -> {
                    binding.progressBar.isVisible = false
                    binding.rvDoctors.isVisible = true
                    binding.unableConnection.root.isVisible = false
                    binding.lytSwipeRefresh.isRefreshing = false
                }
                is LoadState.Error -> {
                    binding.progressBar.isVisible = false
                    binding.rvDoctors.isVisible = false
                    binding.unableConnection.root.isVisible = true
                    binding.lytSwipeRefresh.isRefreshing = false
                }
            }
        }

        binding.lytSwipeRefresh.setOnRefreshListener {
            doctorAdapter.refresh()
        }
        binding.rvDoctors.layoutManager = LinearLayoutManager(this)
        binding.rvDoctors.setHasFixedSize(true)
        binding.rvDoctors.adapter = doctorAdapter.withLoadStateFooter(
            footer = LoadingStateAdapter {
                doctorAdapter.retry()
            }
        )

        val preferences = UserPreferences(this)
        val user = preferences.getUser()

        viewModel.setToken(user.token)
        viewModel.doctors.observe(this, Observer { result ->
            doctorAdapter.submitData(lifecycle, result)
        })

        val searchManager = getSystemService(Context.SEARCH_SERVICE) as SearchManager

        binding.searchView.setSearchableInfo(searchManager.getSearchableInfo(componentName))
        binding.searchView.queryHint = resources.getString(R.string.search)
        binding.searchView.setOnQueryTextListener(object : SearchView.OnQueryTextListener {
            override fun onQueryTextSubmit(query: String?): Boolean {
                return false
            }

            override fun onQueryTextChange(newText: String?): Boolean {
                viewModel.search(newText.orEmpty())
                return true
            }
        })
    }

    override fun onSupportNavigateUp(): Boolean {
        onBackPressed()
        return true
    }
}