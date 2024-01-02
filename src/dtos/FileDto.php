<?php

namespace App\dtos;

readonly class FileDto
{
    private function __construct(
        public string $name,
        public string $tmp_name,
    ) {
    }

    public static function createFromArray(array $file): static
    {
        self::validate($file);

        return new static(
            $file['file']['name'],
            $file['file']['tmp_name'],
        );
    }

    public static function validate(array $file): bool
    {
        return isset($file['file']);
    }
}
