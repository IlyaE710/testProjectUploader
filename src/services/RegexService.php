<?php

namespace App\services;

class RegexService
{
    public function isValidRegex($regex): bool
    {
        set_error_handler(function () {}, E_WARNING);
        $isValid = @preg_match($regex, '') !== false;
        restore_error_handler();

        return $isValid;
    }

    public function getCount(array $lines, string $separator = null): string
    {
        return implode(',', array_map(function ($line) use ($separator) {
            return  preg_match_all($separator, $line, $_);
        }, $lines));
    }
}
