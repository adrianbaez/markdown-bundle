<?php

namespace AdrianBaez\Bundle\MarkdownBundle\Tests;

use AdrianBaez\Bundle\MarkdownBundle\MarkdownParser;
use PHPUnit\Framework\TestCase;

class MarkdownParserTest extends TestCase
{
    public function testParse()
    {
        $md = new MarkdownParser;
        $this->assertEquals('<p><a href="http://example.com">http://example.com</a></p>', $md->parse('http://example.com'));
    }
    
    public function testSetOptions()
    {
        $md = new MarkdownParser;
        $setOptionsOutput = $md->setOptions(['urls_linked' => false]);
        $this->assertSame($md, $setOptionsOutput);
        $this->assertEquals('<p>http://example.com</p>', $md->parse('http://example.com'));
        $exceptionThrowed = false;
        try {
            $md->setOptions(['invalid_option' => false]);
        } catch (\RuntimeException $e) {
            $exceptionThrowed = true;
            $this->assertEquals('The option "invalid_option" is not available.', $e->getMessage());
        }
        $this->assertTrue($exceptionThrowed);
        
    }
}
