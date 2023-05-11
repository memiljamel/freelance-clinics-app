package id.co.polbeng.clinicsapp.data.repository

import com.google.gson.Gson
import id.co.polbeng.clinicsapp.data.remote.response.*
import id.co.polbeng.clinicsapp.data.remote.retrofit.ApiService
import id.co.polbeng.clinicsapp.utils.Result
import kotlinx.coroutines.Dispatchers
import kotlinx.coroutines.flow.Flow
import kotlinx.coroutines.flow.flow
import kotlinx.coroutines.flow.flowOn
import okhttp3.RequestBody

class AuthRepository(private val apiService: ApiService) {

    suspend fun login(email: String, password: String): Flow<Result<LoginResponse>> {
        return flow {
            emit(Result.Loading)
            try {
                val response = apiService.login(email, password)

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

    suspend fun register(
        name: String,
        email: String,
        password: String,
        passwordConfirmation: String,
    ): Flow<Result<RegisterResponse>> {
        return flow {
            emit(Result.Loading)
            try {
                val response = apiService.register(name, email, password, passwordConfirmation)

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

    suspend fun forgotPassword(email: String): Flow<Result<ForgotResponse>> {
        return flow {
            emit(Result.Loading)
            try {
                val response = apiService.forgotPassword(email)

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

    suspend fun resetPassword(
        token: String?,
        email: String,
        password: String,
        passwordConfirmation: String,
    ): Flow<Result<ResetResponse>> {
        return flow {
            emit(Result.Loading)
            try {
                val response = apiService.resetPassword(
                    token,
                    email,
                    password,
                    passwordConfirmation,
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

    suspend fun changePassword(
        token: String?,
        id: String?,
        currentPassword: String,
        password: String,
        passwordConfirmation: String,
    ): Flow<Result<ChangeResponse>> {
        return flow {
            emit(Result.Loading)
            try {
                val bearerToken = generateBearerToken(token)
                val response = apiService.changePassword(
                    bearerToken,
                    id,
                    currentPassword,
                    password,
                    passwordConfirmation
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

    suspend fun updateUser(
        token: String?,
        id: String?,
        data: HashMap<String, RequestBody>,
    ): Flow<Result<UserResponse>> {
        return flow {
            emit(Result.Loading)
            try {
                val bearerToken = generateBearerToken(token)
                val response = apiService.updateUser(bearerToken, id, data)

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

    suspend fun logout(token: String?): Flow<Result<LogoutResponse>> {
        return flow {
            emit(Result.Loading)
            try {
                val bearerToken = generateBearerToken(token)
                val response = apiService.logout(bearerToken)

                if (response.isSuccessful) {
                    val responseBody = response.body()
                    if (responseBody != null) {
                        emit(Result.Success(responseBody))
                    }
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