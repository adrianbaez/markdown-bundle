<?php

namespace AdrianBaez\Bundle\MarkdownBundle;

use AdrianBaez\Bundle\MarkdownBundle\Interfaces\MarkdownParserInterface;
use Parsedown;

class MarkdownParser extends Parsedown implements MarkdownParserInterface
{
    public function parse($text)
    {
        return $this->text($text);
    }
}
