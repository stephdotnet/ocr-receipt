<?php

namespace Database\Factories;

use App\DataTransformObjects\ReceiptDto;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OCRScan>
 */
class OCRScanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'hash' => $this->faker->md5(),
            'data' => [],
        ];
    }

    public function withRealData()
    {
        return $this->state(function (array $attributes) {
            $arrayOCR = json_decode(Storage::disk('tests')->get('OCR/1.json'), true);

            return [
                'data' => (new ReceiptDto($arrayOCR))->fromAWStoArray(),
            ];
        });
    }
}
