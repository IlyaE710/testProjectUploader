<?php

namespace App\controllers;

abstract class Controller
{
    abstract public function handle();
    protected function post(string $name, mixed $default = null)
    {
        return $_POST[$name] ?? $default;
    }

    protected function setStatusCode(int $status): void
    {
        http_response_code($status);
    }
}
