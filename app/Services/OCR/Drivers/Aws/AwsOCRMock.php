<?php

namespace App\Services\OCR\Drivers\Aws;

use App\Services\OCR\OCRDriverInterface;
use App\Services\OCR\Traits\FileHashedContent;

class AwsOCRMock implements OCRDriverInterface
{
    use FileHashedContent;

    public function analyzeExpense(string $fileContent): array
    {
        if ($response = $this->getContentFromHash($fileContent)) {
            return json_decode($response, true);
        }

        return [];
    }
}
