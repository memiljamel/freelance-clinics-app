package id.co.polbeng.clinicsapp.data.remote.response

import com.google.gson.annotations.SerializedName

data class FormsResponse(

    @field:SerializedName("code")
    val code: Int,

    @field:SerializedName("status")
    val status: String,

    @field:SerializedName("data")
    val forms: PatientFormsInformation
)

data class PatientFormsInformation(

    @field:SerializedName("file")
    val file: String,
)
