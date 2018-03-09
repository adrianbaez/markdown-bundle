<?php

namespace AdrianBaez\Bundle\MarkdownBundle\Interfaces;

interface MarkdownParserInterface
{
    /**
     * @param  string $text
     * @return string
     */
    public function parse(string $text) :string;

    /**
     * @param  array $options
     * @throws \RuntimeException if optios can't be setted
     * @return MarkdownParserInterface
     */
    public function setOptions(array $options) :MarkdownParserInterface;
}
