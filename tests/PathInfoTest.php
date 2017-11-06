<?php

namespace Io;

use PHPUnit\Framework\TestCase;

/**
 * The PathInfoTest contains test cases for the PathInfo class.
 */
class PathInfoTest extends TestCase
{
    /**
     * Tests whether the given segments are resolved into the correct path.
     *
     * @param string $path The base path.
     * @param string[] $segments The segments to resolve.
     * @param string $expected The expected path after the segments have been resolved.
     * @dataProvider providerTestResolvingOfPaths
     */
    public function testResolvingOfPaths(string $path, array $segments, string $expected)
    {
        $pathInfo = new PathInfo($path);
        $pathInfo = $pathInfo->resolve($segments);

        $this->assertEquals($expected, $pathInfo->getPathname());
    }

    /**
     * Provides a collection of arguments with which to resolve a path.
     *
     * @return string[] A collection of arguments with which to resolve a path
     */
    public function providerTestResolvingOfPaths()
    {
        return [
            ['/home/joe', ['www'], '/home/joe/www'],
            ['/usr/lib', ['php', '7.1'], '/usr/lib/php/7.1'],
            ['public_html', ['foo', 'static', 'css'], 'public_html/foo/static/css'],
            ['public_html/../adobe', ['foo'], 'adobe/foo'],
            ['../Desktop/', ['word.doc'], 'Desktop/word.doc'],
            ['../Downloads/', ['..', 'Music', 'audio.mp3'], 'Music/audio.mp3'],
        ];
    }
}