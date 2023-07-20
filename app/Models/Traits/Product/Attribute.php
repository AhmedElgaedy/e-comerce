<?php

namespace App\Models\Traits\Product;

use Carbon\Carbon;

trait Attribute
{
    public function scopeStock($query)
    {
        return $query->where('quantity' , '>' , 0);
    }

    public function scopeSelling($query)
    {
        return $query->where('best_selling' , '='  , 1);
    }

    public function scopeOffer($query)
    {
        return $query->where('best_offer' , '='  , 1);
    }

    public function scopeNew($query)
    {
        return $query->where('created_at' , '<=' , Carbon::now()->subDays(3)  );
    }
}