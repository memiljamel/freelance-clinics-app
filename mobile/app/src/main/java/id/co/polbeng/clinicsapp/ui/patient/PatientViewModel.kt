package id.co.polbeng.clinicsapp.ui.patient

import androidx.lifecycle.LiveData
import androidx.lifecycle.MutableLiveData
import androidx.lifecycle.ViewModel
import androidx.lifecycle.viewModelScope
import id.co.polbeng.clinicsapp.data.remote.response.DoctorResponse
import id.co.polbeng.clinicsapp.data.remote.response.PatientResponse
import id.co.polbeng.clinicsapp.data.repository.PatientRepository
import id.co.polbeng.clinicsapp.utils.Result
import kotlinx.coroutines.flow.Flow
import kotlinx.coroutines.launch

class PatientViewModel(private val repository: PatientRepository) : ViewModel() {
    private var _doctors = MutableLiveData<Result<DoctorResponse>>()
    val doctors: LiveData<Result<DoctorResponse>> get() = _doctors

    fun getAllDoctors(token: String?) {
        viewModelScope.launch {
            repository.getAllDoctors(token).collect {
                _doctors.value = it
            }
        }
    }

    suspend fun storePatientRegistration(
        token: String?,
        name: String,
        dateOfBirth: String,
        address: String,
        type: String,
        allergy: String,
        status: String,
        gender: String,
        specialist: String,
    ): Flow<Result<PatientResponse>> {
        return repository.storePatientRegistration(
            token,
            name,
            dateOfBirth,
            address,
            type,
            allergy,
            status,
            gender,
            specialist
        )
    }
}