<?php

declare(strict_types=1);

namespace App\Libs;

use JsonException;
use RuntimeException;

class JsonEncoder
{
    /**
     * Convert array to json format.
     *
     * @param array $data
     * 
     * @return string
     * @throws RuntimeException
     */
    public function encode(array $data): string
    {
        try {
            return json_encode($data, JSON_THROW_ON_ERROR | JSON_FORCE_OBJECT);
        } catch (JsonException $e) {
            throw new RuntimeException('failed to encode data: '
                . print_r($data, true)
                . $e->getMessage()
                . $e->getTraceAsString());
        }
    }
}
