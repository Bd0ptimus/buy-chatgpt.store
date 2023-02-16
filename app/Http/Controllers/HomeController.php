<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Services\CheckoutService;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $checkoutService;
    public function __construct(CheckoutService $checkoutService)
    {
        $this->checkoutService = $checkoutService;
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $this->checkoutService->clearCheckoutOutdate();
        $products = Product::get();
        $categories = Category::with('products')->get();
        return view('home',[
            'categories' => $categories,
            'products' => $products,
            'categoryId' => 0,
        ]);
    }
}
