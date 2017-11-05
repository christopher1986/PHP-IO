<?php

namespace Io\Writer;

/**
 * The Writer is capable of writing a sequential series of characters to a text string or stream.
 */
interface WriterInterface
{
    /**
     * Close the writer and any resources used by the writer.
     */
    public function close();

    /**
     * Write the specified string to a text string or stream.
     *
     * @param string $string The string that is to be written.
     */
    public function write(string $string);
}