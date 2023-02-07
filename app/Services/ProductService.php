<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

//model
use App\Models\Product;
//repo

use Exception;
class ProductService
{

    public function takeAllProducts($categoryId){
        return Product::where('category_id', $categoryId)->get();
    }

    public function createProduct($params,$categoryId){
        Product::create([
            'name' => $params['name'],
            'price' => $params['price'],
            'category_id' => $categoryId,
            'url_poster'=>$params['poster']??PRODUCT_URL_POSTER_SAMPLE,
            'description' => $params['des'],
            'star' => $params['star'],
            'status' => $params['status'],

        ]);
    }

    public function updateProduct($params, $productId){
        Product::find($productId)->update([
            'name' => $params['name'],
            'price' => $params['price'],
            'url_poster' => $params['poster'] ?? PRODUCT_URL_POSTER_SAMPLE,
            'description' => $params['des'],
            'star' => $params['star'],
            'status' => $params['status'],

        ]);
    }

    public function deleteProduct($productId){
        Product::find($productId)->delete();
    }
}
