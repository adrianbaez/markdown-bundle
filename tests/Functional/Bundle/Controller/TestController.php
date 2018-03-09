<?php

namespace AdrianBaez\Bundle\MarkdownBundle\Tests\Functional\Bundle\Controller;

use AdrianBaez\Bundle\MarkdownBundle\Interfaces\MarkdownInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TestController extends Controller
{
    /**
     * @param  MarkdownInterface $md
     * @return Response
     */
    public function di(MarkdownInterface $md)
    {
        return new Response($md('controller di test'));
    }
}
