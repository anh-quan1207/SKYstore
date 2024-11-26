<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartApiController extends Controller
{
    protected $cartService;
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function getNewValue(Request $request)
    {
        $id = $request->input('id');
        $quantity = $request->input('quantity');
        $cart = $this->cartService->getById($id);
        $customerId =  $cart->customer_id;
        $total = 0;
        if(!is_null($cart))
        {
            $productVariant = $cart->productVariant;
            if((int) $quantity > $cart->productVariant->remain_quantity){
                $quantity = $cart->productVariant->remain_quantity;
            }
            if((int) $quantity < 1)
            {
                $quantity = 1;            }
            $data['quantity'] = $quantity;
            $data['total_amount'] = $quantity * priceDiscount($productVariant->product->price, $productVariant->product->discount);
            $this->cartService->update($data,$cart);
            $carts = $this->cartService->getByCustomer($customerId);
            foreach ($carts as $cart) {
                $price = $cart->productVariant->product->price;
                $discount = $cart->productVariant->product->discount;
                $total += $cart->quantity * priceDiscount($price, $discount);
            }

            return response()->json([
                'status_code' => 200,
                'quantity' => $data['quantity'],
                'total_amount' => $data['total_amount'],
                'total' => $total,
            ]);
        }
    }
}