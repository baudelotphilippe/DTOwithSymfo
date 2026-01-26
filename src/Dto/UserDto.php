<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class UserDto
{
    #[Assert\NotBlank]  
    private string $username;

    #[Assert\NotBlank]    
    private string $email;

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
