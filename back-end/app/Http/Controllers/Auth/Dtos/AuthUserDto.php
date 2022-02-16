<?php

namespace App\Http\Controllers\Auth\Dtos;

use Illuminate\Support\Facades\Log;

/**
 * @OA\Schema(
 *     title="AuthUser",
 *     description="Authenticated User DTO",
 *     @OA\Xml(
 *         name="AuthUserDto"
 *     )
 * )
 */
class AuthUserDto
{
    /**
     * @OA\Property(
     *     title="token",
     *     description="User Access Token",
     *     example="token"
     * )
     *
     * @var string
     */
    public $token;

    /**
     * @OA\Property(
     *      title="user",
     *      description="User data"
     * )
     *
     * @var UserDto
     */
    public $user;

    public function __construct($token, $user)
    {
        $this->token = $token;
        $this->user = $user;
    }

    public function toArray(): array
    {
        return [
            'token' => $this->token,
            'user' => $this->user
        ];
    }
}
