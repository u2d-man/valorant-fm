<?php

declare(strict_types=1);

use App\Application\Handlers\AuthHandler;
use App\Application\Handlers\RegisterHandler;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello world!');
        return $response;
    });

    $app->post('/api/register', RegisterHandler::class . ':postRegister');
    $app->post('/api/auth', AuthHandler::class . ':auth');
};
