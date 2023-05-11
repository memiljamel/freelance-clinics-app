package id.co.polbeng.clinicsapp.data.local.preferences

import android.content.Context
import android.content.SharedPreferences
import android.security.keystore.KeyGenParameterSpec
import android.security.keystore.KeyProperties
import androidx.security.crypto.EncryptedSharedPreferences
import androidx.security.crypto.MasterKey
import id.co.polbeng.clinicsapp.data.model.User

internal class UserPreferences(context: Context) {

    private val spec = KeyGenParameterSpec.Builder(
        MasterKey.DEFAULT_MASTER_KEY_ALIAS,
        KeyProperties.PURPOSE_ENCRYPT or KeyProperties.PURPOSE_DECRYPT
    )
        .setBlockModes(KeyProperties.BLOCK_MODE_GCM)
        .setKeySize(MasterKey.DEFAULT_AES_GCM_MASTER_KEY_SIZE)
        .setEncryptionPaddings(KeyProperties.ENCRYPTION_PADDING_NONE)
        .build()
    private val masterKey = MasterKey.Builder(context)
        .setKeyGenParameterSpec(spec)
        .build()
    private var preferences: SharedPreferences = EncryptedSharedPreferences.create(
        context,
        "Session",
        masterKey,
        EncryptedSharedPreferences.PrefKeyEncryptionScheme.AES256_SIV,
        EncryptedSharedPreferences.PrefValueEncryptionScheme.AES256_GCM
    )

    fun setUser(user: User) {
        val editor = preferences.edit()
        editor.putString(ID, user.id)
        editor.putString(NAME, user.name)
        editor.putString(EMAIL, user.email)
        editor.putString(PHONE_NUMBER, user.phoneNumber)
        editor.putString(AVATAR, user.avatar)
        editor.putString(TOKEN, user.token)
        editor.apply()
    }

    fun getUser(): User {
        val user = User()
        user.id = preferences.getString(ID, "")
        user.name = preferences.getString(NAME, "")
        user.email = preferences.getString(EMAIL, "")
        user.phoneNumber = preferences.getString(PHONE_NUMBER, "")
        user.avatar = preferences.getString(AVATAR, "")
        user.token = preferences.getString(TOKEN, "")
        return user
    }

    fun removeUser() {
        val editor = preferences.edit()
        editor.putString(ID, "")
        editor.putString(NAME, "")
        editor.putString(EMAIL, "")
        editor.putString(PHONE_NUMBER, "")
        editor.putString(AVATAR, "")
        editor.putString(TOKEN, "")
        editor.apply()
    }

    companion object {
        private const val ID = "id"
        private const val NAME = "name"
        private const val EMAIL = "email"
        private const val PHONE_NUMBER = "phone_number"
        private const val AVATAR = "avatar"
        private const val TOKEN = "token"
    }
}