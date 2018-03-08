<?php

namespace AdrianBaez\Bundle\MarkdownBundle\Interfaces;

interface MarkdownParserInterface
{
    /**
     * @param  string $instanceName
     * @return MarkdownParserInterface
     */
    public static function instance($instanceName = 'default');
    
    /**
     * @param  string $text
     * @return string
     */
    public function parse(string $text);
    
    /**
     * @param  bool $value
     */
    public function setUrlsLinked(bool $value);
    
    /**
     * @param  bool $value
     */
    public function setBreaksEnabled(bool $value);
    
    /**
     * @param  bool $value
     */
    public function setMarkupEscaped(bool $value);
    
    /**
     * @param  bool $value
     */
    public function setSafeMode(bool $value);
}
