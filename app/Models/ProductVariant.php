<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductVariant extends Model
{
    use HasFactory;

    use SoftDeletes;
    protected $fillable = [
        "product_id",
        "color",
        "size",
        "sold_quantity",
        "remain_quantity",
        "image_path"
    ];
    protected $casts = [
        "created_at" => "datetime",
        "updated_at" => "datetime",
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function productWithTrashed()
    {
        return $this->belongsTo(Product::class,'product_id')->withTrashed();
    }
}