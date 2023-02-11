<?php

namespace DataTransferObjects;

use App\DataTransferObjects\ReceiptDto;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

/**
 * @group DTO
 * @group DTO.ReceiptDto
 */
class ReceiptDtoTest extends TestCase
{
    // expect my array has the following field : store, list of items, date
    public function test_DTO_returns_proper_values()
    {
        $jsonOCR = Storage::disk('tests')->get('OCR/1.json');
        $arrayOCR = json_decode($jsonOCR, true);

        $numberOfItems = Arr::get($arrayOCR, 'ExpenseDocuments.0.LineItemGroups.0.LineItems');

        $receipt = (new ReceiptDto($arrayOCR))->fromAWStoArray();

        $this->assertArrayHasKey('stores', $receipt);
        $this->assertArrayHasKey('products', $receipt);
        $this->assertCount(count($numberOfItems), $receipt['products']);
    }

    public function test_DTO_with_empty_array_returns_empty_values()
    {
        $receipt = (new ReceiptDto([]))->fromAWStoArray();

        $this->assertArrayHasKey('stores', $receipt);
        $this->assertArrayHasKey('products', $receipt);
        $this->assertCount(0, $receipt['stores']);
        $this->assertCount(0, $receipt['products']);
    }
}
