<?php
namespace App\Services;

use App\Repositories\OrderLineRepository;

class OrderLineService
{
    protected $orderLineRepository;
    public function __construct(OrderLineRepository $orderLineRepository)
    {
        $this->orderLineRepository = $orderLineRepository;
    }

    public function create(array $data)
    {
        $this->orderLineRepository->create($data);
    }
}
