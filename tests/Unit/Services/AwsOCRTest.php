<?php

namespace Tests\Unit\Services;

use App\Facades\OCR;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\AwsOCRMock;

/**
 * Class AwsOCRTest
 *
 * @group Unit
 * @group Unit.Services
 * @group Unit.Services.OCR
 * @group Unit.Services.OCR.AwsOCR
 */
class AwsOCRTest extends TestCase
{
    use WithFaker;
    use AwsOCRMock;

    public function test_analyze_expense()
    {
        $mockResponse = ['mock'];

        OCR::swap($this->mockAnalyseExpense($mockResponse));

        $response = OCR::analyzeExpense(
            $this->faker->image()
        );

        $this->assertEquals($mockResponse, $response);
    }
}
