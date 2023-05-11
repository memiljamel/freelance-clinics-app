package id.co.polbeng.clinicsapp.utils.rule

import com.wajahatkarim3.easyvalidation.core.rules.BaseRule

class ApiRule(
    val field: List<String>?,
    var errorMsg: String = "Something went wrong"
) : BaseRule {

    override fun getErrorMessage(): String {
        return field?.first() ?: errorMsg
    }

    override fun setError(msg: String) {
        errorMsg = msg
    }

    override fun validate(text: String): Boolean {
        return field.isNullOrEmpty()
    }
}