<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Laravel7CRUD OpenApi Documentation",
 *      description="Based on L5 Swagger package",
 *      @OA\Contact(
 *          email="karasickdev@gmail.com"
 *      )
 * )
 *
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="Local API Server"
 * )

 *
 * @OA\Tag(
 *     name="Posts",
 *     description="Posts API Endpoints"
 * )
 *
 * @OA\Tag(
 *     name="Auth",
 *     description="Auth API Endpoints"
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
