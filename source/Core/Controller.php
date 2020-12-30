<?php
namespace Source\Core;

use League\Plates\Engine;

class Controller
{
    protected $router;
    protected $view;

    public function __construct($router, bool $logged = false)
    {
        $this->router = $router;
        $this->view = Engine::create(__DIR__."/../../shared/views/", CONF_VIEW_EXT);
        if ($logged)
        {
            $this->view = Engine::create(__DIR__."/../../shared/views/agenda/", CONF_VIEW_EXT);
        }
        $this->view->addData(["router" => $this->router]);
    }

    public function ajaxResponse(string $param, array $values)
    {
        return json_encode([$param => $values]);
    }

}