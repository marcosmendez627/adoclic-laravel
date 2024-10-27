<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Entity;
use App\Services\PublicAPIsService;
use Illuminate\Database\Seeder;

class EntitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(PublicAPIsService $publicAPIService): void
    {
        $categories = Category::all(['id', 'category']);
        $categoriesNames = $categories->pluck('category')->toArray();
        $entities = $publicAPIService->getEntries($categoriesNames);

        foreach ($entities as $entity) {
            Entity::firstOrCreate([
                'api' => $entity['API'],
                'description' => $entity['Description'],
                'link' => $entity['Link'],
                'category_id' => $categories->firstWhere('category', $entity['Category'])->id
            ]);
        }
    }
}
