package id.co.polbeng.clinicsapp.data.remote.response

import android.os.Parcelable
import com.google.gson.annotations.SerializedName
import kotlinx.parcelize.Parcelize

data class DoctorResponse(

    @field:SerializedName("code")
    val code: Int,

    @field:SerializedName("status")
    val status: String,

    @field:SerializedName("data")
    val doctor: List<DoctorItemResponse>
)

@Parcelize
data class DoctorItemResponse(

    @field:SerializedName("id")
    val id: String,

    @field:SerializedName("avatar")
    val avatar: String,

    @field:SerializedName("name")
    val name: String,

    @field:SerializedName("specialist")
    val specialist: String,

    @field:SerializedName("date")
    val date: String,

    @field:SerializedName("office_hours")
    val officeHours: String,

    @field:SerializedName("room")
    val room: String,
) : Parcelable
