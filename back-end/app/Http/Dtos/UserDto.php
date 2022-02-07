<?php

namespace App\Http\Dtos;

use Illuminate\Support\Facades\Log;

class UserDto
{
    public $id;
    public $name;
    public $email;

    public function __construct($user)
    {
        $this->id = $user['id'];
        $this->name = $user['name'];
        $this->email = $user['email'];
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
        ];
    }
}
