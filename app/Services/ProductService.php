<?php
namespace App\Services;

use App\Repositories\ProductRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class ProductService
{
    const ORDER_STATUS_RECEIVED = 4;
    protected $productRepository;
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;  
    }

    public function create(array $data)
    {
        return $this->productRepository->create($data);
    }

    public function update(array $data, $product)
    {
        DB::beginTransaction();
        try {
            $result =  $this->productRepository->update($data, $product);
            DB::commit();
            return $result;
        } catch(Exception $e) {
            DB::rollBack();
        }
    }

    public function delete($product)
    {
        DB::beginTransaction();
        try {
            $result = $this->productRepository->delete($product);
            DB::commit();
            return $result;
        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    public function getProducts()
    {
        return $this->productRepository->getProducts();
    }

    public function existsProductName($productName)
    {
        return $this->productRepository->existsProductName($productName);
    }

    public function getById($id)
    {
        return $this->productRepository->getById($id);
    }

    public function getByIdWithImage($id)
    {
        return $this->productRepository->getByIdWithImage($id);
    }

    public function getByIdWithProductVariants($id)
    {
        return $this->productRepository->getByIdWithProductVariants($id);
    }

    public function getByCategories(array $categoryIds) 
    {
        return $this->productRepository->getByCategories($categoryIds);
    }

    public function getByCategoriesAndName(array $categoryIds, $productName)
    {
        return $this->productRepository->getByCategoriesAndName($categoryIds, $productName);
    }

    public function getByCategory($categoryId)
    {
        return $this->productRepository->getByCategory($categoryId);
    }

    // top san pham theo so don hang
    public function getTopProductOrderByMonth()
    {
        $yearNow = now()->year;
        $monthNow = now()->month;
        $status = self::ORDER_STATUS_RECEIVED;
        return $this->productRepository->getTopProductOrderByMonth($yearNow, $monthNow, $status);
    }


    // top san pham theo doanh thu
    public function getTopProductRevenueByMonth()
    {
        $yearNow = now()->year;
        $monthNow = now()->month;
        $status = self::ORDER_STATUS_RECEIVED;
        return $this->productRepository->getTopProductRevenueByMonth($yearNow, $monthNow, $status);
    }

    public function getBestSellingProducts()
    {
        $yearNow = now()->year;
        $monthNow = now()->month;
        $status = self::ORDER_STATUS_RECEIVED;
        return $this->productRepository->getBestSellingProducts($yearNow, $monthNow, $status);
    }

}