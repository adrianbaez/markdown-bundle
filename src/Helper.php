<?php

namespace AdrianBaez\Bundle\MarkdownBundle;

use AdrianBaez\Bundle\MarkdownBundle\Interfaces\MarkdownParserInterface;

class Helper
{
    /**
     * @var string
     */
    protected $parserClass = MarkdownParser::class;

    /**
     * @var array $defaults
     */
    protected $defaults = [];

    /**
     * @var array $instances
     */
    protected $instances = [];

    /**
     * @param array $options
     * @return MarkdownParserInterface
     */
    public function getMarkdown($options = []): MarkdownParserInterface
    {
        $options = array_merge($this->defaults, $options);
        $instanceName = md5(serialize($options));
        if (!isset($this->instances[$instanceName])) {
            $class = $this->getParserClass();
            $parser = new $class;
            $this->instances[$instanceName] = $parser->setOptions($options);
        }
        return $this->instances[$instanceName];
    }

    /**
     * @param array $defaults
     * @return static
     */
    public function setDefaults(array $defaults)
    {
        $this->defaults = $defaults;
        return $this;
    }

    /**
     * @return string
     */
    public function getParserClass(): string
    {
        return $this->parserClass;
    }

    /**
     * @param string $parserClass
     * @return static
     */
    public function setParserClass(string $parserClass)
    {
        $this->parserClass = $parserClass;
        return $this;
    }
}
