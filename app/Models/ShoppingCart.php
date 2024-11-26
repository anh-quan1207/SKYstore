<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    use HasFactory;

    protected $fillable = [
        "customer_id",
        "product_variant_id",
        "quantity",
        "total_amount",
        "price"
    ];

    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class); 
    }
}