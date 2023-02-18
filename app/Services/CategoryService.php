<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

//model
use App\Models\Category;
//repo

use Exception;
class CategoryService
{
    public function takeAllCategory(){
        return Category::get();
    }

    public function addCategory($name, $color, $image){
        Category::create([
            'name'=>$name,
            'main_color' => $color=='#000000'|| $color=='#FFFFFF'?CATEGORY_DEFAULT_COLOR:$color,
            'image' => $image??'',
        ]);
    }

    public function updateCategory($name, $color, $image, $categoryId){
        Category::find($categoryId)->update([
            'name' => $name,
            'main_color' => $color=='#000000'|| $color=='#FFFFFF'?CATEGORY_DEFAULT_COLOR:$color,
            'image' => $image??'',
        ]);
    }

    public function deleteCategory($categoryId){
        Category::find($categoryId)->delete();
    }

}
