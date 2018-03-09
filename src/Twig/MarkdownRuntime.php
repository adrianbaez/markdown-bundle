<?php

namespace AdrianBaez\Bundle\MarkdownBundle\Twig;

use AdrianBaez\Bundle\MarkdownBundle\Interfaces\MarkdownInterface;

class MarkdownRuntime
{
    /**
     * @var MarkdownInterface $markdown
     */
    protected $markdown;
    
    /**
     * @param MarkdownInterface $markdown
     */
    public function __construct(MarkdownInterface $markdown)
    {
        $this->markdown = $markdown;
    }
    
    /**
     * @param  string $text
     * @param  iterable  $options
     * @return string
     */
    public function parse(string $text, iterable $options = []): string
    {
        return $this->markdown->parse($text, $options);
    }
}
