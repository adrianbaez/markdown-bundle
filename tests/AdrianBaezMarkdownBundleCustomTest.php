<?php

namespace AdrianBaez\Bundle\MarkdownBundle\Tests;

use AdrianBaez\Bundle\MarkdownBundle\Tests\Functional\KernelCustomParser;

class AdrianBaezMarkdownBundleCustomTest extends TestCase
{
    protected static $class = KernelCustomParser::class;

    public function testServices()
    {
        $kernel = $this->getKernel();
        $container = $kernel->getContainer();
        $this->assertEquals(KernelCustomParser::class, get_class($kernel));
        $md = $container->get('adrian_baez.markdown');

        $this->assertEquals("<p>Hello world</p>\ntest_parser", $md('Hello world'));
    }
}
