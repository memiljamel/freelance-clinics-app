package id.co.polbeng.clinicsapp.ui.login

import androidx.lifecycle.ViewModel
import id.co.polbeng.clinicsapp.data.remote.response.LoginResponse
import id.co.polbeng.clinicsapp.data.repository.AuthRepository
import id.co.polbeng.clinicsapp.utils.Result
import kotlinx.coroutines.flow.Flow

class LoginViewModel(private val repository: AuthRepository) : ViewModel() {

    suspend fun login(email: String, password: String): Flow<Result<LoginResponse>> {
        return repository.login(email, password)
    }
}