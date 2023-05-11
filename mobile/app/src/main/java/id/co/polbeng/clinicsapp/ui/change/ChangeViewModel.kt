package id.co.polbeng.clinicsapp.ui.change

import androidx.lifecycle.ViewModel
import id.co.polbeng.clinicsapp.data.remote.response.ChangeResponse
import id.co.polbeng.clinicsapp.data.repository.AuthRepository
import id.co.polbeng.clinicsapp.utils.Result
import kotlinx.coroutines.flow.Flow

class ChangeViewModel(private val repository: AuthRepository) : ViewModel() {

    suspend fun changePassword(
        token: String?,
        id: String?,
        currentPassword: String,
        password: String,
        passwordConfirmation: String,
    ): Flow<Result<ChangeResponse>> {
        return repository.changePassword(
            token,
            id,
            currentPassword,
            password,
            passwordConfirmation
        )
    }
}