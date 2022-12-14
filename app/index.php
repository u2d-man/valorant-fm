<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

$app = AppFactory::create();
$app->addRoutingMiddleware();

$client = new Client();

$app->get('/', function (Request $request, Response $response, array $args) {
    $response->getBody()->write("Hello, world");

    return $response;
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
    $options['headers'] = ['X-Riot-Token' => 'RGAPI-f8f50b15-a89f-4523-8edc-c83a31aa2a31'];
    $response = $client->request('GET', 'https://asia.api.riotgames.com/riot/account/v1/accounts/by-riot-id/DavyElton/8585', $options);

    return json_decode($response->getBody()->getContents(), true);
}
