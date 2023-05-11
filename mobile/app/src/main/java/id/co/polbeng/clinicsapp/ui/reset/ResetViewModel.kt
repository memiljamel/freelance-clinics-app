package id.co.polbeng.clinicsapp.ui.reset

import androidx.lifecycle.ViewModel
import id.co.polbeng.clinicsapp.data.remote.response.ResetResponse
import id.co.polbeng.clinicsapp.data.repository.AuthRepository
import id.co.polbeng.clinicsapp.utils.Result
import kotlinx.coroutines.flow.Flow

class ResetViewModel(private val repository: AuthRepository) : ViewModel() {

    suspend fun resetPassword(
        token: String?,
        email: String,
        password: String,
        passwordConfirmation: String
    ): Flow<Result<ResetResponse>> {
        return repository.resetPassword(token, email, password, passwordConfirmation)
    }
}