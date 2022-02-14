<?php

namespace App\Http\Dtos;

use Illuminate\Support\Facades\Log;
use PHPUnit\Util\Json;

class PostDto
{
    public $id;
    public $user_id;
    public $content;
    public $title;
    public $created_at;
    public $updated_at;

    public function __construct($post)
    {
        $this->id = $post['id'];
        $this->user_id = $post['user_id'];
        $this->content = $post['content'];
        $this->title = $post['title'];
        $this->created_at = $post['created_at'];
        $this->updated_at = $post['updated_at'];
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'userId' => $this->user_id,
            'content' => $this->content,
            'title' => $this->title,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }
}
