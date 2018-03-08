<?php

namespace AdrianBaez\Bundle\MarkdownBundle;

use AdrianBaez\Bundle\MarkdownBundle\Interfaces\MarkdownInterface;

class Markdown implements MarkdownInterface
{
    /**
     * @var Helper $helper
     */
    protected $helper;

    /**
     * @param Helper $helper
     */
    public function __construct(Helper $helper)
    {
        $this->helper = $helper;
    }

    /**
     * @param  string $text
     * @param  array  $options
     * @return string
     */
    public function __invoke(string $text, array $options = []) : string
    {
        return $this->parse($text, $options);
    }

    /**
     * @param  string $text
     * @param  array  $options
     * @return string
     */
    public function parse(string $text, array $options = []) : string
    {
        return $this->helper->getMarkdown($options)->parse($text);
    }
}
