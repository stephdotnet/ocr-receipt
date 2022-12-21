<?php

namespace App\Services\OCR;

use Illuminate\Support\Manager;

class OCRManager extends Manager
{
    public function getDefaultDriver(): string
    {
        return $this->config->get('services.OCR.default');
    }

    public function createAwsDriver(): AwsOCR
    {
        return new AwsOCR();
    }
}
