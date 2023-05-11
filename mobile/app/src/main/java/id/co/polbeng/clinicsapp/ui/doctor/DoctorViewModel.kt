package id.co.polbeng.clinicsapp.ui.doctor

import androidx.lifecycle.ViewModel
import androidx.lifecycle.asLiveData
import androidx.lifecycle.viewModelScope
import androidx.paging.cachedIn
import id.co.polbeng.clinicsapp.data.repository.DoctorRepository
import kotlinx.coroutines.ExperimentalCoroutinesApi
import kotlinx.coroutines.FlowPreview
import kotlinx.coroutines.flow.MutableStateFlow
import kotlinx.coroutines.flow.debounce
import kotlinx.coroutines.flow.distinctUntilChanged
import kotlinx.coroutines.flow.flatMapLatest

class DoctorViewModel(private val repository: DoctorRepository) : ViewModel() {
    private val searchQuery = MutableStateFlow("")
    private var token: String? = null

    @OptIn(FlowPreview::class, ExperimentalCoroutinesApi::class)
    val doctors = searchQuery
        .debounce(300)
        .distinctUntilChanged()
        .flatMapLatest { query ->
            repository.getAllDoctors(token, query)
                .cachedIn(viewModelScope)
        }
        .asLiveData()

    fun search(query: String) {
        searchQuery.value = query
    }

    fun setToken(token: String?) {
        this.token = token
    }
}