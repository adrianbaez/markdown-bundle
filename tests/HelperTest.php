<?php

namespace AdrianBaez\Bundle\MarkdownBundle\Tests;

use AdrianBaez\Bundle\MarkdownBundle\Interfaces\MarkdownParserInterface;
use PHPUnit\Framework\TestCase;

class HelperTest extends TestCase
{
    public function testGetMarkdown()
    {
        $parser = new TestHelper;
        $mdDefault = $parser->getMarkdown();
        $this->assertTrue($mdDefault instanceof MarkdownParserInterface);
        $this->assertTrue($parser->hasInstance('40cd750bba9870f18aada2478b24840a'));
        $this->assertEquals(['40cd750bba9870f18aada2478b24840a'], array_keys($parser->getInstances()));

        // Default behavior
        $this->assertEquals('<p><a href="http://example.com">http://example.com</a></p>', $mdDefault->parse('http://example.com'));
        $this->assertEquals("<p>1st line\n2nd line</p>", $mdDefault->parse("1st line \n 2nd line"));
        $this->assertEquals("<div><strong>*Some text*</strong></div>", $mdDefault->parse("<div><strong>*Some text*</strong></div>"));
        $this->assertEquals("<script>alert('Hello world');</script>", $mdDefault->parse("<script>alert('Hello world');</script>"));

        // Options changed for one instance
        $md1 = $parser->getMarkdown([
            'urls_linked' => false,
            'markup_escaped' => true,
            'breaks_enabled' => true,
            'safe_mode' => false
        ]);
        $this->assertTrue($md1 instanceof MarkdownParserInterface);
        $this->assertTrue($parser->hasInstance('a10b231c21137b1f499c9ebde4ffd974'));
        $this->assertEquals([
            '40cd750bba9870f18aada2478b24840a',
            'a10b231c21137b1f499c9ebde4ffd974',
        ], array_keys($parser->getInstances()));
        $this->assertNotSame($md1, $mdDefault);

        // Same options same instance
        $md1b = $parser->getMarkdown([
            'urls_linked' => false,
            'markup_escaped' => true,
            'breaks_enabled' => true,
            'safe_mode' => false
        ]);
        $this->assertEquals([
            '40cd750bba9870f18aada2478b24840a',
            'a10b231c21137b1f499c9ebde4ffd974',
        ], array_keys($parser->getInstances()));
        $this->assertSame($md1, $md1b);

        // values are asigned
        $this->assertEquals('<p>http://example.com</p>', $md1->parse('http://example.com'));
        $this->assertEquals("<p>1st line<br />\n2nd line</p>", $md1->parse("1st line \n 2nd line"));
        $this->assertEquals("<p>&lt;div&gt;&lt;strong&gt;<em>Some text</em>&lt;/strong&gt;&lt;/div&gt;</p>", $md1->parse("<div><strong>*Some text*</strong></div>"));
        $this->assertEquals("<p>Hi &lt;script&gt;alert('Hello world');&lt;/script&gt;</p>", $md1->parse("Hi <script>alert('Hello world');</script>"));

        $md2 = $parser->getMarkdown([
            'urls_linked' => false,
            'markup_escaped' => false,
            'breaks_enabled' => false,
            'safe_mode' => true
        ]);
        $this->assertEquals("<p>&lt;div&gt;&lt;strong&gt;<em>Some text</em>&lt;/strong&gt;&lt;/div&gt;</p>", $md2->parse("<div><strong>*Some text*</strong></div>"));
        $this->assertEquals("<p>Hi &lt;script&gt;alert('Hello world');&lt;/script&gt;</p>", $md2->parse("Hi <script>alert('Hello world');</script>"));
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
        $this->assertTrue($parser->hasInstance('976647117ce29c3b33d47a34b43f322f'));
        $this->assertEquals([
            '976647117ce29c3b33d47a34b43f322f',
        ], array_keys($parser->getInstances()));

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

    public function testSetParserClass()
    {
        $parser = new TestHelper;
        $parser->setParserClass(CustomParser::class);
        $md = $parser->getMarkdown();
        $this->assertTrue($md instanceof CustomParser);
        $this->assertEquals("<p>Hello world</p>\ntest_parser", $md->parse('Hello world'));
    }
}
