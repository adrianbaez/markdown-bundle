<?php

namespace AdrianBaez\Bundle\MarkdownBundle\Tests\Functional;

use AdrianBaez\Bundle\MarkdownBundle\Tests\TestCase;

class TestControllerTest extends TestCase
{
    public function testDi()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/di');
        $response = $client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('<p>controller di test</p>', $response->getContent());
    }
}
