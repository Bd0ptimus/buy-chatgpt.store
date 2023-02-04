<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request, $categoryId){
        return view('user.products');
    }
    public function ChatGPTIndex(Request $request){
        return view('user.categories.chatgpt');
    }

    public function VpnIndex(Request $request){
        return view('user.categories.vpn');

    }
}
