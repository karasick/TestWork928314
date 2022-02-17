<?php

namespace App\Http\Controllers\Post;

use App\Exceptions\ValidationException;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Post\Dtos\PostPaginationDto;
use App\Http\Controllers\Post\Dtos\PostDto;
use App\Models\Post;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * @OA\Get(
     *      path="/posts",
     *      operationId="getPostsList",
     *      tags={"Posts"},
     *      summary="Get limited list of posts with pagination",
     *      description="Returns limited list of posts with pagination information",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/PostPaginationDto")
     *       )
     *     )
     *
     *
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
//        $page = $request->query('page', 1); // Expecting by default
        $limit = $request->query('limit', 10);

//        $posts = DB::table('posts')->latest()->paginate($limit);
        $posts = Post::latest()->paginate($limit); // Jsonable version of above statement

        $postDtos = array_map(function ($post) {
            $post = new PostDto($post);
            return $post->toArray();
        }, $posts->items());

        $paginationDto = new PostPaginationDto($postDtos, $posts->toArray());

        return response()->json($paginationDto->toArray());
    }

    /**
     * @OA\Post(
     *      path="/posts",
     *      operationId="storePost",
     *      tags={"Posts"},
     *      summary="Store new post",
     *      description="Returns stored post data",
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
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/PostStoreRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/PostDto")
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Validation Exception",
     *          @OA\JsonContent(ref="#/components/schemas/ValidationException")
     *      )
     * )
     *
     *
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $data_validator = Validator::make($request->all(), [
            'title' => ['required'],
            'content' => ['required'],
        ]);

        if ($data_validator->fails()) {
            throw new ValidationException($data_validator->errors()->all());
        }

        $data = $data_validator->valid();

        $user = Auth::user();

        $post = new Post([
            'user_id' => $user->id,
            'title' => $data['title'],
            'content' => $data['content'],
        ]);

        $post->save();

        $postDto = new PostDto($post->toArray());

        return response()->json($postDto->toArray(), 201);
    }

    /**
     * @OA\Get(
     *      path="/posts/{id}",
     *      operationId="getPostById",
     *      tags={"Posts"},
     *      summary="Get post data",
     *      description="Returns post data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Post id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer",
     *              example="1"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/PostDto")
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     *
     *
     * Display the specified resource.
     *
     * @param  Post  $post
     * @return JsonResponse
     */
    public function show(Post $post): JsonResponse
    {
        $postDto = new PostDto($post->toArray());

        return response()->json($postDto->toArray());
    }

    /**
     * @OA\Put(
     *      path="/posts/{id}",
     *      operationId="storePost",
     *      tags={"Posts"},
     *      summary="Update existing post",
     *      description="Returns updated post data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Post id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer",
     *              example="1"
     *          )
     *      ),
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
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/PostStoreRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/PostDto")
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Validation Exception",
     *          @OA\JsonContent(ref="#/components/schemas/ValidationException")
     *      )
     * )
     *
     *
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Post $post
     * @return JsonResponse
     * @throws ValidationException
     */
    public function update(Request $request, Post $post): JsonResponse
    {
        $data_validator = Validator::make($request->all(), [
            'content' => ['required'],
        ]);

        if ($data_validator->fails()) {
            throw new ValidationException($data_validator->errors()->all());
        }

        $data = $data_validator->valid();

        $post->update([
            'content' => $data['content']
        ]);

        $postDto = new PostDto($post->toArray());

        return response()->json($postDto->toArray(), 201);
    }

    /**
     * @OA\Delete(
     *      path="/posts/{id}",
     *      operationId="deletePostById",
     *      tags={"Posts"},
     *      summary="Delete existing post",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Post id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer",
     *              example="1"
     *          )
     *      ),
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
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     *
     *
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Post $post): JsonResponse
    {
        $post->delete();

        return response()->json(null, 204);
    }
}
