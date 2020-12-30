<?php
namespace Source\Models;
use Source\Models\Contact;
use CoffeeCode\DataLayer\DataLayer;


class AuthContact extends DataLayer
{
    public $message;
    public $type;

    public function __construct()
    {
        parent::__construct("contatos", ["name", "phone"]);
    }

    public function add(Contact $contact): bool
    {
        if (!$contact->save())
        {
            $this->message = $contact->fail->getMessage();
            return false;
        }
        return true;
    }

    public function delet(Contact $contact): bool
    {
        if (!$contact->destroy())
        {
            $this->message = $contact->fail->getMessage();
            $this->type = "error";
            return false;
        }

        return true;
    }
}