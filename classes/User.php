<?php

class User
{
    private $name;
    private $email;
    private $phone;
    private $password;
    private $hashedPassword;


    public function __construct($name, $email, $phone, $password)
    {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->password = $password;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getHashedPassword($password)
    {
        return $this->hashedPassword;
    }

    public function getPassword()
    {
        return $this->password;
    }


    private function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function getLoginIdentifier()
    {
        return $this->email ?: $this->phone;
    }

    public function verifyPassword($password)
    {
        return password_verify($password, $this->hashedPassword);
    }
}

    

?>