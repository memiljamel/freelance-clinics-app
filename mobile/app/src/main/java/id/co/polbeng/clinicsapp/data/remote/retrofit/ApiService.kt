package id.co.polbeng.clinicsapp.data.remote.retrofit

import id.co.polbeng.clinicsapp.data.remote.response.*
import okhttp3.RequestBody
import retrofit2.Response
import retrofit2.http.*

interface ApiService {

    @FormUrlEncoded
    @Headers("Accept: application/json")
    @POST("auth/register")
    suspend fun register(
        @Field("name") name: String,
        @Field("email") email: String,
        @Field("password") password: String,
        @Field("password_confirmation") passwordConfirmation: String,
    ): Response<RegisterResponse>

    @FormUrlEncoded
    @Headers("Accept: application/json")
    @POST("auth/login")
    suspend fun login(
        @Field("email") email: String,
        @Field("password") password: String,
    ): Response<LoginResponse>

    @FormUrlEncoded
    @Headers("Accept: application/json")
    @POST("auth/forgot-password")
    suspend fun forgotPassword(
        @Field("email") email: String,
    ): Response<ForgotResponse>

    @FormUrlEncoded
    @Headers("Accept: application/json")
    @POST("auth/reset-password")
    suspend fun resetPassword(
        @Field("token") token: String?,
        @Field("email") email: String,
        @Field("password") password: String,
        @Field("password_confirmation") passwordConfirmation: String,
    ): Response<ResetResponse>

    @FormUrlEncoded
    @Headers("Accept: application/json")
    @PATCH("auth/change-password/{id}")
    suspend fun changePassword(
        @Header("Authorization") token: String,
        @Path("id") id: String?,
        @Field("current_password") currentPassword: String,
        @Field("password") password: String,
        @Field("password_confirmation") passwordConfirmation: String,
    ): Response<ChangeResponse>

    @Headers("Accept: application/json")
    @POST("auth/logout")
    suspend fun logout(
        @Header("Authorization") token: String,
    ): Response<LogoutResponse>

    @Multipart
    @Headers("Accept: application/json")
    @POST("users/{id}")
    suspend fun updateUser(
        @Header("Authorization") token: String,
        @Path("id") id: String?,
        @PartMap data: HashMap<String, RequestBody>,
    ): Response<UserResponse>

    @Headers("Accept: application/json")
    @GET("doctors")
    suspend fun getAllDoctors(
        @Header("Authorization") token: String,
        @Query("page") page: Int? = null,
        @Query("per_page") per_page: Int? = null,
        @Query("specialist") specialist: String? = null,
        @Query("active") active: Int = 1,
    ): DoctorResponse

    @FormUrlEncoded
    @Headers("Accept: application/json")
    @POST("patients")
    suspend fun storeRegistrationPatient(
        @Header("Authorization") token: String,
        @Field("name") name: String,
        @Field("date_of_birth") dateOfBirth: String,
        @Field("address") address: String,
        @Field("type") type: String,
        @Field("allergy") allergy: String,
        @Field("status") status: String,
        @Field("gender") gender: String,
        @Field("doctor_id") specialist: String,
    ): Response<PatientResponse>

    @Headers("Accept: application/json")
    @GET("forms/{id}")
    suspend fun getHistoryPatient(
        @Header("Authorization") token: String,
        @Path("id") id: String?,
    ): FormsResponse
}
