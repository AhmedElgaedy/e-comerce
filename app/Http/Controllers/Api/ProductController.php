<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Product\ProductAllNewrCollection;
use App\Http\Resources\Api\Product\ProductBestOfferCollection;
use App\Http\Resources\Api\Product\ProductBestSellingCollection;
use App\Http\Resources\Api\Product\ProductCollection;
use App\Http\Resources\Api\Product\ProductDetailsResource;
use App\Http\Resources\Api\Rate\RateCollection;
use App\Http\Resources\Category\CategoryCollection;
use App\Models\Category;
use App\Models\Product;
use App\Models\Rate;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $product  ;
    public function __construct()
    {
        $this->product = new Product;
    }

    public function search(Request $request , $query_search)
    {
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

        return $query_search ;
    }
    public function allBestSelling(Request $request)
    {

        $best_selling = $this->product->query() ;
        $this->search($request , $best_selling);
        $products  =  $best_selling->stock()->selling()->latest()->paginate(6) ;
        return $this->successData(new ProductBestSellingCollection($products));
    }

    public function allBestOffer(Request $request)
    {

        $best_selling = $this->product->query() ;
        $this->search($request , $best_selling);
        $products  =  $best_selling->stock()->offer()->latest()->paginate(6) ;
        return $this->successData(new ProductBestOfferCollection($products));
    }


    public function allNewCollection(Request $request)
    {
        $best_selling = $this->product->query() ;
        $this->search($request , $best_selling);
        $products  =  $best_selling->stock()->new()->latest()->paginate(6) ;
        return $this->successData(new ProductAllNewrCollection($products));
    }

    public function productWithCategory($id,Request $request)
    {
        $best_selling = $this->product->query() ;
        $this->search($request , $best_selling);
        $products  =  $best_selling->where('category_id' , $id)->stock()->new()->latest()->paginate(6) ;
        return $this->successData(new ProductCollection($products));
    }


    public function listCategory()
    {
        $categories = Category::paginate(6);
        return $this->successData(new CategoryCollection($categories));
    }


    public function productWithId($id)
    {
        $record = $this->product->with('productDetails')->findOrFail($id);

        return $this->successData(new ProductDetailsResource($record));

    }


    public function rates($product_id)
    {
        $records = Rate::where('product_id' , $product_id)->paginate(6);

        return $this->successData(new RateCollection($records));

    }
    //
}
