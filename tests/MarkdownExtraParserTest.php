<?php

namespace AdrianBaez\Bundle\MarkdownBundle\Tests;

use AdrianBaez\Bundle\MarkdownBundle\MarkdownExtraParser;
use PHPUnit\Framework\TestCase;

class MarkdownExtraParserTest extends TestCase
{
    public function testParse()
    {
        $md = new MarkdownExtraParser;
        $text = <<<EOF
Title
: description
EOF;
        $expected = <<<EOF
<dl>
<dt>Title</dt>
<dd>description</dd>
</dl>
EOF;
        $this->assertEquals($expected, $md->parse($text));
    }
    
    public function testSetOptions()
    {
        $md = new MarkdownExtraParser;
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
