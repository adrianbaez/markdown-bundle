<?php

namespace AdrianBaez\Bundle\MarkdownBundle\Tests;

use AdrianBaez\Bundle\MarkdownBundle\Interfaces\MarkdownParserInterface;
use Michelf\Markdown;

class TestParser implements MarkdownParserInterface
{
    /**
     * @inheritDoc
     */
    public static function instance($instanceName = 'default')
    {
        return new static;
    }

    /**
     * @inheritDoc
     */
    public function parse(string $text)
    {
        return Markdown::defaultTransform($text).'test_parser';
    }

    /**
     * @inheritDoc
     */
    public function setUrlsLinked(bool $value)
    {
    }

    /**
     * @inheritDoc
     */
    public function setBreaksEnabled(bool $value)
    {
    }

    /**
     * @inheritDoc
     */
    public function setMarkupEscaped(bool $value)
    {
    }

    /**
     * @inheritDoc
     */
    public function setSafeMode(bool $value)
    {
    }
}
