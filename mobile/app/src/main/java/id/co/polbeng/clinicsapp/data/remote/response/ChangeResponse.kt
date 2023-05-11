package id.co.polbeng.clinicsapp.data.remote.response

import com.google.gson.annotations.SerializedName

data class ChangeResponse(

    @field:SerializedName("code")
    val code: Int,

    @field:SerializedName("status")
    val status: String,

    @field:SerializedName("data")
    val user: UserProfileInformation,
)
