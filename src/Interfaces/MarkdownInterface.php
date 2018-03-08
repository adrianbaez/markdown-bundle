<?php

namespace AdrianBaez\Bundle\MarkdownBundle\Interfaces;

interface MarkdownInterface
{
    public function __invoke(string $text, array $options) :string;
    public function parse(string $text, array $options) :string;
}
