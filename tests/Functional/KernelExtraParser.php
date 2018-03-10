<?php

namespace AdrianBaez\Bundle\MarkdownBundle\Tests\Functional;

use Symfony\Component\Config\Loader\LoaderInterface;

/**
 * Kernel.
 */
class KernelExtraParser extends Kernel
{
    /**
     * {@inheritdoc}
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        parent::registerContainerConfiguration($loader);
        $loader->load(__DIR__.'/config/extra_parser.yaml');
    }
}
