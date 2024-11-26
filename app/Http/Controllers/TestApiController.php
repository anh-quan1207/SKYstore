<?php

namespace App\Http\Controllers;

use App\Services\ProductVariantService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestApiController extends Controller
{
    protected $productVariantService;
    public function __construct(ProductVariantService $productVariantService)
    {
        $this->productVariantService = $productVariantService;
    }

    public function getProductVariantById(Request $request)
    {
        $productVariantId = $request->input('id');
        $productVariant = $this->productVariantService->getById($productVariantId);
        return response()->json([
            'status_code' => 200,
            'productVariant' => $productVariant,
        ]);
    }

    public function checkAndUpdateQuantityProductVariant(Request $request)
    {
        $productVariantId = $request->input('id');
        DB::beginTransaction();
        try {
            $productVariant = $this->productVariantService->getByIdForUpdate($productVariantId);
            $remainQuantity = $productVariant->remain_quantity;
            if ($remainQuantity > 0) {
                $productVariant->remain_quantity -= 1;
                $productVariant->save();
                DB::commit();
                return response()->json([
                    'status_code' => 200,
                    'message' => 'update số lượng thành công'
                ]);
            } else {
                return response()->json([
                    'status_code' => 500,
                    'message' => 'số lượng sản phẩm không đủ'
                ]);
            }
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status_code' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function updateRemainQuantity(Request $request)
    {
        $productVariantId = $request->input('id');
        DB::beginTransaction();
        try {
            $productVariant = $this->productVariantService->getById($productVariantId);
            $remainQuantity = $productVariant->remain_quantity;
            if ($remainQuantity > 0) {
                $productVariant->remain_quantity -= 1;
                $productVariant->save();
                DB::commit();
                return response()->json([
                    'status_code' => 200,
                    'message' => 'update số lượng thành công'
                ]);
            } else {
                return response()->json([
                    'status_code' => 500,
                    'message' => 'số lượng sản phẩm không đủ'
                ]);
            }
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status_code' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }
}
