<?php
ob_start();
session_start();
require __DIR__."/vendor/autoload.php";

$router = new \CoffeeCode\Router\Router(ROOT);
$router->namespace("Source\Controllers");

//ROTAS PRINCIPAIS E DE AUTENTICAÇÃO
$router->group(null);
$router->get("/", "Web:login", "web.login");
$router->post("/login", "Auth:login", "auth.login");

$router->get("/register", "Web:register", "web.register");
$router->post("/register", "Auth:register", "auth.register");

$router->get("/forget", "Web:forget", "web.forget");
$router->post("/forget", "Auth:forget","auth.forget");


$router->get("/reset", "Web:reset", "web.reset");
$router->post("/reset", "Auth:reset", "auth.reset");
$router->get("/reset/{code}", "Web:reset", "web.reset");

//CONFIRM
$router->get("/confirma", "Web:confirm", "web.confirm");
$router->get("/obrigado/{email}", "Web:success", "web.success");


//ROTAS LOGADAS
$router->group("/me");
$router->get("/{p}", "Profile:home", "profile.home");
$router->get("/adicionar", "Profile:addContact", "profile.addcontact");
$router->post("/add", "Profile:addContactPost", "profile.addcontactpost");
$router->get("/editar/{id}", "Profile:edit", "profile.edit");
$router->post("/edit", "Profile:editContact", "profile.editcontact");
$router->post("/delete", "Profile:delete","profile.delete");

$router->get("/sair", "Profile:logout", "profile.logout");



//ROTA DE ERROS
$router->group("/ops");
$router->get("/{errorcode}", "Web:error", "web.error");

//DESPACHE DAS ROTAS
$router->dispatch();

//REDIRECIONAMENTO DE ERROS
if ($router->error())
{
    $router->redirect("/ops/{$router->error()}");
}

ob_end_flush();
