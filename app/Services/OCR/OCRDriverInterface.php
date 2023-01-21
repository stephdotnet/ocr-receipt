<?php

namespace App\Services\OCR;

interface OCRDriverInterface
{
    public function analyzeExpense(string $fileContent): OCRResponse;
}
