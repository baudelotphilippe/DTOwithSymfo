<?php

namespace App\Entity;

class User
{
    private string $username;
    private string $email;
    private string $telephone;

    public function __construct(string $username, string $email, string $telephone)
    {
        $this->username = $username;
        $this->email = $email;
        $this->telephone = $telephone;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getTelephone()
    {
        return $this->telephone;
    }
}
