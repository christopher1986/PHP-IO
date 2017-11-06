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
        return $chars . ltrim($string, $chars);
    }
}