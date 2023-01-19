<?php

namespace Tests\Unit\Services\OCR;

use App\Facades\OCR;
use App\Services\OCR\Drivers\Aws\AwsOCR;
use App\Services\OCR\Drivers\Aws\AwsOCRMock as AwsOCRMockDriver;
use Aws\Textract\TextractClient;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
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

    /**
     * @covers \App\Services\OCR\Drivers\Aws\AwsOCR::analyzeExpense
     */
    public function test_analyze_expense()
    {
        $mockResponse = ['mock'];

        OCR::swap($this->mockAnalyseExpense($mockResponse));

        $response = OCR::analyzeExpense(
            $this->faker->image()
        );

        $this->assertEquals($mockResponse, $response);
    }

    public function test_get_mock_returns_valid_class()
    {
        $mockAwsOcr = (new AwsOCR())->getMock();

        $this->assertEquals(AwsOCRMockDriver::class, $mockAwsOcr::class);
    }

    public function test_get_client_returns_AWS_instance()
    {
        $awsOcr = (new AwsOCR())->getClient();

        $this->assertEquals(TextractClient::class, $awsOcr::class);
    }

    public function test_get_content_from_hash_is_implemented()
    {
        Storage::fake('local');
        $responseAssertion = ['mocked content'];

        $awsOcr = new AwsOCR();
        $awsOcr->putContentToHash($awsOcr->getHash('test'), json_encode($responseAssertion));

        $response = $awsOcr->analyzeExpense('test');

        $this->assertEquals($responseAssertion, $response);
    }
}
