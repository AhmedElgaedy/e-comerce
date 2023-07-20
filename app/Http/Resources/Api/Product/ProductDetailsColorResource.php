<?php

namespace App\Http\Resources\Api\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductDetailsColorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            'id'     => $this->id ,
            'color'   => $this->color ,
            'attachments' => $this->attachmentRelation->map(function ($item){
                return [
                    'id' => $item->id ,
                    'attachment' => asset($item->path)
                ];
            })->values()->all()
        ];
    }
}
