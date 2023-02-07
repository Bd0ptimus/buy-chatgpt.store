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
use App\Models\Account;

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
            $this->categoryService->addCategory($request->name, $request->color, $request->image);
            return redirect()->route('admin.category.index');
        }
    }

    public function updateCategory(Request $request, $categoryId)
    {
        $this->categoryService->updateCategory($request->categoryName,$request->categoryColor,$request->categoryImage, $categoryId);
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
            'accounts' => $accounts,
        ]);
    }

    public function addProductForm(Request $request, $categoryId){
        $category = Category::find($categoryId);

        return view('admin.products.createProduct',[
            'categoryId'=>$categoryId,
            'categoryName' => $category->name,
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
            $params['des'] = $request->description;
            $params['star'] = $request->star;
            $params['status'] = $request->status;

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
        $params['des'] = $request->productDes;
        $params['star'] = $request->productStar;
        $params['status'] = $request->productStatus;

        $this->productService->updateProduct($params, $productId);
        return redirect()->back();
    }

    public function deleteProduct(Request $request, $productId){
        $this->productService->deleteProduct( $productId);
        return redirect()->back();
    }

    //Account manager
    private function addAccountValidator($request)
    {
        $messages = [
            'username.required' => 'Username/Email mới bắt buộc phải được nhập.',
            'password.required' => 'Mật khẩu bắt buộc phải được nhập.',

        ];

        $validator = Validator::make($request, [
            'username'    => 'required',
            'password'    => 'required',


        ], $messages);

        return $validator;
    }

    public function addAccountForm(Request $request, $categoryId){
        $products = Product::where('category_id', $categoryId)->get();
        $category = Category::find($categoryId);
        return view('admin.products.createAccount',[
            'products' => $products,
            'categoryName' =>$category->name,
            'categoryId' =>$category->id,

        ]);
    }
    public function addAccount(Request $request, $categoryId){
        $validator = $this->addAccountValidator($request->all());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        } else {
            if($request->product==0){
                return redirect()->back()->withErrors($validator->errors()->add('product', 'Sản phẩm phải được chọn'))->withInput($request->all());
            }
            $account = Account::where('product_id', $request->product)->where('account', $request->username)->first();
            if (isset($account)) {
                return redirect()->back()->withErrors($validator->errors()->add('username', 'Tài khoản này đã tồn tại'))->withInput($request->all());
            }
            $params['username'] = $request->username;
            $params['password'] = $request->password;
            $params['productId'] = $request->product;
            $this->accountService->addNewAccount($params);
            return redirect()->route('admin.product.index',[
                'categoryId'=>$categoryId,
            ]);
        }
    }

    private function updateAccountValidator($request)
    {
        $messages = [
            'accountUsername.required' => 'Username/Email mới bắt buộc phải được nhập.',
            'accountPassword.required' => 'Mật khẩu bắt buộc phải được nhập.',
            'accountProduct.required' => 'accountProduct bắt buộc phải được nhập.',

        ];

        $validator = Validator::make($request, [
            'accountUsername'    => 'required',
            'accountPassword'    => 'required',
            'accountProduct'=> 'required',

        ], $messages);

        return $validator;
    }

    public function updateAccount(Request $request, $accountId){
        $validator = $this->updateAccountValidator($request->all());
        // dd($validator->fails());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        } else {
            $account = Account::where('product_id', $request->accountConfirm)->where('account', $request->accountUsername)->first();
            if (isset($account)) {
                return redirect()->back()->withErrors($validator->errors()->add('accountUsername', 'Tài khoản này đã tồn tại'))->withInput($request->all());
            }
            $params['username'] = $request->accountUsername;
            $params['password'] = $request->accountPassword;
            $this->accountService->updateAccount($params, $accountId);
            return redirect()->back();
        }
    }

    public function deleteAccount(Request $request, $accountId){
        $this->accountService->deleteAccount($accountId);
        return redirect()->back();
    }
}
