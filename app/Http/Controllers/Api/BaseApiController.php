<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;


/**
 * @OA\Info(
 *   version="1.0.0",
 *   title="Watkanikdoen.nl API",
 *   description="API for Watkanikdoen.nl",
 *   @OA\Contact(
 *      email="info@watkanikdoen.nl"
 *   ),
 * )
 * @OA\Server(
 *   url="/api/v1",
 *   description="API V1"
 * )
 */

class BaseApiController extends Controller
{
    /**
     * Success response method.
     *
     * @param mixed $result
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    protected function sendResponse($result, string $message = 'Success', int $code = 200): JsonResponse
    {
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message,
        ];

        return response()->json($response, $code);
    }

    /**
     * Return error response.
     *
     * @param string $error
     * @param array $errorMessages
     * @param int $code
     * @return JsonResponse
     */
    protected function sendError(string $error, array $errorMessages = [], int $code = 404): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['errors'] = $errorMessages;
        }

        return response()->json($response, $code);
    }

    /**
     * Return validation error response.
     *
     * @param array $errors
     * @param string $message
     * @return JsonResponse
     */
    protected function sendValidationError(array $errors, string $message = 'Validation Error'): JsonResponse
    {
        return $this->sendError($message, $errors, 422);
    }

    /**
     * Return unauthorized response.
     *
     * @param string $message
     * @return JsonResponse
     */
    protected function sendUnauthorized(string $message = 'Unauthorized'): JsonResponse
    {
        return $this->sendError($message, [], 401);
    }

    /**
     * Return forbidden response.
     *
     * @param string $message
     * @return JsonResponse
     */
    protected function sendForbidden(string $message = 'Forbidden'): JsonResponse
    {
        return $this->sendError($message, [], 403);
    }
}
