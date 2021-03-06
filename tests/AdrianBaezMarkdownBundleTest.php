<?php

namespace AdrianBaez\Bundle\MarkdownBundle\Tests;

use AdrianBaez\Bundle\MarkdownBundle\Helper;
use AdrianBaez\Bundle\MarkdownBundle\Tests\Functional\Kernel;

class AdrianBaezMarkdownBundleTest extends TestCase
{
    public function testServices()
    {
        $kernel = $this->getKernel();
        $container = $kernel->getContainer();
        $this->assertEquals(Kernel::class, get_class($kernel));
        $this->assertFalse($container->has(Helper::class));
        $this->assertTrue($container->has('adrian_baez.markdown'));

        // Check Options

        $this->assertEquals('<p><a href="http://example.com">http://example.com</a></p>', ($container->get('adrian_baez.markdown'))('http://example.com'));
        $this->assertEquals("<p>1st line\n2nd line</p>", ($container->get('adrian_baez.markdown'))("1st line \n 2nd line", ['breaks_enabled' => false]));
        $this->assertEquals("<p>1st line<br />\n2nd line</p>", ($container->get('adrian_baez.markdown'))("1st line \n 2nd line"));
        $this->assertEquals("<div><strong>*Some text*</strong></div>", ($container->get('adrian_baez.markdown'))("<div><strong>*Some text*</strong></div>"));
        $this->assertEquals("<script>alert('Hello world');</script>", ($container->get('adrian_baez.markdown'))("<script>alert('Hello world');</script>"));
        $this->assertEquals("<p>Hello world</p>", $container->get('adrian_baez.markdown')->parse('Hello world'));
    }
}
