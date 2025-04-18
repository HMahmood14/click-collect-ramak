<?php

declare(strict_types=1);

namespace Tests\Unit\Category;

use App\Models\Admin;
use App\Models\Category;
use App\Services\CategoryServices;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $categoryService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->categoryService = \Mockery::mock(CategoryServices::class);
        $this->actingAs(Admin::factory()->create(), 'admin');
    }

    public function testCanSeeAllCategoriesOnIndexPage(): void
    {
        Category::factory()->count(5)->create();

        $response = $this->get(route('category.index'));
        $response->assertStatus(200);
        $response->assertViewIs('category.index');
        $response->assertViewHas('categories');
    }

    public function testCanCreateACategory(): void
    {
        $categoryData = [
            'name' => 'Test Categorie',
        ];

        $response = $this->post(route('category.store'), $categoryData);

        $response->assertRedirect(route('category.index'));
        $response->assertSessionHas('success', 'Categorie succesvol toegevoegd.');

        $this->assertDatabaseHas('categories', [
            'name' => 'Test Categorie',
        ]);
    }

    public function testCanUpdateACategory(): void
    {
        $category = Category::factory()->create();

        $updatedCategoryData = [
            'name' => 'Updated Categorie',
        ];

        $response = $this->put(route('category.update', $category->uuid), $updatedCategoryData);

        $response->assertRedirect(route('category.index'));
        $response->assertSessionHas('success', 'Categorie succesvol aangepast.');

        $this->assertDatabaseHas('categories', [
            'name' => 'Updated Categorie',
        ]);
    }

    public function testCanDeleteACategory(): void
    {
        $category = Category::factory()->create();

        $response = $this->delete(route('category.delete', $category->uuid));

        $response->assertRedirect(route('category.index'));
        $response->assertSessionHas('success', 'Categorie succesvol verwijderd.');

        $this->assertDatabaseMissing('categories', [
            'uuid' => $category->uuid,
        ]);
    }
}
