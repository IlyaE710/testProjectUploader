<?php

namespace App\services;

use App\dtos\FileDto;

class FileService
{
    private array $allowExtension;

    public function __construct(private readonly string $uploadDir)
    {
        $this->createIfNotExist();
    }

    public function uploadFile(FileDto $file): bool
    {
        $uploadFile = $this->getFullPath($file->name);

        if (!$this->validate($uploadFile)) {
            return false;
        }

        if (move_uploaded_file($file->tmp_name, $uploadFile)) {
            return true;
        } else {
            return false;
        }
    }

    public function read(FileDto $file): array
    {
        $uploadFile = $this->getFullPath($file->name);
        $fileContentByLines = file($uploadFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        if ($fileContentByLines) {
            return $fileContentByLines;
        }

        return [];
    }

    public function createIfNotExist(): void
    {
        if (!file_exists($this->uploadDir)) {
            mkdir($this->uploadDir, 0777, true);
        }
    }

    public function getFullPath($name): string
    {
        return $this->uploadDir . basename($name);
    }

    public function setAllowExtension(array $array): void
    {
        $this->allowExtension = $array;
    }

    private function validate(string $uploadFile): bool
    {
        $extension = pathinfo($uploadFile, PATHINFO_EXTENSION);

        return in_array($extension, $this->allowExtension);
    }
}
