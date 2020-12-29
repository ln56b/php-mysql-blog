<?php

namespace App;

class URL
{

// Useful for SEO as it avoids an infinity of url made of float numbers
    public static function getInt(string $name, ?int $default = null): ?int
    {
        if (!isset($_GET[$name])) return $default;
        if ($_GET[$name] === '0') return 0;

        if (!filter_var($_GET[$name], FILTER_VALIDATE_INT)) {
            throw new \Exception("The page number '$name' should be an integer");
        }
        return (int)$_GET[$name];
    }

    // If this equals to 0 because the conversion to int meant nothing, set to 1.
    public static function getPositiveInt(string $name, ?int $default = null): ?int
    {
        $param = self::getInt($name, $default);
        if ($param !== null && $param <= 0) {
            throw new \Exception("The page number '$name' should be a positive integer");
        }
        return $param;
    }

}