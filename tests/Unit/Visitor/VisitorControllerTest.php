<?php

declare(strict_types=1);

namespace Tests\Unit\Visitor;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VisitorControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testVisitorCanSeeCategoriesOnHomePage(): void
    {
        $categories = Category::factory()->count(3)->create();

        $response = $this->get(route('home'));

        $response->assertStatus(200);

        foreach ($categories as $category) {
            $response->assertSee($category->name);
        }
    }
}
