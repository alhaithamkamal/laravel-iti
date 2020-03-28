<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserResource;

class PostResource extends JsonResource
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
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->describtion,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'slug' => $this->slug,
            'image' => $this->image,
            'user' => new UserResource($this->user)
        ];
    }
}
