<?php

namespace App\Http\Controllers\Auth\Requests;

/**
 * @OA\Schema(
 *      title="User Data Request",
 *      description="User Data request body data",
 *      type="object",
 *      required={"name", "email", "password", "password_confirmation"}
 * )
 */
class UserDataRequest
{
    /**
     * @OA\Property(
     *      title="name",
     *      description="Name of the user",
     *      example="John Doe"
     * )
     *
     * @var string
     */
    public $name;

    /**
     * @OA\Property(
     *      title="email",
     *      description="Email of the user",
     *      example="johndoe@mail.com"
     * )
     *
     * @var string
     */
    public $email;

    /**
     * @OA\Property(
     *      title="password",
     *      description="Password of the user",
     *      example="password1"
     * )
     *
     * @var string
     */
    public $password;

    /**
     * @OA\Property(
     *      title="password_confirmation",
     *      description="Password confirmation of the user",
     *      example="password1"
     * )
     *
     * @var string
     */
    public $password_confirmation;
}
