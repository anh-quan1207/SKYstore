<?php

namespace App\Http\Controllers;

use App\Services\ProductVariantService;
use Illuminate\Http\Request;

class ProductVariantApiController extends Controller
{
    protected $productVariantService;
    public function __construct(ProductVariantService $productVariantService)
    {
        $this->productVariantService = $productVariantService;
    }

    public function getImageAndSize(Request $request) 
    {
        $productId = $request->input('productId');
        $color = $request->input('color');
        $image = $this->productVariantService->getImageByColorAndProduct($color, $productId);
        $sizes = $this->productVariantService->getSizeByColorAndProduct($color, $productId);
        return response()->json([
            'status_code' => 200,
            'image' => $image,
            'sizes' => $sizes,
        ]);
    }

    public function getQuantity(Request $request)
    {
        $productId = $request->input('productId');
        $color = $request->input('color');
        $size = $request->input('size');
        $productVariant = $this->productVariantService->getQuantityProductVariant($productId,$color,$size);
        return response()->json([
            'status_code' => 200,
            'productVariant' => $productVariant,
        ]);
    }

    public function getRemainQuantity(Request $request)
    {
        $id = $request->input('productVariantId');
        $remainQuantity = $this->productVariantService->getRemainQuantityById($id);
        return response()->json([
            'status_code' => 200,
            'remainQuantity' => $remainQuantity,
        ]);
    }

    
}