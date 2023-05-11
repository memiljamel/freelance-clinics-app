package id.co.polbeng.clinicsapp.data.remote.response

import com.google.gson.annotations.SerializedName

data class ResetResponse(

    @field:SerializedName("code")
    val code: Int,

    @field:SerializedName("status")
    val status: String,

    @field:SerializedName("data")
    val user: UserProfileInformation,

    @field:SerializedName("token")
    val token: String
)
