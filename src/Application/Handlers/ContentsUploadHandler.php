<?php

declare(strict_types=1);

namespace App\Application\Handlers;

use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Log\LoggerInterface;

class ContentsUploadHandler
{
    const IMAGEFILE_SAVE_DIR = '../frontend/public/images/';

    public function __construct(
        //private LoggerInterface $logger
    ) {
    }

    /**
     * @param Request $request
     * @param Response $response
     *
     * @return Response
     */
    public function upload(Request $request, Response $response): Response
    {
        $uploadedFiles = $request->getUploadedFiles();
        if (isset($uploadedFiles['image'])) {
            $imageFile = $uploadedFiles['image'];

            if ($imageFile->getError() !== UPLOAD_ERR_OK) {
                $response->getBody()->write('Non-acceptable formats');

                return $response->withStatus(StatusCodeInterface::STATUS_BAD_REQUEST)
                    ->withHeader('Content-Type', 'text/plain; charset=UTF-8');
            }
            // $image = $imageFile->getStream()->getContents();
            $extension = pathinfo($imageFile->getClientFilename(), PATHINFO_EXTENSION);
            $filename = $this->createUniqueFilename($extension);

            $imageFile->moveTo(self::IMAGEFILE_SAVE_DIR . DIRECTORY_SEPARATOR . $filename);
        }

        $responseBody = json_encode(['message' => 'upload success']);
        $response->getBody()->write($responseBody);

        return $response->withHeader('Content-Type', 'application/json; cahrset=UTF-8');
    }

    /**
     * @param string $extension
     *
     * @return string
     */
    private function createUniqueFilename(string $extension): string
    {
        $basename = bin2hex(random_bytes(8));

        return sprintf('%s.%0.8s', $basename, $extension);
    }
}
