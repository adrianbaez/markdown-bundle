<?php

namespace AdrianBaez\Bundle\MarkdownBundle\Tests;

use AdrianBaez\Bundle\MarkdownBundle\Twig\MarkdownRuntime;
use AdrianBaez\Bundle\MarkdownBundle\Twig\MarkdownExtension;
use AdrianBaez\Bundle\MarkdownBundle\Tests\TestCase;
use Twig\Environment;
use Twig\Loader\ArrayLoader;
use Twig\RuntimeLoader\FactoryRuntimeLoader;

class MarkdownExtensionTest extends TestCase
{
    public function testGetServices()
    {
        $md = $this->getService('adrianbaez.markdown');
        $runtimeLoader = new FactoryRuntimeLoader(
            [
                MarkdownRuntime::class => function() use($md){
                    return new MarkdownRuntime($md);
                }
            ]
        );
        $extension = new MarkdownExtension;
        $templates = [
            'default' => "{{ text|markdown }}",
            'options' => "{{ text|markdown(options) }}",
            'inline_options' => "{{ text|markdown({breaks_enabled:false}) }}",
        ];
        $twig = new Environment(new ArrayLoader($templates));
        $twig->addExtension($extension);
        $twig->addRuntimeLoader($runtimeLoader);
        $this->assertEquals("<p>Hello<br />\nworld</p>", $twig->render('default', ['text' => "Hello\nworld"]));
        $this->assertEquals("<p>Hello\nworld</p>", $twig->render('options', ['text' => "Hello\nworld", 'options' => ['breaks_enabled' => false]]));
        $this->assertEquals("<p>Hello\nworld</p>", $twig->render('inline_options', ['text' => "Hello\nworld"]));
    }
}
