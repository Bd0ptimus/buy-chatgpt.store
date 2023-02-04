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

    public function addCategory($name){
        Category::create([
            'name'=>$name,
        ]);
    }

    public function updateCategory($name, $categoryId){
        Category::find($categoryId)->update([
            'name' => $name,
        ]);
    }

    public function deleteCategory($categoryId){
        Category::find($categoryId)->delete();
    }

}
