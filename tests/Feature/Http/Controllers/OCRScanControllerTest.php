<?php

namespace Tests\Feature\Http\Controllers;

use App\Facades\OCR;
use App\Models\OCRScan;
use App\Services\OCR\Traits\FileHashedContent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Tests\TestCase;
use Tests\Traits\AwsOCRMock;

/**
 * @group Http
 * @group Http.Controllers
 * @group Http.Controllers.OCRScan
 */
class OCRScanController extends TestCase
{
    use RefreshDatabase,
        AwsOCRMock,
        FileHashedContent;

    public function test_it_can_store_a_new_ocr_scan()
    {
        $fakeImage = UploadedFile::fake()->image('receipt.jpg');
        $this
            ->postFakeData(['file' => $fakeImage])
            ->assertOk();

        $this->assertDatabaseHas('ocr_scans', [
            'hash' => $this->getHash($fakeImage->get()),
        ]);
    }

    public function test_it_cant_store_an_ocr_scan_if_hash_exists()
    {
        $fakeImage = UploadedFile::fake()->image('receipt.jpg');
        $this->postFakeData(['file' => $fakeImage])
             ->assertOk();

        $this->assertDatabaseCount('ocr_scans', 1);

        $this->postFakeData(['file' => $fakeImage])
            ->assertStatus(422)
            ->assertJsonValidationErrors('hash');
    }

    public function test_it_can_show_an_ocr_scan()
    {
        $OCRScan = OCRScan::factory()->create();

        $this->getJson("/api/ocr-scans/$OCRScan->id")
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'hash',
                    'OCRData',
                    'created_at',
                ],
            ]);
    }

    public function test_it_can_delete_an_ocr_scan()
    {
        $OCRScan = OCRScan::factory()->create();

        $this->deleteJson("/api/ocr-scans/$OCRScan->id")
            ->assertStatus(JsonResponse::HTTP_NO_CONTENT);

        $this->assertDatabaseMissing('ocr_scans', [
            'id' => $OCRScan->id,
        ]);
    }

    // public function test_it_can_list_all_ocr_scans()

    protected function postFakeData($options = []): \Illuminate\Testing\TestResponse
    {
        $fakeImage = Arr::get($options, 'file', UploadedFile::fake()->image('receipt.jpg'));

        OCR::swap($this->mockAnalyseExpense(Arr::get($options, 'response', ['response' => 'is mocked'])));

        return $this->postJson('/api/ocr-scans', [
            'file' => $fakeImage,
        ]);
    }
}
