<?php

namespace App\Http\Controllers;

use App\Http\Resources\EntityResource;
use App\Models\Category;
use App\Traits\JsonResponses;
use Illuminate\Http\JsonResponse;

class APIController extends Controller
{
    use JsonResponses;

    /**
     * Get entities by category.
     *
     * @param int $category
     * @return JsonResponse
     */
    public function category(int $category)
    {
        $category = Category::find($category);

        if (!$category) {
            return $this->sendJsonResponse(false, [], 'Category not found', 404);
        }

        return $this->sendJsonResponse(true, EntityResource::collection($category->entities));
    }
}
