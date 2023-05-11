package id.co.polbeng.clinicsapp.data.repository

import com.google.gson.Gson
import id.co.polbeng.clinicsapp.data.remote.response.DoctorResponse
import id.co.polbeng.clinicsapp.data.remote.response.ErrorResponse
import id.co.polbeng.clinicsapp.data.remote.response.PatientResponse
import id.co.polbeng.clinicsapp.data.remote.retrofit.ApiService
import id.co.polbeng.clinicsapp.utils.Result
import kotlinx.coroutines.Dispatchers
import kotlinx.coroutines.flow.Flow
import kotlinx.coroutines.flow.flow
import kotlinx.coroutines.flow.flowOn

class PatientRepository(private val apiService: ApiService) {

    suspend fun getAllDoctors(token: String?): Flow<Result<DoctorResponse>> {
        return flow {
            emit(Result.Loading)
            try {
                val bearerToken = generateBearerToken(token)
                val response = apiService.getAllDoctors(bearerToken)
                emit(Result.Success(response))
            } catch (e: Exception) {
                e.printStackTrace()
                emit(Result.Error(e.message.toString()))
            }
        }.flowOn(Dispatchers.IO)
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
        specialist: String
    ): Flow<Result<PatientResponse>> {
        return flow {
            emit(Result.Loading)
            try {
                val bearerToken = generateBearerToken(token)
                val response = apiService.storeRegistrationPatient(
                    bearerToken,
                    name,
                    dateOfBirth,
                    address,
                    type,
                    allergy,
                    status,
                    gender,
                    specialist
                )

                if (response.isSuccessful) {
                    val responseBody = response.body()
                    if (responseBody != null) {
                        emit(Result.Success(responseBody))
                    }
                } else {
                    val responseError = Gson().fromJson(
                        response.errorBody()?.charStream(),
                        ErrorResponse::class.java
                    )
                    emit(Result.Error(response.message(), response.code(), responseError))
                }
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