<?php

namespace App\Http\Resources\Api\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductWithCategory extends JsonResource
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
            'id'     => $this->id ,
            'name'  => $this->name ,
            'products'   => ProductResource::collection($this->products->take(3))
        ];
    }
}
