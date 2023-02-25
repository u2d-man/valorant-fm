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
        $file = $getFile['files'];
        $extension = pathinfo($file->getClientFilename(), PATHINFO_EXTENSION);
        $basename = bin2hex(random_bytes(8));
        $filename = sprintf('%s.%0.8s', $basename, $extension);

        $file->moveTo($directory . DIRECTORY_SEPARATOR . $filename);

        return $filename;
    }
}
