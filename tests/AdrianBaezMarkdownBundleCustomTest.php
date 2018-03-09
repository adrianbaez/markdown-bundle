<?php

namespace AdrianBaez\Bundle\MarkdownBundle\Tests;

use AdrianBaez\Bundle\MarkdownBundle\Tests\Functional\KernelCustomParser;

class AdrianBaezMarkdownBundleCustomTest extends TestCase
{
    protected static $class = KernelCustomParser::class;

    public function testServices()
    {
        $container = $this->getKernel()->getContainer();
        $md = $container->get('adrianbaez.markdown');

        $this->assertEquals("<p>Hello world</p>\ntest_parser", $md('Hello world'));
    }
}
