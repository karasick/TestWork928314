<?php

namespace App\Http\Controllers\Auth\Dtos;

use Illuminate\Support\Facades\Log;

/**
 * @OA\Schema(
 *     title="User",
 *     description="User DTO",
 *     @OA\Xml(
 *         name="UserDto"
 *     )
 * )
 */
class UserDto
{
    /**
     * @OA\Property(
     *     title="ID",
     *     description="ID",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    public $id;

    /**
     * @OA\Property(
     *      title="Name",
     *      description="Name of the user",
     *      example="John Doe"
     * )
     *
     * @var string
     */
    public $name;

    /**
     * @OA\Property(
     *      title="Email",
     *      description="Email of the user",
     *      example="johndoe@mail.com"
     * )
     *
     * @var string
     */
    public $email;

    public function __construct($user)
    {
        $this->id = $user['id'];
        $this->name = $user['name'];
        $this->email = $user['email'];
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
        ];
    }
}
