<?php

namespace App\Http\Controllers\Auth\Requests;

/**
 * @OA\Schema(
 *      title="User Credentials Request",
 *      description="User Credentials request body data",
 *      type="object",
 *      required={"email", "password"}
 * )
 */
class UserCredentialsRequest
{
    /**
     * @OA\Property(
     *      title="email",
     *      description="Email of the registered user",
     *      example="johndoe@mail.com"
     * )
     *
     * @var string
     */
    public $email;

    /**
     * @OA\Property(
     *      title="password",
     *      description="Password of the registered user",
     *      example="password1"
     * )
     *
     * @var string
     */
    public $password;
}
