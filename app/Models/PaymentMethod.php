<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Checkout;
class PaymentMethod extends Model
{
    use HasFactory;
    protected $table = 'payment_methods';
    protected $fillable = [
        'bank_account_number',
        'name_receiver',
        'qr_url',
        'note',
        'payment_id',
    ];

    public function checkout(){
        return $this->hasOne(Checkout:: class , 'payment_method_id', 'id');
    }
}
