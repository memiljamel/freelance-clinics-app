package id.co.polbeng.clinicsapp.ui.home

import androidx.lifecycle.ViewModel
import id.co.polbeng.clinicsapp.data.remote.response.LogoutResponse
import id.co.polbeng.clinicsapp.data.repository.AuthRepository
import id.co.polbeng.clinicsapp.utils.Result
import kotlinx.coroutines.flow.Flow

class HomeViewModel(private val repository: AuthRepository) : ViewModel() {

    suspend fun logout(token: String?): Flow<Result<LogoutResponse>> {
        return repository.logout(token)
    }
}