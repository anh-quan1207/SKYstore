<?php
namespace App\Services;

use App\Repositories\CartRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class CartService 
{
    protected $cartRepository;
    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;    
    }
    public function create(array $data)
    {
        return $this->cartRepository->create($data);
    }

    public function getByProductVariantAndCustomer($productVariantId,$customerId)
    {
        return $this->cartRepository->getByProductVariantAndCustomer($productVariantId,$customerId);
    }

    public function update(array $data, $cart)
    {
        DB::beginTransaction();
        try {
            $result =  $this->cartRepository->update($data, $cart);
            DB::commit();
            return $result;
        } catch(Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
    }

    public function getByCustomer($customerId)
    {
        return $this->cartRepository->getByCustomer($customerId);
    }

    public function getById($id)
    {
        return $this->cartRepository->getById($id);
    }

    public function getByIds(array $cartIds) 
    {
        return $this->cartRepository->getByIds($cartIds);
    }

    public function delete($id)
    {
        return $this->cartRepository->delete($id);
    }
}