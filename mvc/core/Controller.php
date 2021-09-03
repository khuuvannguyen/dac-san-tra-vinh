<?php
class Controller
{
    function callModel($model)
    {
        require_once "./mvc/models/" . $model . ".php";
        return new $model;
    }

    static function callView($view, $data = [])
    {
        require_once "./mvc/views/" . $view . ".php";
    }

    static function pageNotFound()
    {
        http_response_code(404);
        require_once "./mvc/views/Pages/page-not-found.php";
        die();
    }
}
