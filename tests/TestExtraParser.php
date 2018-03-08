<?php

namespace AdrianBaez\Bundle\MarkdownBundle\Tests;

use AdrianBaez\Bundle\MarkdownBundle\Interfaces\MarkdownExtraParserInterface;
use Michelf\MarkdownExtra;

class TestExtraParser extends TestParser implements MarkdownExtraParserInterface
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
        return MarkdownExtra::defaultTransform($text).'test_extra_parser';
    }
}
