<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AlbumSite extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'identifier' => $this->id,
            'name' => $this->name,
            'creation_data' => $this->created_at,
            'quantity_photos' => $this->photos->count(),
            'cover' => $this->photos->first() ? url('/storage/images/' . $this->photos->first()->saved_name) : ''
        ];
    }
}
