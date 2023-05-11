package id.co.polbeng.clinicsapp.utils

import id.co.polbeng.clinicsapp.data.remote.response.ErrorResponse

sealed class Result<out R> private constructor() {

    data class Success<out T>(val data: T) : Result<T>()

    data class Error(
        val message: String,
        val code: Int? = null,
        val data: ErrorResponse? = null
    ) : Result<Nothing>()

    object Loading : Result<Nothing>()
}
