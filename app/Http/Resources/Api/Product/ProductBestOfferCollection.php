<?php

namespace App\Http\Resources\Api\Product;

use App\Traits\PaginationTrait;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductBestOfferCollection extends ResourceCollection
{
    use PaginationTrait ;
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data' => BestOfferResource::collection($this) ,
            'paginate'   => $this->paginationModel($this) ,
        ];
    }
}
