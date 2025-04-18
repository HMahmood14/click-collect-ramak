<?php

declare(strict_types=1);

namespace App\Services;

use App\Managers\CategoryManager;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryServices
{
    protected $categoryManager;

    public function __construct(CategoryManager $categoryManager)
    {
        $this->categoryManager = $categoryManager;
    }

    public function getAll(): Collection
    {
        return $this->categoryManager->index();
    }

    public function getCategoryByUuid(string $uuid): ?Category
    {
        return $this->categoryManager->getByUuid($uuid);
    }

    public function createCategory(array $data): Category
    {
        return $this->categoryManager->create($data);
    }

    public function updateCategory(string $uuid, array $data): ?Category
    {
        return $this->categoryManager->update($uuid, $data);
    }

    public function deleteCategory(string $uuid): bool
    {
        return $this->categoryManager->delete($uuid);
    }
}
