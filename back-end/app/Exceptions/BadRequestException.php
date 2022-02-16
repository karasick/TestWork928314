<?php

namespace App\Exceptions;

/**
 * @OA\Schema(
 *      title="Bad Request Exception",
 *      description="Bad Request Exception response data",
 *      type="object"
 * )
 */
class BadRequestException extends \Symfony\Component\HttpFoundation\Exception\BadRequestException
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

    public function __construct($message = "")
    {
        $this->message = $message;

        parent::__construct($this->message);
    }
}
