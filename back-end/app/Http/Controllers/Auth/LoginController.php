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

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application.
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * @OA\Post(
     *      path="/login",
     *      operationId="loginUser",
     *      tags={"Auth"},
     *      summary="Login registered user",
     *      description="Returns authenticated user data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UserCredentialsRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/AuthUserDto")
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request",
     *          @OA\JsonContent(ref="#/components/schemas/BadRequestException")
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Validation Exception",
     *          @OA\JsonContent(ref="#/components/schemas/ValidationException")
     *      )
     * )
     *
     * Handle a login request to the application.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function login(Request $request): JsonResponse
    {
        $data_validator = $this->validator($request->all());

        if ($data_validator->fails()) {
            throw new ValidationException($data_validator->errors()->all());
        }

        $data = $data_validator->valid();

        $user_candidate = User::where('email', $data['email'])->first();
        if(!$user_candidate) {
            throw new BadRequestException('No user found with email: ' . $data['email']);
        }

        $is_password_valid = Hash::check($data['password'], $user_candidate->password);
        if(!$is_password_valid) {
            throw new BadRequestException('Invalid password.');
        }

        $token = $user_candidate->createToken('access_token')->plainTextToken;

        $userDto = new UserDto($user_candidate->toArray());

        $authUserDto = new AuthUserDto($token, $userDto->toArray());

        return response()->json($authUserDto->toArray(), 201);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return Validator
     */
    protected function validator(array $data): Validator
    {
        return RequestValidator::make($data, [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'min:8'],
        ]);
    }

    /**
     * @OA\Post(
     *      path="/logout",
     *      operationId="logoutUser",
     *      tags={"Auth"},
     *      summary="Logout authenticated post",
     *      description="Disable authenticated user token and returns no content",
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
     *      @OA\Response(
     *          response=204,
     *          description="Successful operation"
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      )
     * )
     *
     *
     * Log the user out of the application.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        Auth::user()->tokens()->delete();

        return response()->json(null, 204);
    }
}
