<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait JsonResponses
{
    /**
     * Send a JSON response.
     *
     * @param bool $success
     * @param $data
     * @param string|null $message
     * @param int $status
     * @return JsonResponse
     */
    public function sendJsonResponse(bool $success = true, $data = [], string $message = null, int $status = 200): JsonResponse
    {
        $response['success'] = $success;

        if ($message) {
            $response['message'] = $message;
        }

        if ($data) {
            $response['data'] = $data;
        }

        return response()->json($response, $status);
    }
}
