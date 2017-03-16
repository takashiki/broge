<?php

namespace App\Enums;

use Elao\Enum\ReadableEnum;

class BaseEnum extends ReadableEnum
{
    public static function values(): array
    {
        return array_values(static::toDict());
    }

    public static function toDict(): array
    {
        $className = get_called_class();
        $reflectionClass = new \ReflectionClass($className);
        $dictionary = $reflectionClass->getConstants();

        return $dictionary;
    }

    public static function readables(): array
    {
        $dict = static::toDict();

        $dict = array_flip($dict);

        return array_map(function (&$value) {
            return ucfirst(str_replace('_', ' ', strtolower($value)));
        }, $dict);
    }
}
