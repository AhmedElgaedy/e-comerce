<?php

namespace App\Http\Resources\Api\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductDetailsResource extends JsonResource
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
            'id'     => $this->id  ,
            'name'  => $this->name ,
            'quantity'   => $this->quantity ,

            'price_before_discount' => $this->price_before_discount ,
            'discount'   => $this->discount ,
            'price_after_discount' => $this->price_after_discount ,

            'image'  => $this->image ,
            'best_offer'  =>  $this->best_offer ,
            'best_selling'  =>  $this->best_selling ,
            'rate'  => $this->total_rate ,
            'category_id'    => $this->category_id ,
            'colors'     => ProductDetailsColorResource::collection($this->productDetails)
        ];
    }
}
