<?php

namespace Tests\Unit\Services;

use App\Services\OCR\AwsOCR;
use App\Services\OCR\OCRManager;
use Tests\TestCase;

/**
 * Class OCRTest
 *
 * @group Unit
 * @group Unit.Services
 * @group Unit.Services.OCR
 * @group Unit.Services.OCR.Manager
 */
class OCRTest extends TestCase
{
    public function test_OCR_default_driver()
    {
        $defaultDriver = app(OCRManager::class)->driver();

        $this->assertEquals(AwsOCR::class, $defaultDriver::class);
    }
}
