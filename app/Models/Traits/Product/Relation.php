<?php

namespace App\Models\Traits\Product;

use App\Models\Category;
use App\Models\ProductDetail;
use App\Models\Rate;

trait Relation
{
    public function category(){
        return $this->belongsTo(Category::class);
    }


    public function rate()
    {
        return $this->hasMany(Rate::class);
    }

    public function productDetails()
    {
        return $this->hasMany(ProductDetail::class);
    }
}