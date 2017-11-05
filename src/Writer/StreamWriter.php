<?php

namespace Io\Writer;

use Psr\Http\Message\StreamInterface;
use Io\Exception\IOException;

/**
 * The StreamWriter writes a sequential series of characters to a PSR-7 compliant Stream object.
 */
class StreamWriter implements WriterInterface
{
    /**
     * The stream to which characters are written.
     *
     * @var StreamInterface $stream.
     */
    private $stream;

    /**
     * Initialize a new StreamWriter.
     *
     * @param StreamInterface $stream The stream to which characters are written.
     */
    public function __construct(StreamInterface $stream)
    {
        $this->setStream($stream);
    }

    /**
     * Close the writer and any resources used by the writer.
     */
    public function close()
    {
        $this->stream->close();
    }

    /**
     * Write the specified string to a text string or stream.
     *
     * @param string $string The string that is to be written.
     */
    public function write(string $string)
    {
        $this->ensureStreamIsWritable($this->stream);
        $this->stream->write($string);
    }

    /**
     * Set the stream to which this writer will write characters.
     *
     * @param StreamInterface $stream The stream to which characters are written.
     * @throws IOException If the specified stream is not writable.
     */
    private function setStream(StreamInterface $stream)
    {
        $this->ensureStreamIsWritable($stream);
        $this->stream = $stream;
    }

    /**
     * Check to make sure the stream is still writable.
     *
     * @param StreamInterface $stream The stream to check.
     * @throws IOException If the stream is not writable.
     */
    private function ensureStreamIsWritable(StreamInterface $stream)
    {
        if (!$stream->isWritable()) {
            throw new IOException("Stream is not writable");
        }
    }
}