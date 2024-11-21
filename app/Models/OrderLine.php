<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderLine extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'quantity' ,
        'price' ,
        'product_variant_id',
        'order_id',
    ];

    public function productVariantWithTrashed()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id')->withTrashed();
    }
}