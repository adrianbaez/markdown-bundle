<?php

namespace AdrianBaez\Bundle\MarkdownBundle\Tests;

use AdrianBaez\Bundle\MarkdownBundle\Helper;
use AdrianBaez\Bundle\MarkdownBundle\MarkdownExtra;
use PHPUnit\Framework\TestCase;

class MarkdownExtraTest extends TestCase
{
    public function testInvoke()
    {
        $mdExtra = new MarkdownExtra(new Helper);
        $this->assertEquals('<p><a href="http://example.com">http://example.com</a></p>', $mdExtra('http://example.com'));
        $this->assertEquals('<p>http://example.com</p>', $mdExtra('http://example.com', ['urls_linked' => false]));
        $this->assertEquals('<p><a href="http://example.com">http://example.com</a></p>', $mdExtra('http://example.com'));

        $this->assertEquals("<p>1st line\n2nd line</p>", $mdExtra("1st line \n 2nd line"));
        $this->assertEquals("<p>1st line<br />\n2nd line</p>", $mdExtra("1st line \n 2nd line", ['breaks_enabled' => true]));
        $this->assertEquals("<p>1st line\n2nd line</p>", $mdExtra("1st line \n 2nd line"));

        $this->assertEquals("<div><strong>*Some text*</strong></div>", $mdExtra("<div><strong>*Some text*</strong></div>"));
        $this->assertEquals("<p>&lt;div&gt;&lt;strong&gt;<em>Some text</em>&lt;/strong&gt;&lt;/div&gt;</p>", $mdExtra("<div><strong>*Some text*</strong></div>", ['markup_escaped' => true]));
        $this->assertEquals("<div><strong>*Some text*</strong></div>", $mdExtra("<div><strong>*Some text*</strong></div>"));

        $this->assertEquals("<script>alert('Hello world');</script>", $mdExtra("<script>alert('Hello world');</script>"));
        $this->assertEquals("<p>Hi &lt;script&gt;alert('Hello world');&lt;/script&gt;</p>", $mdExtra("Hi <script>alert('Hello world');</script>", ['safe_mode' => true]));
        $this->assertEquals("<script>alert('Hello world');</script>", $mdExtra("<script>alert('Hello world');</script>"));

        $text = <<<EOF
d title
: d description
EOF;
        $expected = <<<EOF
<dl>
<dt>d title</dt>
<dd>d description</dd>
</dl>
EOF;
        $this->assertEquals($expected, $mdExtra($text));
    }
}
