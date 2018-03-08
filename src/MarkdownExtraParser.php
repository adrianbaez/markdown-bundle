<?php

namespace AdrianBaez\Bundle\MarkdownBundle;

use AdrianBaez\Bundle\MarkdownBundle\Interfaces\MarkdownExtraParserInterface;
use ParsedownExtra;

class MarkdownExtraParser extends ParsedownExtra implements MarkdownExtraParserInterface
{
    /**
     * @inheritdoc
     */
    public function decode(string $text) :string
    {
        return $this->text($text);
    }
}
