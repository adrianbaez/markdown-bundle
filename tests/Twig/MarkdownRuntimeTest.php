<?php

namespace AdrianBaez\Bundle\MarkdownBundle\Tests;

use AdrianBaez\Bundle\MarkdownBundle\Twig\MarkdownRuntime;
use AdrianBaez\Bundle\MarkdownBundle\Tests\TestCase;

class MarkdownRuntimeTest extends TestCase
{
    public function testParse()
    {
        $mdRuntime = new MarkdownRuntime($this->getService('adrian_baez.markdown'));
        $this->assertEquals('<p><a href="http://example.com">http://example.com</a></p>', $mdRuntime->parse('http://example.com'));
        $this->assertEquals('<p>http://example.com</p>', $mdRuntime->parse('http://example.com', ['urls_linked' => false]));
        $this->assertEquals('<p><a href="http://example.com">http://example.com</a></p>', $mdRuntime->parse('http://example.com'));

        $this->assertEquals("<p>1st line<br />\n2nd line</p>", $mdRuntime->parse("1st line \n 2nd line"));
        $this->assertEquals("<p>1st line\n2nd line</p>", $mdRuntime->parse("1st line \n 2nd line", ['breaks_enabled' => false]));
        $this->assertEquals("<p>1st line<br />\n2nd line</p>", $mdRuntime->parse("1st line \n 2nd line"));

        $this->assertEquals("<div><strong>*Some text*</strong></div>", $mdRuntime->parse("<div><strong>*Some text*</strong></div>"));
        $this->assertEquals("<p>&lt;div&gt;&lt;strong&gt;<em>Some text</em>&lt;/strong&gt;&lt;/div&gt;</p>", $mdRuntime->parse("<div><strong>*Some text*</strong></div>", ['markup_escaped' => true]));
        $this->assertEquals("<div><strong>*Some text*</strong></div>", $mdRuntime->parse("<div><strong>*Some text*</strong></div>"));

        $this->assertEquals("<script>alert('Hello world');</script>", $mdRuntime->parse("<script>alert('Hello world');</script>"));
        $this->assertEquals("<p>Hi &lt;script&gt;alert('Hello world');&lt;/script&gt;</p>", $mdRuntime->parse("Hi <script>alert('Hello world');</script>", ['safe_mode' => true]));
        $this->assertEquals("<script>alert('Hello world');</script>", $mdRuntime->parse("<script>alert('Hello world');</script>"));
    }
}
