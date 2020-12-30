<?php
namespace Source\Controllers;

use Source\Core\Controller;
use Source\Models\User;

class Auth extends Controller
{
    public function __construct($router)
    {
        parent::__construct($router);
    }

    public function login(array $data)
    {
        $data = sanitize_stripped($data);
        $auth = new \Source\Models\Auth();

        if (in_array('', $data))
        {
            echo $this->ajaxResponse("message", [
                "type" => "alert",
                "message" => "Preencha todos os campos"
            ]);
            return;
        }

        if(!$auth->login($data['email'], $data['passwd'])){
            echo $this->ajaxResponse("message",[
                "type" => $auth->type,
                "message" => $auth->message
            ]);
            return;
        };

        echo $this->ajaxResponse("redirect", [
            "url" => $this->router->route("profile.home")
        ]);
    }

    public function register(array $data)
    {
        $data = sanitize_stripped($data);
        $auth = new \Source\Models\Auth();
        $user = new User();
        $user->bootstrap($data['first_name'], $data['last_name'], $data['email'], $data['passwd']);

        if (in_array('', $data))
        {
            echo $this->ajaxResponse("message", [
                "type" => "alert",
                "message" => "Preencha todos os campos"
            ]);
            return;
        }

        if ($auth->register($user))
        {
            echo $this->ajaxResponse("redirect", [
                "url" => $this->router->route("web.confirm")
            ]);
        }else{
            echo $this->ajaxResponse("message", [
                "type" => $user->type,
                "message" => $auth->message
            ]);
        }
    }

    public function forget(array $data)
    {
        $data = sanitize_stripped($data);
        $auth = new \Source\Models\Auth();
        if (in_array("", $data))
        {
            echo $this->ajaxResponse("message", [
                "type" => "alert",
                "message" => "Informe o email"
            ]);
            return;
        }


        if (!$auth->forget($data['email']))
        {
            echo $this->ajaxResponse("message", [
                "type" => $auth->type,
                "message" => $auth->message
            ]);
            return;
        }


        echo $this->ajaxResponse("message", [
            "type" => "success",
            "message" => "Email enviado com sucesso, verifique sua caixa de entrada"
        ]);

    }

    public function reset(array $data): void
    {
        $data = implode("|", sanitize_stripped($data));
        $data = explode("|", $data);

        if (in_array("", $data))
        {
            echo $this->ajaxResponse("message", [
                "type" => "alert",
                "message" => "Preencha todos os campos"
            ]);
            return;
        }

        $auth = new \Source\Models\Auth();
        if (!$auth->reset($data[0], $data[1], $data[2], $data[3])){
            echo $this->ajaxResponse("message", [
                "type" => $auth->type,
                "message" => $auth->message
            ]);
            return;
        }

        echo $this->ajaxResponse("message", [
            "type" => "success",
            "message" => "Senha alterada com sucesso"
        ]);
    }
}