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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator as RequestValidator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation.
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    /**
     * @OA\Post(
     *      path="/register",
     *      operationId="registerUser",
     *      tags={"Auth"},
     *      summary="Register new user",
     *      description="Returns authenticated user data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UserDataRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/AuthUserDto")
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Validation Exception",
     *          @OA\JsonContent(ref="#/components/schemas/ValidationException")
     *      )
     * )
     *
     *
     * Handle a registration request for the application.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function register(Request $request): JsonResponse
    {
        $data_validator = $this->validator($request->all());

        if ($data_validator->fails()) {
            throw new ValidationException($data_validator->errors()->all());
        }

        $data = $data_validator->valid();

        $user = $this->create($data);

        $token = $user->createToken('access_token')->plainTextToken;

        $userDto = new UserDto($user->toArray());

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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data): User
    {
        $user = new User([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user->save();

        return $user;
    }
}
