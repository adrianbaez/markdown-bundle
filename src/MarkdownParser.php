<?php

namespace AdrianBaez\Bundle\MarkdownBundle;

use AdrianBaez\Bundle\MarkdownBundle\Interfaces\MarkdownParserInterface;
use Parsedown;
use RuntimeException;

class MarkdownParser implements MarkdownParserInterface
{
    /**
     * @var Parsedown $parser
     */
    protected $parser;

    public function __construct()
    {
        $this->parser = new Parsedown;
    }

    /**
     * @inheritDoc
     */
    public function parse(string $text) :string
    {
        return $this->parser->text($text);
    }

    /**
     * @inheritDoc
     */
    public function setOptions(array $options): MarkdownParserInterface
    {
        foreach ($options as $key => $value) {
            $method = 'set'.str_replace('_', '', ucwords($key, '_'));
            if (!method_exists($this->parser, $method)) {
                throw new RuntimeException(sprintf('The option "%s" is not available.', $key));
            }
            $this->parser->$method($value);
        }
        return $this;
    }
}
