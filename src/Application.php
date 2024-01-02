<?php

namespace App;

use App\controllers\FileController;
use App\services\FileService;
use App\services\RegexService;

class Application
{
    public function run(): void
    {
        $uploadDir = 'files/';
        $controller = new FileController(
            new FileService(uploadDir:  $uploadDir),
            new RegexService(),
        );

        echo $controller->handle();
    }
}
