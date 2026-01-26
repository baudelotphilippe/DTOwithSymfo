<?php

namespace App\Dto;

class UserDto
{
    private $username;
    private $email;

    public function getUsername()
    {
        return $this->username;
    }
    public function getEmail()
    {
        return $this->email;
    }

    public function setUsername($username): self
    {
        $this->username = $username;

        return $this;
    }

    public function setEmail($email): self
    {
        $this->email = $email;

        return $this;
    }
}
