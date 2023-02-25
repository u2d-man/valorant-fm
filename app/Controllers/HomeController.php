<?php

namespace ValorantFM\Controllers;

use DI\Container;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class HomeController
{
    private const DISPLAY_IMAGE_PATH = '../public/images/';

    private Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function index(Request $request, Response $response, array $args)
    {
        $files = glob(self::DISPLAY_IMAGE_PATH . "*");
        $replacedPath = str_replace('../public', '', $files);
        $assign['files'] = $replacedPath;
        $view = $this->container->get('twig');

        return $view->render($response, 'index.html', $assign);
    }
}
