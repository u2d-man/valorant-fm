<?php

declare(strict_types=1);

namespace App\Application\Handlers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Log\LoggerInterface;

class ImageFilesHandler
{
    public function __construct(
        private LoggerInterface $logger
    ) {
    }

    /**
     * @param Request $request
     * @param Response $response
     *
     * @return Response
     */
    public function getImageFiles(Request $request, Response $response): Response
    {
        $imageFiles = glob('../frontend/public/images/*');
        if (!$imageFiles) {
            $this->logger->error('Could not retrieve the file under the specified directory.');

            $response->getBody()->write('get imageFiles failed.');

            return $response->withHeader('Content-Type', 'plain/text; charset=UTF-8');
        }

        $replacedImageFiles = [];
        foreach ($imageFiles as $imageFile) {
            $replaced = str_replace('../frontend/public/images/', '', $imageFile);
            $replacedImageFiles[] = $replaced;
        }

        $responseBody = json_encode(['message' => 'success', 'data' => $replacedImageFiles]);
        $response->getBody()->write($responseBody);

        return $response->withHeader('Content-Type', 'application/json; cahrset=UTF-8');
    }
}
