package id.co.polbeng.clinicsapp.data.repository

import androidx.paging.PagingSource
import androidx.paging.PagingState
import id.co.polbeng.clinicsapp.data.remote.response.DoctorItemResponse
import id.co.polbeng.clinicsapp.data.remote.retrofit.ApiService

class DoctorPagingSource(
    private val apiService: ApiService,
    private val token: String,
    private val query: String?,
) : PagingSource<Int, DoctorItemResponse>() {
    override fun getRefreshKey(state: PagingState<Int, DoctorItemResponse>): Int? {
        return state.anchorPosition?.let { anchorPosition ->
            val anchorPage = state.closestPageToPosition(anchorPosition)
            anchorPage?.prevKey?.plus(1) ?: anchorPage?.nextKey?.minus(1)
        }
    }

    override suspend fun load(params: LoadParams<Int>): LoadResult<Int, DoctorItemResponse> {
        return try {
            val position = params.key ?: INITIAL_PAGE_INDEX
            val responseData = apiService.getAllDoctors(token, position, params.loadSize, query)

            LoadResult.Page(
                data = responseData.doctor,
                prevKey = if (position == INITIAL_PAGE_INDEX) null else position - 1,
                nextKey = if (responseData.doctor.isEmpty()) null else position + 1
            )
        } catch (e: Exception) {
            return LoadResult.Error(e)
        }
    }

    private companion object {
        const val INITIAL_PAGE_INDEX = 1
    }
}