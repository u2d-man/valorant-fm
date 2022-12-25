<?php

require 'vendor/autoload.php';

use DI\Container;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Psr7\UploadedFile;
use Slim\Views\Twig;
use Twig\Loader\FilesystemLoader;

$container = new Container();
AppFactory::setContainer($container);
$app = AppFactory::create();
$app->addRoutingMiddleware();

$client = new Client();

const SAVE_IMAGE_PATH = __DIR__ . '/public/images/';
const DISPLAY_IMAGE_PATH = '/public/images/';

$container->set('twig', function() {
    $loader = new FilesystemLoader("./Views");

    return new Twig($loader, ['debug' => true]);
});

$app->get('/', function (Request $request, Response $response, array $args) {
    $assign['first'] = 'Elton';
    $assign['last'] = 'Davy';
    $view = $this->get('twig');

    return $view->render($response, 'index.twig', $assign);
});

$app->post('/upload_file', function (Request $request, Response $response) {
    $getFile = $request->getUploadedFiles();
    $assign['file_path'] = DISPLAY_IMAGE_PATH . moveUploadedFile(SAVE_IMAGE_PATH, $getFile['test_file']);
    $view = $this->get('twig');

    return $view->render($response, 'index.twig', $assign);
});

$app->get('/hello', function (Request $request, Response $response) {
    $response->getBody()->write("Hello URL");

    return $response;
});

$app->get('/riot-me', function (Request $request, Response $response) use ($client) {
    $apiResponse = sampleAPIRequest($client);
    $puuid = '';
    if (is_array($apiResponse)) {
        $puuid = $apiResponse['puuid'];
    }

    $response->getBody()->write("valorant puuid: $puuid");

    return $response;
});

$app->run();

function sampleAPIRequest(Client $client)
{
    $options['headers'] = ['X-Riot-Token' => ''];
    $response = $client->request('GET', 'https://asia.api.riotgames.com/riot/account/v1/accounts/by-riot-id/DavyElton/8585', $options);

    return json_decode($response->getBody()->getContents(), true);
}

function moveUploadedFile($directory, UploadedFile $uploadedFile)
{
    $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
    // $basename = bin2hex(random_bytes(8)); // see http://php.net/manual/en/function.random-bytes.php
    $filename = 'valorant-fm.' . $extension;

    $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);

    return $filename;
}
