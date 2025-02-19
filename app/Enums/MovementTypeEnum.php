<?php

namespace Modules\Store\Enums;

enum MovementTypeEnum: string
{
    case INPUT = '1';
    case OUTPUT = '2';
    case INPUT_REVERSES = '3';
    case OUTPUT_REVERSES = '4';

    public static function isNotValid($value)
    {
        return !self::isValid($value);
    }

    public static function isValid($value)
    {
        return in_array($value, self::values());
    }

    public static function values()
    {
        return [self::INPUT->value, self::OUTPUT->value, self::INPUT_REVERSES->value, self::OUTPUT_REVERSES->value];
    }

    public static function names()
    {
        return [self::INPUT->name, self::OUTPUT->name, self::INPUT_REVERSES->name, self::OUTPUT_REVERSES->name];
    }
}
// https://stackoverflow.com/questions/76174730/is-it-possible-to-define-the-type-of-a-parameter-as-enum-values