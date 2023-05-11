package id.co.polbeng.clinicsapp.data.remote.response

import com.google.gson.annotations.SerializedName

data class ErrorResponse(

    @field:SerializedName("code")
    val code: Int,

    @field:SerializedName("status")
    val status: String,

    @field:SerializedName("errors")
    val errors: ErrorItemResponse
)

data class ErrorItemResponse(

    @field:SerializedName("avatar")
    val avatar: List<String>? = null,

    @field:SerializedName("name")
    val name: List<String>? = null,

    @field:SerializedName("email")
    val email: List<String>? = null,

    @field:SerializedName("phone_number")
    val phoneNumber: List<String>? = null,

    @field:SerializedName("current_password")
    val currentPassword: List<String>? = null,

    @field:SerializedName("password")
    val password: List<String>? = null,

    @field:SerializedName("password_confirmation")
    val passwordConfirmation: List<String>? = null,

    @field:SerializedName("date_of_birth")
    val dateOfBirth: List<String>? = null,

    @field:SerializedName("address")
    val address: List<String>? = null,

    @field:SerializedName("patient")
    val patient: List<String>? = null,

    @field:SerializedName("allergy")
    val allergy: List<String>? = null,

    @field:SerializedName("status")
    val status: List<String>? = null,

    @field:SerializedName("gender")
    val gender: List<String>? = null,

    @field:SerializedName("doctor_id")
    val doctorId: List<String>? = null,
)
