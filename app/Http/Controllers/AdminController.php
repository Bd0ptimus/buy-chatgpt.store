<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Admin;

use App\Services\CategoryService;
use App\Models\Category;
class AdminController extends Controller
{
    protected $categoryService;
    public function __construct(CategoryService $categoryService){
        $this->middleware('admin.auth');
        $this->categoryService = $categoryService;
    }

    //Category manager
    public function categoryManager(Request $request){
        $categories = $this->categoryService->takeAllCategory();
        return view('admin.categories.index',[
            'categories'=> $categories,
        ]);
    }

    private function addCategoryValidator($request){
        $messages = [
            'name.required' => 'Tên nhóm sản phẩm mới bắt buộc phải được nhập.',
        ];

        $validator = Validator::make($request, [
            'name'    => 'required',

        ], $messages);

        return $validator;
    }

    public function addCategory(Request $request){
        $validator = $this->addCategoryValidator($request->all());
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }else{
            $category =Category::where('name',$request->name)->first();
            if(isset($category)){
                return redirect()->back()->withErrors($validator->errors()->add('name', 'Nhóm sản phẩm này đã tồn tại'))->withInput($request->all());
            }
            $this->categoryService->addCategory($request->name);
            return redirect()->route('admin.category.index');
        }

    }

    public function updateCategory(Request $request, $categoryId){
        $this->categoryService->updateCategory($request->categoryName, $categoryId);
        return redirect()->route('admin.category.index');
    }

    public function deleteCategory(Request $request, $categoryId){
        $this->categoryService->deleteCategory( $categoryId);
        return redirect()->route('admin.category.index');
    }
}
