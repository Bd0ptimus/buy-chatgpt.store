<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\LOG;
use App\Admin;

use App\Models\Category;
use App\Services\CategoryService;
class UiController extends Controller
{
    protected $categoryService;
    public function __construct(CategoryService $categoryService){
        $this->categoryService = $categoryService;
    }
    public function index(Request $request){
        try{
            $categories = $this->categoryService->takeAllCategory();
            $response['navbar']='';
            foreach($categories as $category){
                $response['navbar']=$response['navbar'].'<li class="nav-item">
                                                                <a class="nav-link" href="'.route('product.index',['categoryId'=>$category->id]).'">Tài khoản '.$category->name.'</a>
                                                            </li>';
            }

            $response['isAdmin'] = false;
            if(Admin::user()!==null){
                $response['isAdmin']= true;
            }
        }catch(\Exception $e){
            LOG::debug('error in addCategory : ' . $e );
            return response()->json(['error' => 1, 'msg' => 'Đã có lỗi']);
        }
        return response()->json(['error' => 0, 'msg' => 'load category thanh cong', 'data'=> $response]);
    }
}
