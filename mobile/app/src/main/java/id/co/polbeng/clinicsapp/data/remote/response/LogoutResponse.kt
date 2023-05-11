package id.co.polbeng.clinicsapp.data.remote.response

import com.google.gson.annotations.SerializedName

data class LogoutResponse(

    @field:SerializedName("code")
    val code: Int,

    @field:SerializedName("status")
    val status: String,

    @field:SerializedName("message")
    val message: String,
)
