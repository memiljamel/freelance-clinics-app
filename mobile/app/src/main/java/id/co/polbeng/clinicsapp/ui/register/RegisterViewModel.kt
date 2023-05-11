package id.co.polbeng.clinicsapp.ui.register

import androidx.lifecycle.ViewModel
import id.co.polbeng.clinicsapp.data.remote.response.RegisterResponse
import id.co.polbeng.clinicsapp.data.repository.AuthRepository
import id.co.polbeng.clinicsapp.utils.Result
import kotlinx.coroutines.flow.Flow

class RegisterViewModel(private val repository: AuthRepository) : ViewModel() {

    suspend fun register(
        name: String,
        email: String,
        password: String,
        passwordConfirmation: String,
    ): Flow<Result<RegisterResponse>> {
        return repository.register(name, email, password, passwordConfirmation)
    }
}