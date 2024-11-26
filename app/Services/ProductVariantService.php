<?php 
namespace App\Services;

use App\Repositories\ProductVariantRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class ProductVariantService
{
    protected $productVariantRepository;
    public function __construct(ProductVariantRepository $productVariantRepository)
    {
        $this->productVariantRepository = $productVariantRepository;
    }

    public function getById($id) 
    {
        return $this->productVariantRepository->getById($id);
    }

    public function getByIdForUpdate($id)
    {
        return $this->productVariantRepository->getByIdForUpdate($id);
    }

    public function create($data)
    {
        return $this->productVariantRepository->create($data);
    }

    public function update(array $data, $productVariant)
    {
        DB::beginTransaction();
        try {
            $result = $this->productVariantRepository->update($data, $productVariant);
            DB::commit();
            return $result;
        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    public function delete($productVariant)
    {
        DB::beginTransaction();
        try {
            $result = $this->productVariantRepository->delete($productVariant);
            DB::commit();
            return $result;
        } catch (Exception $e) {
            DB::rollBack();
        }
    }


    public function getproductVariantExists($productId,$color,$size)
    {
        return $this->productVariantRepository->getproductVariantExists($productId,$color, $size);
    }

    public function getByIdAndProduct($id, $productId)
    {
        return $this->productVariantRepository->getByIdAndProduct($id,$productId);
    }
    
    public function getDistinctColorByProduct($productId)
    {
        return $this->productVariantRepository->getDistinctColorByProduct($productId);
    }

    public function getDistinctSizeByProduct($productId)
    {
        return $this->productVariantRepository->getDistinctSizeByProduct($productId);
    }

    public function getImageByColorAndProduct($color,$productId)
    {
        return $this->productVariantRepository->getImageByColorAndProduct($color,$productId);
    }

    public function getSizeByColorAndProduct($color,$productId)
    {
        return $this->productVariantRepository->getSizeByColorAndProduct($color,$productId);
    }

    public function getQuantityProductVariant($productId, $color, $size) 
    {
        return $this->productVariantRepository->getQuantityProductVariant($productId, $color, $size);
    }

    public function getRemainQuantityById($id)
    {
        return $this->productVariantRepository->getRemainQuantityById($id);
    }

}