<?php

namespace App\Http\Controllers;

use App\Http\Dtos\PostDto;
use App\Post;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $posts = Post::all()->toArray();

        $postDtos = array_map(function ($post) {
            $post = new PostDto($post);
            return $post->toArray();
        }, $posts);

        return response()->json($postDtos, 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return JsonResponse|MessageBag
     */
    public function store(Request $request)
    {
        $data_validator = Validator::make($request->all(), [
            'title' => ['required'],
            'content' => ['required'],
        ]);

        if ($data_validator->fails()) {
            return $data_validator->errors();
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
     * Display the specified resource.
     *
     * @param  Post  $post
     * @return JsonResponse
     */
    public function show(Post $post): JsonResponse
    {
        $postDto = new PostDto($post->toArray());

        return response()->json($postDto->toArray(), 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Post  $post
     * @return JsonResponse|MessageBag
     */
    public function update(Request $request, Post $post)
    {
        $data_validator = Validator::make($request->all(), [
            'content' => ['required'],
        ]);

        if ($data_validator->fails()) {
            return $data_validator->errors();
        }

        $data = $data_validator->valid();

        $post->update([
            'content' => $data['content']
        ]);

        $postDto = new PostDto($post->toArray());

        return response()->json($postDto->toArray(), 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Post $post): JsonResponse
    {
        $result = $post->delete();

        return response()->json($result, 201);
    }
}
