<?php

namespace App\Models;

use App\Models\Traits\Product\Attribute;
use App\Models\Traits\Product\Relation;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Product extends BaseModel
{
    use HasFactory;
    use HasTranslations , Relation , Attribute;

    const IMAGEPATH = 'products' ;

    protected $fillable = [
        'name',
        'description',
        'quantity',
        'price_after_product' ,
        'price_before_product',
        'category_id' ,
        'image',
        'discount' ,
        'best_selling' ,
        'best_offer' ,
        'total_rate'
    ];
    public $translatable = ['name' , 'description'];
}
