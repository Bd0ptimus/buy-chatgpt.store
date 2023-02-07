<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\ProductService;
use App\Models\Category;
class ProductController extends Controller
{
    protected $productService;
    public function __construct(ProductService $productService){
        $this->productService = $productService;
    }
    public function index(Request $request, $categoryId){
        $products = $this->productService->takeAllProducts($categoryId);
        $categories = Category::get();
        return view('user.products',[
            'products' => $products,
            'categoryId' => $categoryId,
            'categories' => $categories,
        ]);
    }

}
