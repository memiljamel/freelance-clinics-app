package id.co.polbeng.clinicsapp.ui.forms

import androidx.lifecycle.LiveData
import androidx.lifecycle.MutableLiveData
import androidx.lifecycle.ViewModel
import androidx.lifecycle.viewModelScope
import id.co.polbeng.clinicsapp.data.remote.response.FormsResponse
import id.co.polbeng.clinicsapp.data.repository.FormsRepository
import id.co.polbeng.clinicsapp.utils.Result
import kotlinx.coroutines.launch

class FormsViewModel(private val repository: FormsRepository) : ViewModel() {
    private var _histories = MutableLiveData<Result<FormsResponse>>()
    val histories: LiveData<Result<FormsResponse>> get() = _histories

    fun getHistoryPatient(token: String?, id: String?) {
        viewModelScope.launch {
            repository.getHistoryPatient(token, id).collect {
                _histories.value = it
            }
        }
    }
}