<?php
namespace App\Services;

use App\Models\Category;
use App\Repositories\CategoryRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class CategoryService
{
    protected $categoryRepository;
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function create($data)
    {
        return $this->categoryRepository->createCategory($data);
    }

    public function getCategoryByName($data)
    {
        return $this->categoryRepository->getCategoryByName($data);
    }

    public function getAllCategoriesWithProducts()
    {
        return $this->categoryRepository->getAllCategoriesWithProducts();
    }

    public function getCategoryIds() : array
    {
        return $this->categoryRepository->getCategoryIds();
    }

    public function getCategories()
    {
        return $this->categoryRepository->getCategories();
    }

    public function getById($id)
    {
        return $this->categoryRepository->getById($id);
    }

    public function update(array $data, $category)
    {
        DB::beginTransaction();
        try {
            $result = $this->categoryRepository->update($data, $category);
            DB::commit();
            return $result;
        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    public function delete($category)
    {
        DB::beginTransaction();
        try {
            $result = $this->categoryRepository->delete($category);
            DB::commit();
            return $result;
        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    public function getByParentCategory($parentCategory)
    {
        return $this->categoryRepository->getByParentCategory($parentCategory);
    }

    public function getIdsByParentCategory($parentCategory)
    {
        return $this->categoryRepository->getIdsByParentCategory($parentCategory);
    }

    public function getByIdWithProducts($id)
    {
        return $this->categoryRepository->getByidWithProducts($id);
    }

}