<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Admin;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('admin.auth');
    }
    public function index(){

    }
}
