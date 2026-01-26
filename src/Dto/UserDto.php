<?php

namespace App\Dto;

class UserDto
{
    public function __construct(private $username, private $email) {}
    public function getUsername()
    {
        return $this->username;
    }
    public function getEmail()
    {
        return $this->email;
    }
}
