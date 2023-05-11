package id.co.polbeng.clinicsapp.ui.profile

import androidx.lifecycle.ViewModel
import id.co.polbeng.clinicsapp.data.remote.response.UserResponse
import id.co.polbeng.clinicsapp.data.repository.AuthRepository
import id.co.polbeng.clinicsapp.utils.Result
import kotlinx.coroutines.flow.Flow
import okhttp3.RequestBody

class ProfileViewModel(private val repository: AuthRepository) : ViewModel() {

    suspend fun updateUser(
        token: String?,
        id: String?,
        data: HashMap<String, RequestBody>
    ): Flow<Result<UserResponse>> {
        return repository.updateUser(token, id, data)
    }
}