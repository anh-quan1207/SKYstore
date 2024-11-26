<?php
namespace App\Repositories;

use App\Models\OrderLine;

class OrderLineRepository
{
    protected $orderLine;
    public function __construct(OrderLine $orderLine)
    {
        $this->orderLine = $orderLine;
    }

    public function create(array $data)
    {
        return $this->orderLine->create($data);
    }
}