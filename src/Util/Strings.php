<?php

namespace Io\Util;

/**
 * This utility class provides various methods for manipulating strings.
 */
class Strings
{
    /**
     * Prepend if not present the given characters to the specified input string.
     *
     * @param string $string The string to which the character will be prepended.
     * @param string $chars The characters to prepend.
     * @return string The input string with the given characters prepended to it.
     */
    public static function addLeading(string $string, string $chars): string
    {
        if (self::startsWith($string, $chars)) {
            $length = mb_strlen($chars);
            $string = mb_substr($string, $length);
        }

        return $chars . $string;
    }

    /**
     * Tests whether the specified string starts with the given prefix.
     *
     * @param string $string The string that will be tested.
     * @param string $prefix The prefix to find.
     * @return bool True if the specified string starts with the given prefix.
     */
    public static function startsWith(string $string, string $prefix): bool
    {
        return (mb_strpos($string, $prefix) === 0);
    }

}