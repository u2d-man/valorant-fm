<?php

namespace ValorantFM\Services;

use Psr\Http\Message\ServerRequestInterface as Request;

class UploadService
{
    /**
     * @param string $directory
     * @param Request $request
     * @return string
     */
    public function moveUploadedFile(string $directory, Request $request): string
    {
        $getFile = $request->getUploadedFiles();
        $file = $getFile['test_file'];
        $extension = pathinfo($file->getClientFilename(), PATHINFO_EXTENSION);
        $filename = 'valorant-fm.' . $extension;

        $file->moveTo($directory . DIRECTORY_SEPARATOR . $filename);

        return $filename;
    }
}
