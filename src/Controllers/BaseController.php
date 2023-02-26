<?php

namespace  App\Controllers;

class BaseController implements IController{

    public function view(string $viewName, array|null $viewData = []): string
    {
        extract($viewData);
        return include_once __DIR__."/../Views/{$viewName}.php";
    }
}