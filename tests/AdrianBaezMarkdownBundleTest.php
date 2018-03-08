<?php

namespace AdrianBaez\Bundle\MarkdownBundle\Tests;

use AdrianBaez\Bundle\MarkdownBundle\Helper;

class AdrianBaezMarkdownBundleTest extends TestCase
{
    public function testServices()
    {
        $container = $this->getKernel()->getContainer();
        $this->assertFalse($container->has(Helper::class));
        $this->assertTrue($container->has('adrianbaez.markdown'));
        $this->assertTrue($container->has('adrianbaez.markdown_extra'));

        // Check Options

        $this->assertEquals('<p><a href="http://example.com">http://example.com</a></p>', ($container->get('adrianbaez.markdown'))('http://example.com'));
        $this->assertEquals("<p>1st line\n2nd line</p>", ($container->get('adrianbaez.markdown'))("1st line \n 2nd line", ['breaks_enabled' => false]));
        $this->assertEquals("<p>1st line<br />\n2nd line</p>", ($container->get('adrianbaez.markdown'))("1st line \n 2nd line"));
        $this->assertEquals("<div><strong>*Some text*</strong></div>", ($container->get('adrianbaez.markdown'))("<div><strong>*Some text*</strong></div>"));
        $this->assertEquals("<script>alert('Hello world');</script>", ($container->get('adrianbaez.markdown'))("<script>alert('Hello world');</script>"));
        $this->assertEquals("<p>Hello world</p>", $container->get('adrianbaez.markdown')->parse('Hello world'));
    }
}
