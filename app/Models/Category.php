<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Product;
class Category extends Model
{
    protected $table="categories";

    protected $fillable = [
        'name',
    ];

    public function products(){
        $this->hasMany(Product::class, 'category_id', 'id');
    }
}
