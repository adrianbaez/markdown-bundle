<?php

namespace AdrianBaez\Bundle\MarkdownBundle\Tests;

use AdrianBaez\Bundle\MarkdownBundle\Helper;
use AdrianBaez\Bundle\MarkdownBundle\Markdown;
use PHPUnit\Framework\TestCase;

class MarkdownTest extends TestCase
{
    public function testInvoke()
    {
        $md = new Markdown(new Helper);
        $this->assertEquals('<p><a href="http://example.com">http://example.com</a></p>', $md('http://example.com'));
        $this->assertEquals('<p>http://example.com</p>', $md('http://example.com', ['urls_linked' => false]));
        $this->assertEquals('<p><a href="http://example.com">http://example.com</a></p>', $md('http://example.com'));

        $this->assertEquals("<p>1st line\n2nd line</p>", $md("1st line \n 2nd line"));
        $this->assertEquals("<p>1st line<br />\n2nd line</p>", $md("1st line \n 2nd line", ['breaks_enabled' => true]));
        $this->assertEquals("<p>1st line\n2nd line</p>", $md("1st line \n 2nd line"));

        $this->assertEquals("<div><strong>*Some text*</strong></div>", $md("<div><strong>*Some text*</strong></div>"));
        $this->assertEquals("<p>&lt;div&gt;&lt;strong&gt;<em>Some text</em>&lt;/strong&gt;&lt;/div&gt;</p>", $md("<div><strong>*Some text*</strong></div>", ['markup_escaped' => true]));
        $this->assertEquals("<div><strong>*Some text*</strong></div>", $md("<div><strong>*Some text*</strong></div>"));

        $this->assertEquals("<script>alert('Hello world');</script>", $md("<script>alert('Hello world');</script>"));
        $this->assertEquals("<p>Hi &lt;script&gt;alert('Hello world');&lt;/script&gt;</p>", $md("Hi <script>alert('Hello world');</script>", ['safe_mode' => true]));
        $this->assertEquals("<script>alert('Hello world');</script>", $md("<script>alert('Hello world');</script>"));
    }
    
    public function testParse()
    {
        $md = new Markdown(new Helper);
        $this->assertEquals('<p><a href="http://example.com">http://example.com</a></p>', $md->parse('http://example.com'));
        $this->assertEquals('<p>http://example.com</p>', $md->parse('http://example.com', ['urls_linked' => false]));
        $this->assertEquals('<p><a href="http://example.com">http://example.com</a></p>', $md->parse('http://example.com'));

        $this->assertEquals("<p>1st line\n2nd line</p>", $md->parse("1st line \n 2nd line"));
        $this->assertEquals("<p>1st line<br />\n2nd line</p>", $md->parse("1st line \n 2nd line", ['breaks_enabled' => true]));
        $this->assertEquals("<p>1st line\n2nd line</p>", $md->parse("1st line \n 2nd line"));

        $this->assertEquals("<div><strong>*Some text*</strong></div>", $md->parse("<div><strong>*Some text*</strong></div>"));
        $this->assertEquals("<p>&lt;div&gt;&lt;strong&gt;<em>Some text</em>&lt;/strong&gt;&lt;/div&gt;</p>", $md->parse("<div><strong>*Some text*</strong></div>", ['markup_escaped' => true]));
        $this->assertEquals("<div><strong>*Some text*</strong></div>", $md->parse("<div><strong>*Some text*</strong></div>"));

        $this->assertEquals("<script>alert('Hello world');</script>", $md->parse("<script>alert('Hello world');</script>"));
        $this->assertEquals("<p>Hi &lt;script&gt;alert('Hello world');&lt;/script&gt;</p>", $md->parse("Hi <script>alert('Hello world');</script>", ['safe_mode' => true]));
        $this->assertEquals("<script>alert('Hello world');</script>", $md->parse("<script>alert('Hello world');</script>"));
    }
}
