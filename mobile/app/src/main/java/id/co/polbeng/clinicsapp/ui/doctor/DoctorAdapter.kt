package id.co.polbeng.clinicsapp.ui.doctor

import android.view.LayoutInflater
import android.view.ViewGroup
import androidx.paging.PagingDataAdapter
import androidx.recyclerview.widget.DiffUtil
import androidx.recyclerview.widget.RecyclerView
import com.bumptech.glide.Glide
import com.bumptech.glide.request.RequestOptions
import id.co.polbeng.clinicsapp.data.remote.response.DoctorItemResponse
import id.co.polbeng.clinicsapp.databinding.ItemRowDoctorBinding
import id.co.polbeng.clinicsapp.ui.doctor.DoctorAdapter.MyViewHolder

class DoctorAdapter(
    private val onButtonClick: (DoctorItemResponse) -> Unit
) : PagingDataAdapter<DoctorItemResponse, MyViewHolder>(DIFF_CALLBACK) {

    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): MyViewHolder {
        val binding = ItemRowDoctorBinding.inflate(
            LayoutInflater.from(parent.context),
            parent,
            false
        )
        return MyViewHolder(binding)
    }

    override fun onBindViewHolder(holder: MyViewHolder, position: Int) {
        val doctor = getItem(position)

        if (doctor != null) {
            holder.bind(doctor)
            holder.binding.btnRegistration.setOnClickListener {
                onButtonClick(doctor)
            }
        }
    }

    class MyViewHolder(val binding: ItemRowDoctorBinding) : RecyclerView.ViewHolder(binding.root) {
        fun bind(doctor: DoctorItemResponse) {
            Glide.with(itemView.context)
                .load(doctor.avatar)
                .apply(RequestOptions().override(50, 50))
                .into(binding.ivAvatar)
            binding.tvName.text = doctor.name
            binding.tvSpecialist.text = doctor.specialist
            binding.tvDate.text = doctor.date
            binding.tvOfficeHours.text = doctor.officeHours
            binding.tvRoom.text = doctor.room
        }
    }

    companion object {
        val DIFF_CALLBACK = object : DiffUtil.ItemCallback<DoctorItemResponse>() {
            override fun areItemsTheSame(
                oldItem: DoctorItemResponse,
                newItem: DoctorItemResponse
            ): Boolean {
                return oldItem.id == newItem.id
            }

            override fun areContentsTheSame(
                oldItem: DoctorItemResponse,
                newItem: DoctorItemResponse
            ): Boolean {
                return oldItem == newItem
            }
        }
    }
}