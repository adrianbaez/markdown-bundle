<?php

namespace AdrianBaez\Bundle\MarkdownBundle\Twig;

use Twig\TwigFilter;
use Twig\Extension\AbstractExtension;

class MarkdownExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter(
                'markdown',
                [MarkdownRuntime::class, 'parse'],
                [
                    'is_safe' => ['html']
                ]
            ),
        ];
    }
}
