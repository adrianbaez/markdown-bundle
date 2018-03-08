<?php

namespace AdrianBaez\Bundle\MarkdownBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * TestCase.
 */
abstract class TestCase extends WebTestCase
{

    protected static $kernel;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $fs = new Filesystem();
        $fs->remove(sys_get_temp_dir().'/MarkdownBundle/');
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        static::$kernel = null;
    }

	/**
	 * Devuelve un servicio del container
	 * @param $options
	 * @return KernelInterface
	 */
    protected function getKernel($options = [])
    {
        if(!self::$kernel){
            self::$kernel = static::bootKernel($options = []);
        }
        return self::$kernel;
    }

	/**
	 * @param string $id
	 */
    protected function getService($id)
    {
        return $this->getKernel()->getContainer()->get($id);
    }
}
