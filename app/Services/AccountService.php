<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

//model
use App\Models\Account;
//repo

use Exception;
class AccountService
{

    public function takeAllAccountDependOnCategory($categoryId){
        return Account::whereHas('product', function($query) use ($categoryId){
            $query->where('category_id', $categoryId);
        })->get();
    }

    public function addNewAccount($params){
        Account::create([
            'account' => $params['username'],
            'password' => $params['password'],
            'product_id' => $params['productId'],
            'sold'=>ACCOUNT_NOT_SOLD,
        ]);
    }

    public function updateAccount($params, $accountId){
        Account::find($accountId)->update([
            'account' => $params['username'],
            'password' => $params['password'],
        ]);
    }

    public function deleteAccount($accountId){
        Account::find($accountId)->delete();
    }
}
