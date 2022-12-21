<?php

namespace Tests\Traits;

use App\Services\OCR\AwsOCR;
use Aws\Result;
use Aws\Textract\TextractClient;
use Mockery;

trait AwsOCRMock
{
    public function mockAnalyseExpense($response)
    {
        $textractClientMock = Mockery::mock(TextractClient::class)->makePartial();
        $textractClientMock
            ->shouldReceive('analyzeExpense')
            ->andReturn(new Result($response));

        $partialOCRMock = Mockery::mock(AwsOCR::class)->makePartial();
        $partialOCRMock
            ->shouldReceive('getClient')
            ->andReturn($textractClientMock);

        return $partialOCRMock;
    }
}
