<?php
namespace Source\Controllers;

use Source\Core\Controller;
use Source\Models\User;


class Web extends Controller
{
    public function __construct($router)
    {
        parent::__construct($router);

        if (isset($_SESSION['message']))
        {
            session_destroy();
        }

        if (isset($_SESSION['user'])){
            $this->router->redirect("profile.home");
            return;
        }
    }

    public function login()
    {
        echo $this->view->render("login", [
            "title" => "Página de login"
        ]);
    }

    public function register()
    {
        echo $this->view->render("register", [
            "title" => "Página de cadastro"
        ]);
    }

    public function forget()
    {
        echo $this->view->render("forget", [
            "title" => "Recupere sua senha"
        ]);
    }


    public function reset(array $data)
    {
        $data = sanitize_stripped($data);

        echo $this->view->render("reset", [
            "title" => "Confirme sua nova senha",
            "code" => $data['code']
        ]);
    }

    public function confirm()
    {
        echo $this->view->render("confirm-login", [

        ]);
    }

    public function success(array $data)
    {
        $data = sanitize_stripped($data);
        $email = base64_decode($data['email']);

        $user = (new User())->find("email = :email", "email={$email}")->fetch();
        if ($user && !$user->confirmed)
        {
            $user->confirmed = true;
            $user->save();
        }

        echo $this->view->render("confirmed-login");
    }

    public function error(array $data)
    {
        $data = sanitize_stripped($data);

        echo $this->view->render("error", [
            "title" => "Ops...erro . " . $data['errorcode'],
            "error" => $data['errorcode']
        ]);
    }
}