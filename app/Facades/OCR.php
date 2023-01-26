<?php

namespace App\Facades;

use App\Services\OCR\OCRManager;
use App\Services\OCR\OCRResponse;
use Illuminate\Support\Facades\Facade;

/**
 * Class OCR
 *
 * @method static OCRResponse analyzeExpense(string $fileContent)
 */
class OCR extends Facade
{
    protected static function getFacadeAccessor()
    {
        return OCRManager::class;
    }
}
