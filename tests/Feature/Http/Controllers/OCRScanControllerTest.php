<?php

namespace Tests\Feature\Http\Controllers;

use App\Facades\OCR;
use App\Models\OCRScan;
use App\Services\OCR\Traits\FileHashedContent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
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
        $this->withoutExceptionHandling();

        $fakeImage = UploadedFile::fake()->image('receipt.jpg');

        OCR::swap($this->mockAnalyseExpense(['response' => 'is mocked']));

        $this->postJson('/api/ocr-scans', [
            'file' => $fakeImage,
        ]);

        $scans = OCRScan::all();

        $this->assertDatabaseHas('ocr_scans', [
            'hash' => $this->getHash($fakeImage->get()),
        ]);
    }

    // public function test_it_cant_store_an_ocr_scan_if_hash_exists()

    // public function test_it_can_show_an_ocr_scan()

    // public function test_it_can_delete_an_ocr_scan()

    // public function test_it_can_list_all_ocr_scans()
}
