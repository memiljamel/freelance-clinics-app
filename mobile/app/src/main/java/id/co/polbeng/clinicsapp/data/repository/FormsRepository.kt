package id.co.polbeng.clinicsapp.data.repository

import id.co.polbeng.clinicsapp.data.remote.response.FormsResponse
import id.co.polbeng.clinicsapp.data.remote.retrofit.ApiService
import id.co.polbeng.clinicsapp.utils.Result
import kotlinx.coroutines.Dispatchers
import kotlinx.coroutines.flow.Flow
import kotlinx.coroutines.flow.flow
import kotlinx.coroutines.flow.flowOn

class FormsRepository(private val apiService: ApiService) {

    suspend fun getHistoryPatient(token: String?, id: String?): Flow<Result<FormsResponse>> {
        return flow {
            emit(Result.Loading)
            try {
                val bearerToken = generateBearerToken(token)
                val response = apiService.getHistoryPatient(bearerToken, id)
                emit(Result.Success(response))
            } catch (e: Exception) {
                e.printStackTrace()
                emit(Result.Error(e.message.toString()))
            }
        }.flowOn(Dispatchers.IO)
    }

    private fun generateBearerToken(token: String?): String {
        return "Bearer $token"
    }
}