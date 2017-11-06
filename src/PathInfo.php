<?php

namespace Io;

use Io\Util\Strings;

/**
 * The PathInfo class offers an object oriented interface to information for a path.
 */
class PathInfo extends \SplFileInfo
{
    /**
     * Resolve the given sequence of segments into a canonical path.
     *
     * @param string[] $segments The segments to resolve.
     * @return PathInfo A new PathInfo object that represents the canonical path.
     */
    public function resolve(array $segments): PathInfo
    {
        $path = rtrim($this->getPathname(), DIRECTORY_SEPARATOR);

        foreach ($segments as $segment) {
            $path .= Strings::addLeading($segment, DIRECTORY_SEPARATOR);
        }

        return new self($this->normalize($path));
    }

    /**
     * Returns a canonical pathname from the specified path.
     *
     * @param string $path The path to normalize.
     * @return string The canonical pathname.
     */
    private function normalize(string $path): string
    {
        $segments = [];
        $parts = explode(DIRECTORY_SEPARATOR, $path);

        foreach ($parts as $part) {
            if ('..' === $part) {
                array_pop($segments);
            } elseif ($part !== '' && $part !== '.') {
                $segments[] = $part;
            }
        }

        $normalizedPath = join(DIRECTORY_SEPARATOR, $segments);

        if (isset($path[0]) && $path[0] === DIRECTORY_SEPARATOR) {
            $normalizedPath = DIRECTORY_SEPARATOR . $normalizedPath;
        }

        return $normalizedPath;
    }
}