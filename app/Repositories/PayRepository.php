<?php
namespace App\Repositories;

use App\Models\Pay;

class PayRepository 
{
    protected $pay;
    public function __construct(Pay $pay)
    {
        $this->pay = $pay;
    }

    public function create(array $data)
    {
        return $this->pay->create($data);
    }
}