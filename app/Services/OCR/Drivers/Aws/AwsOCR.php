<?php

namespace App\Services\OCR\Drivers\Aws;

use App\Services\OCR\OCRDriverInterface;
use App\Services\OCR\Traits\FileHashedContent;
use Aws\Credentials\Credentials;
use Aws\Textract\TextractClient;

class AwsOCR implements OCRDriverInterface
{
    use FileHashedContent;

    public function analyzeExpense(string $fileContent): array
    {
        if ($response = $this->getContentFromHash($fileContent)) {
            return json_decode($response, true);
        }

        $response = $this->getClient()->analyzeExpense([
            'Document' => [
                'Bytes' => $fileContent,
            ],
            'FeatureTypes' => ['TABLES', 'FORMS'],
        ]);

        $this->putContentToHash(
            $this->getHash($fileContent),
            json_encode($response->toArray())
        );

        return $response->toArray();
    }

    public function getClient(): TextractClient
    {
        $credentials = new Credentials(
            config('services.OCR.aws.key'),
            config('services.OCR.aws.secret')
        );

        return new TextractClient([
            'version' => 'latest',
            'region' => 'eu-west-3',
            'credentials' => $credentials,
        ]);
    }

    public function getMock()
    {
        return new AwsOCRMock();
    }
}
