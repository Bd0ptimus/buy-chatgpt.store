<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\PaymentMethod;
use App\Models\Account;
class Checkout extends Model
{
    use HasFactory;
    protected $table = 'checkouts';

    protected $fillable = [
        'payment_method_id',
        'receiver_email',
        'checkout_code',
        'amount_products',
        'product_id',
        'sum',
        'status',
    ];

    public function paymentMethod(){
        return $this->belongsTo(PaymentMethod::class,'payment_method_id', 'id');
    }

    public function accounts(){
        return $this->hasMany(Account::class, 'checkout_complete_id', 'id');
    }
}
