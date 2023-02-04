<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Admin;

use App\Services\CategoryService;
use App\Services\ProductService;
use App\Services\AccountService;

use App\Models\Category;
use App\Models\Product;

class AdminController extends Controller
{
    protected $categoryService;
    protected $productService;
    protected $accountService;
    public function __construct(CategoryService $categoryService,
    ProductService $productService,
    AccountService $accountService)
    {
        $this->middleware('admin.auth');
        $this->categoryService = $categoryService;
        $this->productService = $productService;
        $this->accountService = $accountService;
    }

    public function index(Request $request)
    {
        return redirect()->route('admin.category.index');
    }

    //Category manager
    public function categoryManager(Request $request)
    {
        $categories = $this->categoryService->takeAllCategory();
        return view('admin.categories.index', [
            'categories' => $categories,
        ]);
    }

    private function addCategoryValidator($request)
    {
        $messages = [
            'name.required' => 'Tên nhóm sản phẩm mới bắt buộc phải được nhập.',
        ];

        $validator = Validator::make($request, [
            'name'    => 'required',

        ], $messages);

        return $validator;
    }

    public function addCategory(Request $request)
    {
        $validator = $this->addCategoryValidator($request->all());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        } else {
            $category = Category::where('name', $request->name)->first();
            if (isset($category)) {
                return redirect()->back()->withErrors($validator->errors()->add('name', 'Nhóm sản phẩm này đã tồn tại'))->withInput($request->all());
            }
            $this->categoryService->addCategory($request->name);
            return redirect()->route('admin.category.index');
        }
    }

    public function updateCategory(Request $request, $categoryId)
    {
        $this->categoryService->updateCategory($request->categoryName, $categoryId);
        return redirect()->route('admin.category.index');
    }

    public function deleteCategory(Request $request, $categoryId)
    {
        $this->categoryService->deleteCategory($categoryId);
        return redirect()->route('admin.category.index');
    }


    //Products manager
    public function productManager(Request $request, $categoryId)
    {
        $products = $this->productService->takeAllProducts($categoryId);
        $category = Category::find($categoryId);
        $accounts = $this->accountService->takeAllAccountDependOnCategory($categoryId);
        // dd($accounts);
        return view('admin.products.index', [
            'products' => $products,
            'categoryName' => $category->name,
            'categoryId' => $category->id,

        ]);
    }

    private function addProductValidator($request)
    {
        $messages = [
            'name.required' => 'Tên sản phẩm mới bắt buộc phải được nhập.',
            'price.required' => 'Giá sản phẩm mới bắt buộc phải được nhập.',

        ];

        $validator = Validator::make($request, [
            'name'    => 'required',
            'price'    => 'required',


        ], $messages);

        return $validator;
    }
    public function addProduct(Request $request, $categoryId)
    {
        $validator = $this->addProductValidator($request->all());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        } else {
            $category = Product::where('category_id', $categoryId)->where('name', $request->name)->first();
            if (isset($category)) {
                return redirect()->back()->withErrors($validator->errors()->add('name', 'Sản phẩm này đã tồn tại, hãy chọn tên khác'))->withInput($request->all());
            }
            $params['name'] = $request->name;
            $params['price'] = $request->price;
            $params['poster'] = $request->poster;
            $this->productService->createProduct($params, $categoryId);
            return redirect()->route('admin.product.index', [
                'categoryId' => $categoryId,
            ]);
        }
    }

    public function updateProduct(Request $request, $productId)
    {
        $params['name'] = $request->productName;
        $params['price'] = $request->productPrice;
        $params['poster'] = $request->productPoster;

        $this->productService->updateProduct($params, $productId);
        return redirect()->back();
    }

    public function deleteProduct(Request $request, $productId){
        $this->productService->deleteProduct( $productId);
        return redirect()->back();
    }
}
