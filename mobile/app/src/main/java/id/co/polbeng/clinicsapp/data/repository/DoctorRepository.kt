package id.co.polbeng.clinicsapp.data.repository

import androidx.paging.Pager
import androidx.paging.PagingConfig
import androidx.paging.PagingData
import id.co.polbeng.clinicsapp.data.remote.response.DoctorItemResponse
import id.co.polbeng.clinicsapp.data.remote.retrofit.ApiService
import kotlinx.coroutines.flow.Flow

class DoctorRepository(private val apiService: ApiService) {

    fun getAllDoctors(token: String?, query: String?): Flow<PagingData<DoctorItemResponse>> {
        return Pager(
            config = PagingConfig(
                pageSize = NETWORK_PAGE_SIZE,
            ),
            pagingSourceFactory = {
                val bearerToken = generateBearerToken(token)
                DoctorPagingSource(apiService, bearerToken, query)
            }
        ).flow
    }

    private fun generateBearerToken(token: String?): String {
        return "Bearer $token"
    }

    companion object {
        private const val NETWORK_PAGE_SIZE = 5
    }
}