<?php
namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Contact extends DataLayer
{
    public function __construct()
    {
        parent::__construct("contatos", ["name", "phone"]);
    }


    public function bootstrap(
        string $name,
        string $phone,
        int $users_id,
        string $lastname = null): Contact
    {
        $this->name = $name;
        $this->phone = $phone;
        $this->users_id = $users_id;
        $this->lastname = $lastname;
        return $this;
    }

    public function save(): bool
    {
        if (!parent::save())
        {
            return false;
        }

        return true;
    }

}