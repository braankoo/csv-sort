<?php

namespace App\Library\CSV\Validate;

final class Type {


    /**
     * @param $name
     * @param $arguments
     */
    public static function __callStatic($name, $arguments)
    {
        throw new \BadMethodCallException("Method [$name] does not exist.");
    }

    /**
     * @param string $value
     * @return bool
     */
    public static function racer(string $value): bool
    {
        if (!is_numeric($value))
        {
            return true;
        }

        return false;

    }

    /**
     * @param string $value
     * @return bool
     */
    public static function turn(string $value): bool
    {
        if (is_numeric($value))
        {
            return $value == (int) $value;
        }

        return false;
    }

    /**
     * @param string $value
     * @return bool
     */
    public static function time(string $value): bool
    {
        if (is_numeric($value))
        {
            return $value == (double) $value;
        }

        return false;
    }

    /**
     * @param string $value
     * @return bool
     */
    public static function race(string $value): bool
    {
        if (!is_numeric($value))
        {
            return true;
        }

        return false;
    }

    /**
     * @param string $value
     * @return bool
     */
    public static function year(string $value): bool
    {
        if (is_numeric($value))
        {
            return $value == (int) $value;
        }

        return false;
    }

    /**
     * @param string $value
     * @return bool
     */
    public static function country(string $value): bool
    {
        if (!is_numeric($value))
        {
            return true;
        }

        return false;
    }

}
