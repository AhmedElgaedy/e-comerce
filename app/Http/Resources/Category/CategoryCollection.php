<?php

namespace App\Http\Resources\Category;

use App\Traits\PaginationTrait;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryCollection extends ResourceCollection
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
            'data' => CategoryResource::collection($this) ,
            'pagination' => $this->paginationModel($this)
        ];
    }
}
