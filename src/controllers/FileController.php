<?php

namespace App\controllers;

use App\dtos\FileDto;
use App\services\FileService;
use App\services\RegexService;

class FileController extends Controller
{
    public function __construct(
        private readonly FileService $fileService,
        private readonly RegexService $regexService,
    ) {
        $this->fileService->setAllowExtension(['txt']);
    }

    public function handle(): string
    {
        $file = FileDto::createFromArray($_FILES);
        $separator = $this->post('text');

        if (!$separator) {
            $this->setStatusCode(400);

            return 'Разделитель не может быть пустым';
        }

        if (!$this->regexService->isValidRegex($separator)) {
            $this->setStatusCode(400);

            return 'Не валидное регулярное выражение.';
        }
        if ($this->fileService->uploadFile($file)) {
            $file = $this->fileService->read($file);

            return $this->regexService->getCount($file, $separator);
        }

        $this->setStatusCode(400);

        return 'Файл не загружен. Не допустимое расширение. Файл длжен быть типа txt.';
    }
}
