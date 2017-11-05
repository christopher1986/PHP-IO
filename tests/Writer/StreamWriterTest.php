<?php

namespace Tests\Io\Writer;

use PHPUnit\Framework\TestCase;
use Zend\Diactoros\Stream;
use Io\Exception\IOException;
use Io\Writer\StreamWriter;

/**
 * The StreamWriterTest is a test suite for the StreamWriter class.
 */
class StreamWriterTest extends TestCase
{
    /**
     * Tests whether an IOException occurs for non-writable streams.
     */
    public function testStreamNotWritableException()
    {
        $this->expectException(IOException::class);

        $stream = new Stream('php://temp', 'rb');
        new StreamWriter($stream);
    }

    /**
     * Tests whether the stream has been populated with the provided characters.
     *
     * @dataProvider providerTestWritingOfCharactersToStream
     */
    public function testWritingOfCharactersToStream(string $string)
    {
        $stream = new Stream('php://temp', 'wb+');
        $writer = new StreamWriter($stream);
        $writer->write($string);

        $output = (string) $stream;

        $this->assertEquals($output, $string);
    }

    /**
     * Tests whether an IOException occurs when writing to a closed stream.
     */
    public function testStreamIsClosed()
    {
        $this->expectException(IOException::class);

        $stream = new Stream('php://temp', 'wb+');
        $writer = new StreamWriter($stream);
        $writer->close();
        $writer->write('String to write');
    }

    /**
     * Provides a collection of string for a single test.
     *
     * @return string[] A collection of strings to write to a stream.
     */
    public function providerTestWritingOfCharactersToStream()
    {
        return [
            ['This string will be written to the stream'],
            ['THIS STRING WILL BE WRITTEN TO THE STREAM'],
            ['This 1 string 2 will 3 be 4 written 4 to 5 the 6 stream'],
            ['!@#$%*(){}|<>?/.,;[]-=_+|\`~'],
            ['Esta seqüência de caracteres será gravada no fluxo'],
            ['Αυτή η συμβολοσειρά θα γραφτεί στη ροή'],
            ['']
        ];
    }
}