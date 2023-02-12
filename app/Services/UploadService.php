<?php

namespace ValorantFM\Services;

use Slim\Psr7\UploadedFile;

class UploadService
{
    /**
     * @param string $directory
     * @param UploadedFile $uploadedFile
     * @return string
     */
    public function moveUploadedFile(string $directory, UploadedFile $uploadedFile): string
    {
        $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
        $filename = 'valorant-fm.' . $extension;

        $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);

        return $filename;
    }
}
