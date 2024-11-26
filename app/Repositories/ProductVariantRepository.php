<?php
namespace App\Repositories;

use App\Models\ProductVariant;

class ProductVariantRepository 
{
    protected $productVariant;
    public function __construct(ProductVariant $productVariant) 
    {
        $this->productVariant = $productVariant;
    }

    public function getById($id)
    {
        return $this->productVariant->find($id);
    }

    public function getByIdForUpdate($id)
    {
        return $this->productVariant->where('id', $id)->lockForUpdate()->first();
    }

    public function create($data)
    {
        return $this->productVariant->create($data);
    }

    public function update(array $data, $productVariant)
    {
        $productVariant->update($data);
        return $productVariant;
    }

    public function delete($productVariant)
    {
        return $productVariant->delete();
    }

    public function getproductVariantExists($productId,$color,$size)
    {
        return $this->productVariant->where(['product_id' => $productId,'color' => $color, 'size' => $size])->first();
    }

    public function getByIdAndProduct($id, $productId)
    {
        return $this->productVariant->where(['id' => $id, 'product_id' => $productId])->first();
    }

    public function getDistinctColorByProduct($productId)
    {
        return $this->productVariant->where('product_id',$productId)->distinct()->pluck('color')->toArray();
    }

    public function getDistinctSizeByProduct($productId)
    {
        return $this->productVariant->where('product_id',$productId)->distinct()->pluck('size')->toArray();
    }

    public function getImageByColorAndProduct($color,$productId)
    {
        return $this->productVariant->where(['color'=> $color,'product_id'=> $productId])->pluck('image_path')->first();
    }

    public function getSizeByColorAndProduct($color,$productId)
    {
        return $this->productVariant->where(['color'=> $color,'product_id'=> $productId])->pluck('size')->toArray();
    }

    public function getQuantityProductVariant($productId, $color, $size)
    {
        return $this->productVariant->select(['id','remain_quantity','sold_quantity'])->where(['product_id' => $productId,'color' => $color, 'size' => $size])->first();
    }

    public function getRemainQuantityById($id)
    {
        return $this->productVariant->where('id',$id)->pluck('remain_quantity')->first();
    }
}