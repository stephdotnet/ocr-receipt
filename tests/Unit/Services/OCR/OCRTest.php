<?php

namespace Tests\Unit\Services\OCR;

use App\Facades\OCR;
use App\Services\OCR\Drivers\Aws\AwsOCR;
use App\Services\OCR\Drivers\Aws\AwsOCRMock;
use App\Services\OCR\OCRManager;
use App\Services\OCR\OCRResponse;
use Illuminate\Support\Facades\Config;
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

    public function test_mock_class_not_called_if_ocr_configuration_is_not_mocked()
    {
        Config::set('services.OCR.mocked', false);
        $expectedResponse = [true];

        $awsOcrMock = $this->partialMock(AwsOCRMock::class);
        $awsOcrMock
            ->shouldNotReceive('analyzeExpense');

        $awsOcr = $this->partialMock(AwsOCR::class);
        $awsOcr->shouldReceive('getMock')
            ->andReturn($awsOcrMock);
        $awsOcr->shouldReceive('analyzeExpense')
            ->andReturn(new OCRResponse($expectedResponse, 'hash'));

        OCR::partialMock()
            ->shouldReceive('driver')
            ->andReturn($awsOcr);

        $response = OCR::analyzeExpense('test');
        $this->assertEquals($expectedResponse, $response->data);
    }

    public function test_mock_class_called_if_ocr_configuration_is_mocked()
    {
        Config::set('services.OCR.mocked', true);
        $expectedResponse = [true];

        $awsOcrMock = $this->partialMock(AwsOCRMock::class);
        $awsOcrMock
            ->shouldReceive('analyzeExpense')
            ->andReturn(new OCRResponse($expectedResponse, 'hash'));

        $awsOcr = $this->partialMock(AwsOCR::class);
        $awsOcr->shouldReceive('getMock')
            ->andReturn($awsOcrMock);
        $awsOcr->shouldNotReceive('analyzeExpense');

        OCR::partialMock()
            ->shouldReceive('driver')
            ->andReturn($awsOcr);

        $response = OCR::analyzeExpense('test');
        $this->assertEquals($expectedResponse, $response->data);
    }
}
