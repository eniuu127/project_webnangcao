<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Cart extends Model
{
    protected $table = 'cart';

    protected $fillable = ['user_id', 'product_id', 'quantity'];

    // Quan hệ: 1 Cart thuộc về 1 Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
