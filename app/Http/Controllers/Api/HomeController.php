<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Home\ServiceCollection;
use App\Http\Resources\Api\Home\SlideResource;
use App\Http\Resources\Api\Product\BestOfferResource;
use App\Http\Resources\Api\Product\BestSellingResource;
use App\Http\Resources\Api\Product\ProductCollection;
use App\Http\Resources\Api\Product\ProductResource;
use App\Http\Resources\Api\Product\ProductWithCategory;
use App\Http\Resources\Category\CategoryCollection;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
        protected $product  ;
        public function __construct()
        {
            $this->product = new Product;
        }

    public function index(Request $request)
    {
        $images = Image::get() ;
        $catgories = Category::paginate(3);
        $best_selling = $this->product->stock()->selling()->take(3)->latest()->get() ;
        $best_offer = $this->product->stock()->offer()->take(3)->latest()->get() ;
        $new_collection = $this->product->stock()->new()->take(3)->latest()->get() ;
        $by_first_category = Category::whereHas('products')
            ->with('products')
            ->inRandomOrder()->first();
        $by_second_category = Category::whereHas('products')
            ->with('products')
            ->inRandomOrder()->first();
        return $this->successData([
            'slides'    => SlideResource::collection($images) ,
            'categories'    => new CategoryCollection($catgories) ,
            'best_selling'  => BestSellingResource::collection($best_selling) ,
            'best_offer'  => BestOfferResource::collection($best_offer) ,
            'new_collection'  => ProductResource::collection($new_collection) ,
            'first_product_with_category' =>new ProductWithCategory($by_first_category) ,
            'second_product_with_category' =>new ProductWithCategory($by_second_category) ,
        ]);
    }


    public function search(Request $request)
    {
        $query_search = $this->product->query();
            if ($request->name){
                $query_search->whereFuzzy('name' , $request->name);
            }



        if ($request->rate)
        {
                $filter = json_decode($request->rate , true);
                $query_search->whereIn('total_rate' , array_values($filter));
        }

        if ($request->price_from && $request->price_to){
            $query_search->where('price_after_discount' , '>=' , $request->price_from)
                ->where('price_after_discount' , '<' , $request->price_to);
        }


        if ($request->best_selling){
            $query_search->selling();
        }

        if ($request->offer){
            $query_search->offer();
        }
        if ($request->wit_out_offer){
            $query_search->orWhere('best_offer' , '=' , 0);
        }
        $products= $query_search->stock()->latest()->paginate(4);
        return $this->successData(new ProductCollection($products));
    }
}
