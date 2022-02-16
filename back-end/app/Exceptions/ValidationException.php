<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *      title="Validation Exception",
 *      description="Validation Exception response data",
 *      type="object"
 * )
 */
class ValidationException extends Exception
{
    /**
     * @OA\Property(
     *      title="message",
     *      description="Validation Exception message",
     *      example="Data cannot be validated."
     * )
     *
     * @var string
     */
    public $message;

    /**
     * @OA\Property(
     *      title="errors",
     *      description="Validation Exception errors",
     * )
     *
     * @var string[]
     */
    public $errors;

    public function __construct($errors)
    {
        $this->message = 'The given data was invalid.';
        $this->errors = $errors;

        parent::__construct($this->message, 422);
    }

    public function render(Request $request): JsonResponse
    {
        return response()->json([
            'message' => $this->getMessage(),
            'errors' => $this->errors
        ]);
    }
}
