<?php

namespace App\Http\Controllers;

use App\Post;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Post[]
     */
    public function index(): array
    {
        return Post::all()->toArray();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Post|MessageBag
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

        return $post;
    }

    /**
     * Display the specified resource.
     *
     * @param  Post  $post
     * @return Post
     */
    public function show(Post $post): Post
    {
        return $post;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Post  $post
     * @return Post|MessageBag
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

        return $post;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return bool
     * @throws Exception
     */
    public function destroy(Post $post): bool
    {
        return $post->delete();
    }
}
