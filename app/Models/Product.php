<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Category;
use App\Models\Account;

class Product extends Model
{
    protected $table="products";
    protected $fillable=[
        'name',
        'category_id',
        'url_poster',
        'price',
    ];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function accounts(){
        return $this->hasMany(Account::class, 'product_id', 'id');
    }
}

