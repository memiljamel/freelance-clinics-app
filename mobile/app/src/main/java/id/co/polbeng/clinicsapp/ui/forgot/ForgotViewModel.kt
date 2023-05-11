package id.co.polbeng.clinicsapp.ui.forgot

import androidx.lifecycle.ViewModel
import id.co.polbeng.clinicsapp.data.remote.response.ForgotResponse
import id.co.polbeng.clinicsapp.data.repository.AuthRepository
import id.co.polbeng.clinicsapp.utils.Result
import kotlinx.coroutines.flow.Flow

class ForgotViewModel(private val repository: AuthRepository) : ViewModel() {

    suspend fun forgotPassword(email: String): Flow<Result<ForgotResponse>> {
        return repository.forgotPassword(email)
    }
}
