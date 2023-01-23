<?php

namespace App\Http\Requests;

use App\Services\OCR\Traits\FileHashedContent;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOCRScanRequest extends FormRequest
{
    use FileHashedContent;

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'hash' => $this->getHash($this->file('file')->get()),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'file' => [
                'required',
                'file',
            ],
            'hash' => [
                Rule::unique('ocr_scans', 'hash'),
            ],
        ];
    }
}
