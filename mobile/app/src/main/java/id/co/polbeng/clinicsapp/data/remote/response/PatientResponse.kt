package id.co.polbeng.clinicsapp.data.remote.response

import com.google.gson.annotations.SerializedName

data class PatientResponse(

    @field:SerializedName("data")
    val patient: PatientProfileInformation
)

data class PatientProfileInformation(

    @field:SerializedName("id")
    val id: String,

    @field:SerializedName("name")
    val name: String,

    @field:SerializedName("date_of_birth")
    val dateOfBirth: String,

    @field:SerializedName("address")
    val address: String,

    @field:SerializedName("type")
    val type: String,

    @field:SerializedName("allergy")
    val allergy: String,

    @field:SerializedName("status")
    val status: String,

    @field:SerializedName("gender")
    val gender: String,

    @field:SerializedName("doctor_id")
    val doctorId: String,

    @field:SerializedName("created_at")
    val createdAt: String,

    @field:SerializedName("updated_at")
    val updatedAt: String,
)
