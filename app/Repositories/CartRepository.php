<?php 
namespace App\Repositories;
use App\Models\ShoppingCart;

class CartRepository 
{
    protected $cart;
    public function __construct(ShoppingCart $cart)
    {
        $this->cart = $cart;
    }

    public function create(array $data)
    {
        return $this->cart->create($data);
    }

    public function getByProductVariantAndCustomer($productVariantId,$customerId)
    {
        return $this->cart->where(["product_variant_id" => $productVariantId, "customer_id" => $customerId])->first();
    }

    public function update(array $data, $cart)
    {
        return $cart->update($data);
    }

    public function getByCustomer($customerId)
    {
        return $this->cart->where("customer_id", $customerId)->get();
    }

    public function getById($id)
    {
        return $this->cart->find($id);
    }

    public function getByIds(array $cartIds)
    {
        return $this->cart->whereIn('id',$cartIds)->get();
    }

    public function delete($id)
    {
        $cart = $this->cart->find($id);
        return $cart->delete();
    }

}