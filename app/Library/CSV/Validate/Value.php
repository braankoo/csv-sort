<?php

namespace App\Library\CSV\Validate;

final class Value {

    /**
     * @param $name
     * @param $arguments
     */
    public static function __callStatic($name, $arguments)
    {
        throw new \BadMethodCallException("Method [$name] does not exist.");
    }

    /**
     * @param string $current
     * @param string $previous
     * @return bool
     */
    public static function racer(string $current, string $previous): bool
    {
        return $current != $previous;
    }

    /**
     * @param string $current
     * @param string $previous
     * @return bool
     */
    public static function turn(string $current, string $previous): bool
    {
        return $current - $previous == 1;
    }

    /**
     * @param string $current
     * @param string $previous
     * @return bool
     */
    public static function time(string $current, string $previous): bool
    {
        return $current != $previous;
    }

    /**
     * @param string $current
     * @param string $previous
     * @return bool
     */
    public static function race(string $current, string $previous): bool
    {
        return $current == $previous;
    }

    /**
     * @param string $current
     * @param string $previous
     * @return bool
     */
    public static function year(string $current, string $previous): bool
    {
        return $current == $previous;
    }

    /**
     * @param string $current
     * @param string $previous
     * @return bool
     */
    public static function country(string $current, string $previous): bool
    {
        return $current == $previous;
    }
}
