<?php

namespace AdrianBaez\Bundle\MarkdownBundle\Tests;

use AdrianBaez\Bundle\MarkdownBundle\Tests\Functional\KernelCustomParsers;

class AdrianBaezMarkdownBundleCustomTest extends TestCase
{
    protected static $class = KernelCustomParsers::class;
    
    public function testServices()
    {
        $container = $this->getKernel()->getContainer();
        $md = $container->get('adrianbaez.markdown');
        $mdExtra = $container->get('adrianbaez.markdown_extra');
        
        $this->assertEquals("<p>Hello world</p>\ntest_parser", $md('Hello world'));
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
        $this->assertEquals($expected, $mdExtra($text));
    }
}
