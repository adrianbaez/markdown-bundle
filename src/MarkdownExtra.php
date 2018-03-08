<?php

namespace AdrianBaez\Bundle\MarkdownBundle;

use AdrianBaez\Bundle\MarkdownBundle\Interfaces\MarkdownExtraInterface;

class MarkdownExtra implements MarkdownExtraInterface
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
        return $this->helper->getMarkdownExtra($options)->parse($text);
    }
}
