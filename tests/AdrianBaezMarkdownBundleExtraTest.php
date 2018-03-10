<?php

namespace AdrianBaez\Bundle\MarkdownBundle\Tests;

use AdrianBaez\Bundle\MarkdownBundle\Tests\Functional\KernelExtraParser;

class AdrianBaezMarkdownBundleExtraTest extends TestCase
{
    protected static $class = KernelExtraParser::class;

    public function testServices()
    {
        $kernel = $this->getKernel();
        $container = $kernel->getContainer();
        $this->assertEquals(KernelExtraParser::class, get_class($kernel));
        $md = $container->get('adrianbaez.markdown');
        
        $text = <<<EOF
Title
: description
EOF;
        $expected = <<<EOF
<dl>
<dt>Title</dt>
<dd>description</dd>
</dl>
EOF;
        $this->assertEquals($expected, $md->parse($text));
    }
}
