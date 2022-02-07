<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Dtos\UserDto;
use App\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator as RequestValidator;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen.
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
     * Handle a login request to the application.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function login(Request $request): JsonResponse
    {
        $data_validator = $this->validator($request->all());
        $data = $data_validator->validate();
        if ($data_validator->fails()) {
            return response()->json($data, 400);
        }

        $user_candidate = User::where('email', $data['email'])->first();
        if(!$user_candidate) {
            return response()->json([
                'message' => 'No user found with email: ' . $data['email']
            ], 400);
        }

        $is_password_valid = Hash::check($data['password'], $user_candidate->password);
        if(!$is_password_valid) {
            return response()->json([
                'message' => 'Invalid password.'
            ], 400);
        }

        $token = $user_candidate->createToken('access_token')->plainTextToken;

        $userDto = new UserDto([
            'id' => $user_candidate->id,
            'name' => $user_candidate->name,
            'email' => $user_candidate->email
        ]);

        return response()->json([
            'user' => $userDto->toArray(),
            'token' => $token
        ], 201);
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
     * Log the user out of the application.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        Auth::user()->tokens()->delete();

        return response()->json([], 204);
    }
}
