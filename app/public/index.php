<?php

require '../vendor/autoload.php';

use DI\Container;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Twig\Loader\FilesystemLoader;
use ValorantFM\Controllers\HomeController;
use ValorantFM\Controllers\UploadController;
use ValorantFM\Services\UploadService;

$container = new Container();
AppFactory::setContainer($container);
$app = AppFactory::create();
$app->addRoutingMiddleware();

// create container
$container->set('twig', function() {
    $loader = new FilesystemLoader("../views");

    return new Twig($loader, ['debug' => true]);
});

// service container
$container->set('uploaderService', function() {
    return new UploadService();
});

$app->get('/', HomeController::class . ':index');
$app->post('/upload_file', UploadController::class . ':upload');

$app->run();
