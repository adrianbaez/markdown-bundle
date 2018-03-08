<?php

namespace AdrianBaez\Bundle\MarkdownBundle\Tests;

use AdrianBaez\Bundle\MarkdownBundle\Interfaces\MarkdownParserInterface;
use AdrianBaez\Bundle\MarkdownBundle\Interfaces\MarkdownExtraParserInterface;
use PHPUnit\Framework\TestCase;

class HelperTest extends TestCase
{

    public function testGetMarkdown()
    {
        $parser = new TestHelper;
        $mdDefault = $parser->getMarkdown();
        $this->assertTrue($mdDefault instanceof MarkdownParserInterface);
        $this->assertTrue($parser->hasInstance('default_1000'));
        $this->assertEquals(['default_1000'], array_keys($parser->getInstances()));

        // default values

        $this->assertTrue($parser->getDefaultValue('urls_linked'));
        $this->assertFalse($parser->getDefaultValue('markup_escaped'));
        $this->assertFalse($parser->getDefaultValue('breaks_enabled'));
        $this->assertFalse($parser->getDefaultValue('safe_mode'));

        // values are asigned
        $this->assertEquals('<p><a href="http://example.com">http://example.com</a></p>', $mdDefault->text('http://example.com'));
        $this->assertEquals("<p>1st line\n2nd line</p>", $mdDefault->text("1st line \n 2nd line"));
        $this->assertEquals("<div><strong>*Some text*</strong></div>", $mdDefault->text("<div><strong>*Some text*</strong></div>"));
        $this->assertEquals("<script>alert('Hello world');</script>", $mdDefault->text("<script>alert('Hello world');</script>"));

        // Options changed for one instance
        $md1 = $parser->getMarkdown([
            'urls_linked' => false,
            'markup_escaped' => true,
            'breaks_enabled' => true,
            'safe_mode' => false
        ]);
        $this->assertTrue($md1 instanceof MarkdownParserInterface);
        $this->assertTrue($parser->hasInstance('default_0110'));
        $this->assertEquals(['default_1000', 'default_0110'], array_keys($parser->getInstances()));
        $this->assertNotSame($md1, $mdDefault);

        // Same options same instance
        $md1b = $parser->getMarkdown([
            'urls_linked' => false,
            'markup_escaped' => true,
            'breaks_enabled' => true,
            'safe_mode' => false
        ]);
        $this->assertEquals(['default_1000', 'default_0110'], array_keys($parser->getInstances()));
        $this->assertSame($md1, $md1b);

        // default values not changed

        $this->assertTrue($parser->getDefaultValue('urls_linked'));
        $this->assertFalse($parser->getDefaultValue('markup_escaped'));
        $this->assertFalse($parser->getDefaultValue('breaks_enabled'));
        $this->assertFalse($parser->getDefaultValue('safe_mode'));

        // values are asigned
        $this->assertEquals('<p>http://example.com</p>', $md1->text('http://example.com'));
        $this->assertEquals("<p>1st line<br />\n2nd line</p>", $md1->text("1st line \n 2nd line"));
        $this->assertEquals("<p>&lt;div&gt;&lt;strong&gt;<em>Some text</em>&lt;/strong&gt;&lt;/div&gt;</p>", $md1->text("<div><strong>*Some text*</strong></div>"));
        $this->assertEquals("<p>Hi &lt;script&gt;alert('Hello world');&lt;/script&gt;</p>", $md1->text("Hi <script>alert('Hello world');</script>"));

        $md2 = $parser->getMarkdown([
            'urls_linked' => false,
            'markup_escaped' => false,
            'breaks_enabled' => false,
            'safe_mode' => true
        ]);
        $this->assertEquals("<p>&lt;div&gt;&lt;strong&gt;<em>Some text</em>&lt;/strong&gt;&lt;/div&gt;</p>", $md2->text("<div><strong>*Some text*</strong></div>"));
        $this->assertEquals("<p>Hi &lt;script&gt;alert('Hello world');&lt;/script&gt;</p>", $md2->text("Hi <script>alert('Hello world');</script>"));
    }

    public function testGetMarkdownExtra()
    {
        $parser = new TestHelper;
        $mdDefault = $parser->getMarkdownExtra();
        $this->assertTrue($mdDefault instanceof MarkdownExtraParserInterface);
        $this->assertTrue($parser->hasInstance('extra_1000'));
        $this->assertEquals(['extra_1000'], array_keys($parser->getInstances()));

        // default values

        $this->assertTrue($parser->getDefaultValue('urls_linked'));
        $this->assertFalse($parser->getDefaultValue('markup_escaped'));
        $this->assertFalse($parser->getDefaultValue('breaks_enabled'));
        $this->assertFalse($parser->getDefaultValue('safe_mode'));

        // values are asigned
        $this->assertEquals('<p><a href="http://example.com">http://example.com</a></p>', $mdDefault->text('http://example.com'));
        $this->assertEquals("<p>1st line\n2nd line</p>", $mdDefault->text("1st line \n 2nd line"));
        $this->assertEquals("<div><strong>*Some text*</strong></div>", $mdDefault->text("<div><strong>*Some text*</strong></div>"));
        $this->assertEquals("<script>alert('Hello world');</script>", $mdDefault->text("<script>alert('Hello world');</script>"));

        // Options changed for one instance
        $md1 = $parser->getMarkdownExtra([
            'urls_linked' => false,
            'markup_escaped' => true,
            'breaks_enabled' => true,
            'safe_mode' => false
        ]);
        $this->assertTrue($md1 instanceof MarkdownExtraParserInterface);
        $this->assertTrue($parser->hasInstance('extra_0110'));
        $this->assertEquals(['extra_1000', 'extra_0110'], array_keys($parser->getInstances()));
        $this->assertNotSame($md1, $mdDefault);

        // Same options same instance
        $md1b = $parser->getMarkdownExtra([
            'urls_linked' => false,
            'markup_escaped' => true,
            'breaks_enabled' => true,
            'safe_mode' => false
        ]);
        $this->assertEquals(['extra_1000', 'extra_0110'], array_keys($parser->getInstances()));
        $this->assertSame($md1, $md1b);

        // default values not changed

        $this->assertTrue($parser->getDefaultValue('urls_linked'));
        $this->assertFalse($parser->getDefaultValue('markup_escaped'));
        $this->assertFalse($parser->getDefaultValue('breaks_enabled'));
        $this->assertFalse($parser->getDefaultValue('safe_mode'));

        // values are asigned
        $this->assertEquals('<p>http://example.com</p>', $md1->text('http://example.com'));
        $this->assertEquals("<p>1st line<br />\n2nd line</p>", $md1->text("1st line \n 2nd line"));
        $this->assertEquals("<p>&lt;div&gt;&lt;strong&gt;<em>Some text</em>&lt;/strong&gt;&lt;/div&gt;</p>", $md1->text("<div><strong>*Some text*</strong></div>"));
        $this->assertEquals("<p>Hi &lt;script&gt;alert('Hello world');&lt;/script&gt;</p>", $md1->text("Hi <script>alert('Hello world');</script>"));

        $md2 = $parser->getMarkdownExtra([
            'urls_linked' => false,
            'markup_escaped' => false,
            'breaks_enabled' => false,
            'safe_mode' => true
        ]);
        $this->assertEquals("<p>&lt;div&gt;&lt;strong&gt;<em>Some text</em>&lt;/strong&gt;&lt;/div&gt;</p>", $md2->text("<div><strong>*Some text*</strong></div>"));
        $this->assertEquals("<p>Hi &lt;script&gt;alert('Hello world');&lt;/script&gt;</p>", $md2->text("Hi <script>alert('Hello world');</script>"));

        $md2Default = $parser->getMarkdown([
            'urls_linked' => false,
            'markup_escaped' => false,
            'breaks_enabled' => false,
            'safe_mode' => true
        ]);
        $this->assertEquals(['extra_1000', 'extra_0110', 'extra_0001', 'default_0001'], array_keys($parser->getInstances()));
        $this->assertNotSame($md2, $md2Default);
    }

    public function testSetDefaults()
    {
        $parser = new TestHelper;
        $parser->setDefaults([
            'urls_linked' => false,
            'markup_escaped' => false,
            'breaks_enabled' => false,
            'safe_mode' => false
        ]);
        $md1 = $parser->getMarkdown();
        $this->assertTrue($parser->hasInstance('default_0000'));

        // default values

        $this->assertFalse($parser->getDefaultValue('urls_linked'));
        $this->assertFalse($parser->getDefaultValue('markup_escaped'));
        $this->assertFalse($parser->getDefaultValue('breaks_enabled'));
        $this->assertFalse($parser->getDefaultValue('safe_mode'));

        $parser->setDefaults([
            'urls_linked' => false,
            'markup_escaped' => false,
            'breaks_enabled' => false,
            'safe_mode' => false
        ]);
        $md1b = $parser->getMarkdown();
        $this->assertSame($md1, $md1b);

        $parser->setDefaults([
            'urls_linked' => true,
            'markup_escaped' => true,
            'breaks_enabled' => true,
            'safe_mode' => true
        ]);
        $md2 = $parser->getMarkdown();
        $this->assertNotSame($md1, $md2);

        // default values

        $this->assertTrue($parser->getDefaultValue('urls_linked'));
        $this->assertTrue($parser->getDefaultValue('markup_escaped'));
        $this->assertTrue($parser->getDefaultValue('breaks_enabled'));
        $this->assertTrue($parser->getDefaultValue('safe_mode'));

        $md3 = $parser->getMarkdown([
            'urls_linked' => false,
            'markup_escaped' => false,
            'breaks_enabled' => false,
            'safe_mode' => false
        ]);
        $this->assertSame($md1, $md3);

        // default values

        $this->assertTrue($parser->getDefaultValue('urls_linked'));
        $this->assertTrue($parser->getDefaultValue('markup_escaped'));
        $this->assertTrue($parser->getDefaultValue('breaks_enabled'));
        $this->assertTrue($parser->getDefaultValue('safe_mode'));
    }
    
    public function testSetMarkdownParserClass()
    {
        $parser = new TestHelper;
        $parser->setMarkdownParserClass(TestParser::class);
        $md = $parser->getMarkdown();
        $this->assertTrue($md instanceof TestParser);
        $this->assertEquals("<p>Hello world</p>\ntest_parser", $md->parse('Hello world'));
    }
    
    public function testSetMarkdownExtraParserClass()
    {
        $parser = new TestHelper;
        $parser->setMarkdownExtraParserClass(TestExtraParser::class);
        $mdExtra = $parser->getMarkdownExtra();
        $this->assertTrue($mdExtra instanceof TestExtraParser);
        
        $text = <<<EOF
d title
: d description
EOF;
        $expected = <<<EOF
<dl>
<dt>d title</dt>
<dd>d description</dd>
</dl>
test_extra_parser
EOF;
        $this->assertEquals($expected, $mdExtra->parse($text));
    }
}
