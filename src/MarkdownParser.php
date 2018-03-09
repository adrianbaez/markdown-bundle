<?php

namespace AdrianBaez\Bundle\MarkdownBundle;

use AdrianBaez\Bundle\MarkdownBundle\Interfaces\MarkdownParserInterface;
use Parsedown;
use ReflectionMethod;
use RuntimeException;

class MarkdownParser implements MarkdownParserInterface
{
    /**
     * @var Parsedown $parser
     */

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
            $tokens = explode('_', $key);
            $tokens = array_map(function ($token) {
                return ucfirst($token);
            }, $tokens);
            $method = sprintf('set%s', implode('', $tokens));

            if (method_exists($this->parser, $method)) {
                $reflection = new ReflectionMethod($this->parser, $method);
                if ($reflection->isPublic()) {
                    $this->parser->$method($value);
                    continue;
                }
            }
            throw new RuntimeException(sprintf('The option "%s" is not available.', $key));
        }
        return $this;
    }
}
