<?php

namespace Tests\Unit\Services\OCR;

use App\Services\OCR\Drivers\Aws\AwsOCRMock;
use App\Services\OCR\Traits\FileHashedContent;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

/**
 * Class AwsOCRTest
 *
 * @group Unit
 * @group Unit.Services
 * @group Unit.Services.OCR
 * @group Unit.Services.OCR.AwsOCRMock
 */
class AwsOCRMockTest extends TestCase
{
    use WithFaker;
    use FileHashedContent;

    public function test_analyze_expense_returns_null_if_no_hash()
    {
        $response = (new AwsOCRMock())->analyzeExpense('test');

        $this->assertEquals([], $response->data);
    }

    public function test_analyze_expense_uses_content_from_hash()
    {
        Storage::fake('local');
        $responseAssertion = ['mocked content'];

        $this->putContentToHash($this->getHash('test'), json_encode($responseAssertion));

        $response = (new AwsOCRMock())->analyzeExpense('test');

        $this->assertEquals($responseAssertion, $response->data);
    }
}
