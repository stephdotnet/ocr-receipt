<?php

namespace App\Services\OCR\Drivers\Aws;

use App\Services\OCR\OCRDriverInterface;
use App\Services\OCR\OCRResponse;
use App\Services\OCR\Traits\FileHashedContent;

class AwsOCRMock implements OCRDriverInterface
{
    use FileHashedContent;

    public function analyzeExpense(string $fileContent): OCRResponse
    {
        if ($response = $this->getContentFromHash($fileContent)) {
            $data = json_decode($response, true);
        }

        return new OCRResponse($data ?? [], $this->getHash($fileContent));
    }
}
