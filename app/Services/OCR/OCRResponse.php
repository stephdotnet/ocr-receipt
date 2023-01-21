<?php

namespace App\Services\OCR;

class OCRResponse
{
    public function __construct(public array $data, public string $hash)
    {
    }
}
