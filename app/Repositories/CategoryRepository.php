<?php

namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAllCategories()
    {
        return Category::all();
    }

    public function getCategoryById($tagId)
    {
        return Category::findOrFail($tagId);
    }

    public function deleteCategory($tagId)
    {
        Category::destroy($tagId);
    }

    public function createCategory(array $tagDetails)
    {
        return Category::create($tagDetails);
    }

    public function updateCategory($tagId, array $newDetails)
    {
        return Category::whereId($tagId)->update($newDetails);
    }
}
