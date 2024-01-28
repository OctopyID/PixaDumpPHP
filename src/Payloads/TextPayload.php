<?php

namespace Octopy\PixaDump\Payloads;

class TextPayload extends Payload
{
    /**
     * @param  string $text
     */
    public function __construct(protected string $text)
    {
        //
    }

    /**
     * @return string
     */
    protected function getType() : string
    {
        return 'custom';
    }

    /**
     * @return string
     */
    protected function getData() : string
    {
        return $this->formatContent();
    }

    /**
     * @return string
     */
    protected function formatContent() : string
    {
        return str_replace([' ', PHP_EOL], ['&nbsp;', '<br>'], htmlspecialchars($this->text, ENT_QUOTES | ENT_HTML5));
    }
}
