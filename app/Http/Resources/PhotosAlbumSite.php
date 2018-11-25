<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PhotosAlbumSite extends JsonResource
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
            'name' => $this->name,
            'url' => url('/storage/images/' . $this->saved_name),
            'type' => $this->type,
            'creation_data' => $this->created_at
        ];
    }
}
