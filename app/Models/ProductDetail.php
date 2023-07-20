<?php

namespace App\Models;

use App\Traits\GetAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ProductDetail extends BaseModel
{
    use HasFactory;


    use GetAttribute , HasTranslations;
    protected $fillable = ['product_id' , 'color'];
    public $translatable = ['color'];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->multiple_attachment = true;
        $this->multiple_attachment_usage = ['default', 'bdf-file'];
    }
}
