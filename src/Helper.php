<?php

namespace AdrianBaez\Bundle\MarkdownBundle;

use AdrianBaez\Bundle\MarkdownBundle\Interfaces\MarkdownParserInterface;
use AdrianBaez\Bundle\MarkdownBundle\Interfaces\MarkdownExtraParserInterface;

class Helper
{
    /**
     * @var string
     */
    protected $markdownExtraParserClass = MarkdownExtraParser::class;
    
    /**
     * @var string
     */
    protected $markdownParserClass = MarkdownParser::class;
    
    /**
     * @var array $defaults
     */
    protected $defaults = [
        'urls_linked' => true,
        'breaks_enabled' => false,
        'markup_escaped' => false,
        'safe_mode' => false,
    ];

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
        $instanceName = $this->getInstanceNameFromOptions('default_', $options);
        if (!isset($this->instances[$instanceName])){
            $parser = call_user_func([$this->getMarkdownParserClass(), 'instance'], $instanceName);
            $this->instances[$instanceName] = $this->configureInstance($parser, $options);
        }
        return $this->instances[$instanceName];
    }

    /**
     * @param array $options
     * @return MarkdownExtraParserInterface
     */
    public function getMarkdownExtra($options = []): MarkdownExtraParserInterface
    {
        $instanceName = $this->getInstanceNameFromOptions('extra_', $options);
        if (!isset($this->instances[$instanceName])){
            $parser = call_user_func([$this->getMarkdownExtraParserClass(), 'instance'], $instanceName);
            $this->instances[$instanceName] = $this->configureInstance($parser, $options);
        }
        return $this->instances[$instanceName];
    }

    /**
     * @param array $defaults
     * @return static
     */
    public function setDefaults(array $defaults)
    {
        $this->defaults = array_merge($this->defaults, $defaults);
        return $this;
    }
    
    /**
     * @return string
     */
    public function getMarkdownExtraParserClass(): string
    {
        return $this->markdownExtraParserClass;
    }

    /**
     * @param string $markdownExtraParserClass
     *
     * @return static
     */
    public function setMarkdownExtraParserClass(
        string $markdownExtraParserClass
    ) {
        $this->markdownExtraParserClass = $markdownExtraParserClass;
        return $this;
    }

    /**
     * @return string
     */
    public function getMarkdownParserClass(): string
    {
        return $this->markdownParserClass;
    }

    /**
     * @param string $markdownParserClass
     *
     * @return static
     */
    public function setMarkdownParserClass(string $markdownParserClass)
    {
        $this->markdownParserClass = $markdownParserClass;
        return $this;
    }

    /**
     * @param  string $prefix
     * @param  array $options
     * @return string
     */
    protected function getInstanceNameFromOptions(string $prefix, array $options) : string
    {
        $options = array_merge($this->defaults, $options);
        $name = $prefix;
        $name .= $options['urls_linked'] ? '1' : '0';
        $name .= $options['breaks_enabled'] ? '1' : '0';
        $name .= $options['markup_escaped'] ? '1' : '0';
        $name .= $options['safe_mode'] ? '1' : '0';
        return $name;
    }

    /**
     * @param  MarkdownParserInterface $instance
     * @param  array $options
     * @return string
     */
    protected function configureInstance(MarkdownParserInterface $instance, array $options)
    {
        $options = array_merge($this->defaults, $options);
        $instance->setUrlsLinked($options['urls_linked']);
        $instance->setBreaksEnabled($options['breaks_enabled']);
        $instance->setMarkupEscaped($options['markup_escaped']);
        $instance->setSafeMode($options['safe_mode']);
        return $instance;
    }
}
