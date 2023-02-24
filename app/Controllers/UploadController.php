<?php

namespace ValorantFM\Controllers;

use DI\Container;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UploadController
{
    private const SAVE_IMAGE_PATH = '../public/images/';
    private const DISPLAY_IMAGE_PATH = '../public/images/';

    private Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function upload(Request $request, Response $response)
    {
        $service = $this->container->get('uploaderService');
        $assign['file_path'] = self::DISPLAY_IMAGE_PATH . $service->moveUploadedFile(self::SAVE_IMAGE_PATH, $request);

        return $response
            ->withHeader('Location', '/')
            ->withStatus(200);
    }
}