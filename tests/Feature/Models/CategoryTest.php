<?php

namespace Tests\Feature\Models;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the creation of a category.
     * @return void
     */
    public function test_create_category(): void
    {
        $category = Category::factory()->create();

        $this->assertModelExists($category);
    }

    /**
     * Test the category fields.
     * @return void
     */
    public function test_category_fields(): void
    {
        $category = Category::factory()->create();

        $this->assertIsString($category->category);
    }
}
