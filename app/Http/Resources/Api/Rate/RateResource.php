<?php

namespace App\Http\Resources\Api\Rate;

use Illuminate\Http\Resources\Json\JsonResource;

class RateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id ,
            'user'   => new UserResource($this->user) ,
            'rate'  => $this->rate ,
            'notes'  => $this->notes
        ];
    }
}
