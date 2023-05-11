<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class DoctorResource extends ResourceCollection
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
            'code' => 200,
            'status' => 'OK',
            'data' => $this->collection->map(function ($item, $key) {
                return [
                    'id' => $item->id,
                    'avatar' => $item->avatar_url,
                    'name' => $item->name,
                    'specialist' => $item->specialist,
                    'date' => "{$item->day}, {$item->date}",
                    'office_hours' => "{$item->start_time} - {$item->end_time}",
                    'room' => $item->room,
                    'active' => $item->active,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at,
                ];
            })->toArray(),
        ];
    }
}
