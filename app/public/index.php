<?php

require '../vendor/autoload.php';

use DI\Container;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Twig\Loader\FilesystemLoader;
use ValorantFM\Controllers\HomeController;
use ValorantFM\Controllers\UploaderController;
use ValorantFM\Services\UploaderService;

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
    return new UploaderService();
});

$app->get('/', HomeController::class . ':index');
$app->post('/upload_file', UploaderController::class . ':upload');

$app->run();
