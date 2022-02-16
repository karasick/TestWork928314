<?php

namespace App\Http\Controllers\Post\Dtos;

use DateTime;
use Illuminate\Support\Facades\Log;
use PHPUnit\Util\Json;

/**
 * @OA\Schema(
 *     title="Post",
 *     description="Post DTO",
 *     @OA\Xml(
 *         name="PostDto"
 *     )
 * )
 */
class PostDto
{
    /**
     * @OA\Property(
     *     title="ID",
     *     description="ID",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    public $id;

    /**
     * @OA\Property(
     *     title="User ID",
     *     description="User's ID of the created post",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    public $user_id;

    /**
     * @OA\Property(
     *      title="Title",
     *      description="Title of the post",
     *      example="A nice post"
     * )
     *
     * @var string
     */
    public $title;

    /**
     * @OA\Property(
     *      title="Content",
     *      description="Content of the post",
     *      example="This is post's content"
     * )
     *
     * @var string
     */
    public $content;

    /**
     * @OA\Property(
     *     title="Created at",
     *     description="Created at",
     *     example="2022-02-14 15:02:22",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var DateTime
     */
    public $created_at;

    /**
     * @OA\Property(
     *     title="Updated at",
     *     description="Updated at",
     *     example="2022-02-14 15:16:17",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var DateTime
     */
    public $updated_at;

    public function __construct($post)
    {
        $this->id = $post['id'];
        $this->user_id = $post['user_id'];
        $this->title = $post['title'];
        $this->content = $post['content'];
        $this->created_at = $post['created_at'];
        $this->updated_at = $post['updated_at'];
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'userId' => $this->user_id,
            'title' => $this->title,
            'content' => $this->content,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }
}
