<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'code' => 201,
            'status' => 'Created',
            'data' => [
                'id' => $this->id,
                'name' => $this->name,
                'date_of_birth' => $this->date_of_birth,
                'type' => $this->type,
                'allergy' => $this->allergy,
                'status' => $this->status,
                'gender' => $this->gender,
                'doctor_id' => $this->doctor_id,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
        ];
    }
}
