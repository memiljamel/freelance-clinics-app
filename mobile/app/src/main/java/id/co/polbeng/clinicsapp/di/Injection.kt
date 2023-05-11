package id.co.polbeng.clinicsapp.di

import id.co.polbeng.clinicsapp.data.remote.retrofit.ApiConfig
import id.co.polbeng.clinicsapp.data.repository.AuthRepository
import id.co.polbeng.clinicsapp.data.repository.DoctorRepository
import id.co.polbeng.clinicsapp.data.repository.FormsRepository
import id.co.polbeng.clinicsapp.data.repository.PatientRepository

object Injection {

    fun provideAuthRepository(): AuthRepository {
        val apiService = ApiConfig().provideApiService()
        return AuthRepository(apiService)
    }

    fun provideDoctorRepository(): DoctorRepository {
        val apiService = ApiConfig().provideApiService()
        return DoctorRepository(apiService)
    }

    fun providePatientRepository(): PatientRepository {
        val apiService = ApiConfig().provideApiService()
        return PatientRepository(apiService)
    }

    fun provideFormsRepository(): FormsRepository {
        val apiService = ApiConfig().provideApiService()
        return FormsRepository(apiService)
    }
}