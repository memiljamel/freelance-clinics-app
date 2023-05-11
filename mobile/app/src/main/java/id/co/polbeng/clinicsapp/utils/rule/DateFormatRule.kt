package id.co.polbeng.clinicsapp.utils.rule

import com.wajahatkarim3.easyvalidation.core.rules.BaseRule
import java.text.ParseException
import java.text.SimpleDateFormat
import java.util.*

class DateFormatRule(
    val format: String = "yyyy-MM-dd",
    var errorMsg: String = "date must be in $format format"
) : BaseRule {

    override fun getErrorMessage(): String {
        return errorMsg
    }

    override fun setError(msg: String) {
        errorMsg = msg
    }

    override fun validate(text: String): Boolean {
        val dateFormat = SimpleDateFormat(format, Locale.getDefault())
        dateFormat.isLenient = false

        return try {
            dateFormat.parse(text)
            true
        } catch (e: ParseException) {
            e.printStackTrace()
            false
        }
    }
}