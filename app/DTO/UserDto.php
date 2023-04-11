<?php

namespace App\DTO;

class UserDto
{
    public function __construct(public string $name, public string $email, public string $password = '')
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }
}
