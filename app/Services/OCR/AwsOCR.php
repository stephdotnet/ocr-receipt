<?php

namespace App\Services\OCR;

use Aws\Credentials\Credentials;
use Aws\Textract\TextractClient;

class AwsOCR
{
    public function analyzeExpense(string $fileContent): array
    {
        $response = $this->getClient()->analyzeExpense([
            'Document' => [
                'Bytes' => $fileContent,
            ],
            'FeatureTypes' => ['TABLES', 'FORMS'],
        ]);

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
}
