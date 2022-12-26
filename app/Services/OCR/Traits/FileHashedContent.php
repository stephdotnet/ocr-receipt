<?php

namespace App\Services\OCR\Traits;

use Illuminate\Support\Facades\Storage;

trait FileHashedContent
{
    public function putContentToHash(string $hash, $content): string
    {
        return Storage::put($this->getFileHashPath($hash), $content);
    }

    public function getContentFromHash(string $fileContent): ?string
    {
        return Storage::get($this->getFileHashPath($this->getHash($fileContent)));
    }

    private function getHash(string $fileContent): string
    {
        return md5($fileContent);
    }

    private function getFileHashPath(string $fileHash): string
    {
        return "services/ocr/$fileHash.json";
    }
}
