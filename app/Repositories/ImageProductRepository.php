<?php
namespace App\Repositories;

use App\Models\ImageProduct;

class ImageProductRepository
{
    protected $imageProduct;
    public function __construct(ImageProduct $imageProduct) 
    {
        $this->imageProduct = $imageProduct;
    }

    public function create(array $data)
    {
        return $this->imageProduct->create($data);
    }

    public function delete($image)
    {
        return $image->delete();
    }

    public function getById($id)
    {
        return $this->imageProduct->find($id);
    }
}