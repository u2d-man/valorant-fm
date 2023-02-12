<?php

namespace ValorantFM\Controllers;

use DI\Container;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class HomeController
{
    private Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function index(Request $request, Response $response, array $args)
    {
        $assign['first'] = 'Elton';
        $assign['last'] = 'Davy';
        $view = $this->container->get('twig');

        return $view->render($response, 'index.html', $args);
    }
}
