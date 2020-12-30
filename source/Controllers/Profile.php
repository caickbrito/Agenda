<?php
namespace Source\Controllers;

use Source\Core\Controller;
use Source\Models\AuthContact;
use Source\Models\Contact;
use Source\Models\User;
use CoffeeCode\Paginator\Paginator;

class Profile extends Controller
{
    public function __construct($router)
    {
        parent::__construct($router, true);
        if (isset($_SESSION['message']))
        {
            unset($_SESSION['message']);
        }
        if (!isset($_SESSION['user']) || !$user = (new User())->find("id = :id", "id={$_SESSION['user']}"))
        {
            $_SESSION['message'] = "Área destinada para usuários logados";
            $_SESSION['type'] = "error";
            $this->router->redirect("web.login");
        }
    }

    public function home(?array $data)
    {

        $page = intval(sanitize_stripped($data['p']));

        $pager = new Paginator("http://localhost/projetos/phpstorm/me/");
        $pager->pager(100, 5, ($page ?? 1), 1);

        $user = (new User())->find("id = :id", "id={$_SESSION['user']}")->fetch();
        $contacts = (new Contact())->find("users_id = :id", "id={$user->id}")
            ->order("created_at DESC")
            ->limit($pager->limit())->offset($pager->offset())->fetch(true);

        echo $this->view->render("list-home", [
            "title" => "Bem-vindo(a) ". $user->first_name,
            "user" => $user,
            "contacts" => $contacts,
            "paginator" => $pager->render()
        ]);
    }

    public function addContact(): void
    {
        $user = (new User())->find("id = :id", "id={$_SESSION['user']}")->fetch();
        $contacts = (new Contact())->find("users_id = :id", "id={$user->id}")->order("created_at DESC")->limit(5)->fetch(true);

        echo $this->view->render("add-contact", [
            "title" => "Adicionar contato: ",
            "users" => $contacts
        ]);
    }

    public function addContactPost(array $data)
    {
        $data = sanitize_stripped($data);

        $contact = new Contact();
        $contact->bootstrap(
            $data['first_name'],
            $data['phone'],
            intval($_SESSION['user']),
            $data['last_name']
        );
        $auth = new AuthContact();

        if (!$auth->add($contact))
        {
            echo $this->ajaxResponse("message", [
                "type" => "alert",
                "message" => $auth->message
            ]);
            return;
        }
        echo $this->ajaxResponse("redirect", [
            "url" => $this->router->route("profile.home")
        ]);
    }

    public function edit(array $data)
    {
        $data = sanitize_stripped($data);
        $contact = (new Contact())->find("id = :id AND users_id = :user", "id={$data['id']}&user={$_SESSION['user']}")->fetch();
        $contacts = (new Contact())->find("users_id = :id", "id={$_SESSION['user']}")->order("created_at ASC")->limit(4)->fetch(true);

        if (!$contact)
        {
            $this->router->redirect("profile.home");
            return;
        }

        echo $this->view->render("edit-contact", [
            "title" => "Editar contato:",
            "contact" => $contact,
            "contacts" => $contacts
        ]);

    }

    public function editContact(array $data)
    {
        $data = sanitize_stripped($data);
        $contact = (new Contact())->findById(intval($data['id']));
        $contact->bootstrap(
            $data['first_name'],
            $data['phone'],
            intval($_SESSION['user']),
            $data['last_name']
        );

        $auth = new AuthContact();
        if (!$auth->add($contact))
        {
            echo $this->ajaxResponse("message", [
                "type" => "alert",
                "message" => $auth->message
            ]);
            return;
        }
        echo $this->ajaxResponse("redirect", [
            "url" => $this->router->route("profile.home")
        ]);
    }

    public function delete(?array $data)
    {
        $data = sanitize_stripped($data);
        $contact = (new Contact())->findById(intval($data['id']));
        $auth = new AuthContact();

        if (!$auth->delet($contact))
        {
            $this->ajaxResponse("message", [
                "type" => $auth->type,
                "message" => $auth->message]);
        }

        echo $this->ajaxResponse("message", [
            "type" => "success",
            "message" => "Contato excluído com sucesso"
        ]);
    }


    public function logout()
    {
        $user = (new User())->find("id = :id", "id={$_SESSION['user']}")->fetch();
        $auth = new \Source\Models\Auth();
        $auth->logout($user);

        $this->router->redirect("web.login");
    }
}