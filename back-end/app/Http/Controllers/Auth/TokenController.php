<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\ValidationException;
use App\Http\Controllers\Auth\Dtos\AuthUserDto;
use App\Http\Controllers\Auth\Dtos\UserDto;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator as RequestValidator;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class TokenController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Token Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticated users tokens for the application.
    |
    */

    /**
     * @OA\Get (
     *      path="/checkAccessToken",
     *      operationId="checkUserAccessToken",
     *      tags={"Auth"},
     *      summary="Check registered user access token",
     *      description="Returns authenticated user data",
     *      @OA\Parameter(
     *          name="Authorization",
     *          description="Bearer Autorization Token",
     *          required=true,
     *          in="header",
     *          @OA\Schema(
     *              type="string",
     *              example="Bearer 30|TPKtQDvDzhyNgdms51MAta6HJcM6CXQwgrRcYxFp"
     *          )
     *      ),
     *     @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/AuthUserDto")
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      )
     * )
     *
     * Handle a login request to the application.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function checkAccessToken(Request $request): JsonResponse
    {
        $user = Auth::user();

        $token = $request->bearerToken();

        $userDto = new UserDto($user->toArray());

        $authUserDto = new AuthUserDto($token, $userDto->toArray());

        return response()->json($authUserDto->toArray());
    }
}
