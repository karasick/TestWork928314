<?php

namespace App\Http\Controllers\Post\Requests;

/**
 * @OA\Schema(
 *      title="Post Store Request",
 *      description="Post Store request body data",
 *      type="object",
 *      required={"title", "content"}
 * )
 */
class PostStoreRequest
{
    /**
     * @OA\Property(
     *      title="title",
     *      description="Title of the new post",
     *      example="A nice post"
     * )
     *
     * @var string
     */
    public $title;

    /**
     * @OA\Property(
     *      title="content",
     *      description="Content of the new post",
     *      example="This is post's content."
     * )
     *
     * @var string
     */
    public $content;
}
