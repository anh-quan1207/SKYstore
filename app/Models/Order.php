<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        "order_code",
        "customer_id",
        "status",
        "total_amount",
        'discount',
    ];

    public function orderLines()
    {
        return $this->hasMany(OrderLine::class);
    }

    public function pay()
    {
        return $this->hasOne(Pay::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}