<?php

namespace Tests\Traits;

use App\Services\OCR\Drivers\Aws\AwsOCR;
use Aws\Result;
use Aws\Textract\TextractClient;

trait AwsOCRMock
{
    public function mockAnalyseExpense($response)
    {
        $textractClientMock = $this->partialMock(TextractClient::class);
        $textractClientMock
            ->shouldReceive('analyzeExpense')
            ->andReturn(new Result($response));

        $partialOCRMock = $this->partialMock(AwsOCR::class);
        $partialOCRMock
            ->shouldReceive('getClient')
            ->andReturn($textractClientMock);

        return $partialOCRMock;
    }
}
