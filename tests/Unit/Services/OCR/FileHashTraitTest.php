<?php

namespace Tests\Unit\Services\OCR;

use App\Services\OCR\Traits\FileHashedContent;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

/**
 * @group Unit
 * @group Unit.Services
 * @group Unit.Services.OCR
 * @group Unit.Services.OCR.FileHashTrait
 */
class FileHashTraitTest extends TestCase
{
    use WithFaker;
    use FileHashedContent;

    public function test_file_generate_same_hash_twice()
    {
        $firstHash = $this->getHash('test');
        $secondHash = $this->getHash('test');

        Storage::fake('local');

        $this->putContentToHash($firstHash, 'content');

        $this->assertEquals($firstHash, $secondHash);

        Storage::disk('local')->assertExists("services/ocr/$firstHash.json");
    }
}
