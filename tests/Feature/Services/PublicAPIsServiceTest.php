<?php

namespace Tests\Feature\Services;

use App\Models\Category;
use App\Models\Entity;
use App\Services\PublicAPIsService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicAPIsServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_and_store_entities()
    {
        $service = new PublicAPIsService();
        $entities = $service->getEntries([], true);
        $category = Category::factory()->create([
            'category' => data_get($entities, '0.Category', 'TestCategory')
        ]);
        $entity = Entity::factory()->create([
            'api' => data_get($entities, '0.API', ''),
            'description' => data_get($entities, '0.Description', ''),
            'link' => data_get($entities, '0.Link', ''),
            'category_id' => $category->id
        ]);

        $this->assertIsArray($entities);
        $this->assertNotEmpty($entities);
        $this->assertModelExists($entity);
    }
}
