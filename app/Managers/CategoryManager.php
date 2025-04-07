<?php
declare(strict_types=1);

namespace App\Managers;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryManager
{
    public function index(): Collection
    {
        return Category::all();
    }

    public function getByUuid(string $uuid): ?Category
    {
        return Category::where('uuid', $uuid)->first();
    }

    public function create(array $data): Category
    {
    return Category::create([
        'name' => $data['name'],
    ]);
    }

    public function update(string $uuid, array $data): ?Category
    {
        $category = Category::where('uuid', $uuid)->first();

        if ($category) {
            $category->update($data);
            return $category;
        }
        return null;
    }

    public function delete(string $uuid): bool
    {
        $category = Category::where('uuid', $uuid)->first();

        if ($category) {
            return $category->delete();
        }
        return false;
    }
}
