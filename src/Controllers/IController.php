<?php

namespace App\Controllers;

interface IController
{
    public function view(string $viewName) :string;
}