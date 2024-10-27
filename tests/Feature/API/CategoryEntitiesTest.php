<?php

namespace Tests\Feature\API;

use App\Http\Resources\EntityResource;
use App\Models\Category;
use App\Models\Entity;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryEntitiesTest extends TestCase
{
    use RefreshDatabase;

    public function test_category_entities_response_success()
    {
        $category = Category::factory()->create();
        Entity::factory()->count(3)->create([
            'category_id' => $category->id
        ]);

        $response = $this->getJson(route('api.category', $category));
        $response->assertOk();
        $response->assertJsonCount(3, 'data');
        $response->assertJson([
            'success' => true,
            'data' => EntityResource::collection($category->entities)
                ->response()
                ->getData(true)['data']
        ]);
    }

    public function test_category_entities_response_not_found()
    {
        $category = Category::factory()->create();

        $response = $this->getJson(route('api.category', $category->id + 1));
        $response->assertNotFound();
        $response->assertJson([
            'success' => false,
            'message' => 'Category not found'
        ]);
    }
}
