package id.co.polbeng.clinicsapp.ui

import android.content.Context
import androidx.lifecycle.ViewModel
import androidx.lifecycle.ViewModelProvider
import id.co.polbeng.clinicsapp.di.Injection
import id.co.polbeng.clinicsapp.ui.change.ChangeViewModel
import id.co.polbeng.clinicsapp.ui.doctor.DoctorViewModel
import id.co.polbeng.clinicsapp.ui.forgot.ForgotViewModel
import id.co.polbeng.clinicsapp.ui.forms.FormsViewModel
import id.co.polbeng.clinicsapp.ui.home.HomeViewModel
import id.co.polbeng.clinicsapp.ui.login.LoginViewModel
import id.co.polbeng.clinicsapp.ui.patient.PatientViewModel
import id.co.polbeng.clinicsapp.ui.profile.ProfileViewModel
import id.co.polbeng.clinicsapp.ui.register.RegisterViewModel
import id.co.polbeng.clinicsapp.ui.reset.ResetViewModel

class ViewModelFactory(private val context: Context) : ViewModelProvider.NewInstanceFactory() {

    @Suppress("UNCHECKED_CAST")
    override fun <T : ViewModel> create(modelClass: Class<T>): T {
        return when {
            modelClass.isAssignableFrom(LoginViewModel::class.java) ->
                LoginViewModel(Injection.provideAuthRepository()) as T

            modelClass.isAssignableFrom(RegisterViewModel::class.java) ->
                RegisterViewModel(Injection.provideAuthRepository()) as T

            modelClass.isAssignableFrom(ForgotViewModel::class.java) ->
                ForgotViewModel(Injection.provideAuthRepository()) as T

            modelClass.isAssignableFrom(ResetViewModel::class.java) ->
                ResetViewModel(Injection.provideAuthRepository()) as T

            modelClass.isAssignableFrom(ChangeViewModel::class.java) ->
                ChangeViewModel(Injection.provideAuthRepository()) as T

            modelClass.isAssignableFrom(ProfileViewModel::class.java) ->
                ProfileViewModel(Injection.provideAuthRepository()) as T

            modelClass.isAssignableFrom(HomeViewModel::class.java) ->
                HomeViewModel(Injection.provideAuthRepository()) as T

            modelClass.isAssignableFrom(DoctorViewModel::class.java) ->
                DoctorViewModel(Injection.provideDoctorRepository()) as T

            modelClass.isAssignableFrom(PatientViewModel::class.java) ->
                PatientViewModel(Injection.providePatientRepository()) as T

            modelClass.isAssignableFrom(FormsViewModel::class.java) ->
                FormsViewModel(Injection.provideFormsRepository()) as T

            else -> throw IllegalArgumentException("Unknown ViewModel class: " + modelClass.name)
        }
    }
}