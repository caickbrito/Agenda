<?php
namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;
use League\Plates\Engine;
use Source\Support\Email;

class Auth extends DataLayer
{
    public $message;
    public $type;

    public function __construct()
    {
        parent::__construct('users', ['email', 'passwd']);
    }

    public function register(User $user): bool
    {
        if (!$user->save())
        {
            $this->message = $user->fail->getMessage();
            return false;
        }

        $view = Engine::create(__DIR__."/../../shared/emails/", "php");
        $message = $view->render("confirm", [
            "first_name" => $user->first_name,
            "link" => ROOT."/obrigado/".base64_encode($user->email)
        ]);

        (new Email())->add("Ative sua conta",
        $message,
        "{$user->first_name} {$user->last_name}",
        $user->email)->send();
        return true;
    }

    public function login(string $email, string $passwd, bool $save = false): bool
    {
        if (!is_email($email))
        {
            $this->message = "O email informado não é válido";
            $this->type = "info";
            return false;
        }


        $user = (new User())->find("email = :email", "email={$email}")->fetch();
        if (!$user || !password_verify($passwd, $user->passwd))
        {
            $this->message = "Dados inválidos. Verifique-os e tente novamente";
            $this->type = "error";
            return false;
        }
        if (!$user->confirmed)
        {
            $this->message = "Email pendente de confirmação";
            $this->type = "info";
            return false;
        }

        $_SESSION['user'] = $user->id;
        return true;
    }

    public function logout(User $user): void
    {
        unset($_SESSION['user']);
        $_SESSION['message'] = "Volte logo, {$user->first_name}!";
        $_SESSION['type'] = "info";
        return;
    }

    public function forget(string $email): bool
    {
        if (!is_email($email)){
            $this->message = "Informe um email válido";
            $this->type = "alert";
            return false;
        }
        $user = (new User())->find("email = :email", "email={$email}")->fetch();
        if (!$user){
            $this->message = "O email informado não está cadastrado";
            $this->type = "alert";
            return false;
        }

        $user->forget = md5(uniqid(rand(), true));
        if (!$user->save())
        {
            $this->message = $user->fail->getMessage();
            $this->type = $user->type;
            return false;
        }


        $view = Engine::create(__DIR__."/../../shared/emails/", "php");
        $message = $view->render("recover", [
            "user" => $user,
            "link" => ROOT."/reset/".$user->email ."|".$user->forget]);


        (new Email())->add(
            "Recupere sua senha",
            $message,
            "{$user->first_name} {$user->last_name}",
            $user->email
        )->send();
        return true;
    }

    public function reset(string $email, string $code, string $passwd, string $passwd_re): bool
    {
        $user = (new User())->find("email = :email", "email={$email}")->fetch();
        if (!$user)
        {
            $this->message = "O email informado não está cadastrado";
            $this->type = "alert";
            return false;
        }

        if ($user->forget != $code)
        {
            $this->message = "Desculpe, mas o código de verificação não é válido";
            $this->type = "error";
            return false;
        }

        if ($passwd !== $passwd_re)
        {
            $this->message = "As senhas não conferem. Verifique e tente novamente";
            $this->type = "error";
            return false;
        }

        $user->passwd = passwd_hash($passwd);
        $user->forget = null;
        if (!$user->save())
        {
            $this->message = $user->fail->getMessage();
            $this->type = $user->type;
            return false;
        }
        return true;
    }

}