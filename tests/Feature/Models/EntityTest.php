<?php

namespace Tests\Feature\Models;

use App\Models\Category;
use App\Models\Entity;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EntityTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the creation of an entity.
     * @return void
     */
    public function test_create_entity(): void
    {
        $category = Category::factory()->create();
        $entity = Entity::factory()->create([
            'category_id' => $category->id,
        ]);

        $this->assertModelExists($entity);
    }

    /**
     * Test the entity fields.
     * @return void
     */
    public function test_entity_fields(): void
    {
        $category = Category::factory()->create();
        $entity = Entity::factory()->create([
            'category_id' => $category->id,
        ]);

        $this->assertIsString($entity->api);
        $this->assertIsString($entity->description);
        $this->assertIsString($entity->link);
        $this->assertIsInt($entity->category_id);
    }
}
