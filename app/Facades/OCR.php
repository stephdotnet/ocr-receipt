<?php

namespace App\Facades;

use App\Services\OCR\OCRManager;
use Illuminate\Support\Facades\Facade;

/**
 * Class OCR
 *
 * @method static array analyzeExpense(string $fileContent)
 */
class OCR extends Facade
{
    protected static function getFacadeAccessor()
    {
        return OCRManager::class;
    }
}
