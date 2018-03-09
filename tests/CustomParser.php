<?php

namespace AdrianBaez\Bundle\MarkdownBundle\Tests;

use AdrianBaez\Bundle\MarkdownBundle\Interfaces\MarkdownParserInterface;
use Michelf\Markdown;

class CustomParser implements MarkdownParserInterface
{
    /**
     * @inheritDoc
     */
    public function parse(string $text) :string
    {
        return Markdown::defaultTransform($text).'test_parser';
    }

    /**
     * @inheritDoc
     */
    public function setOptions(array $options) :MarkdownParserInterface
    {
        // Noop only for test
        return $this;
    }
}
