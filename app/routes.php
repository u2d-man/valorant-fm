<?php

declare(strict_types=1);

use App\Application\Handlers\AuthHandler;
use App\Application\Handlers\RegisterHandler;
use App\Application\Handlers\UserMeHandler;
use App\Application\Handlers\ContentsUploadHandler;
use App\Application\Handlers\ImageFilesHandler;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    // authentication
    $app->post('/api/register', RegisterHandler::class . ':postRegister');
    $app->post('/api/auth', AuthHandler::class . ':auth');
    $app->get('/api/user/me', UserMeHandler::class . ':getUserMe');

    // content
    $app->post('/api/image_upload', ContentsUploadHandler::class . ':upload');
    $app->get('/api/image_files', ImageFilesHandler::class . ':getImageFiles');
};
