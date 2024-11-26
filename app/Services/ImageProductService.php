<?php
namespace App\Services;

use App\Repositories\ImageProductRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class ImageProductService
{
    protected $imageProductRepository;
    public function __construct(ImageProductRepository $imageProductRepository)
    {
        $this->imageProductRepository = $imageProductRepository;
    }

    public function create(array $data)
    {
        return $this->imageProductRepository->create($data);
    }

    public function delete($image)
    {
        DB::beginTransaction();
        try {
            $result = $this->imageProductRepository->delete($image);
            DB::commit();
            return $result;
        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    public function getById($id)
    {
        return $this->imageProductRepository->getById($id);
    }
}