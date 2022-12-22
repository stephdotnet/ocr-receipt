<?php

namespace App\DataTransformObjects;

use Illuminate\Support\Arr;

class ReceiptDto
{
    public function __construct(protected array $data)
    {
    }

    public function fromAWStoArray(): array
    {
        $expenseDocument = Arr::get($this->data, 'ExpenseDocuments.0.SummaryFields', []);
        $productsLineItems = Arr::get($this->data, 'ExpenseDocuments.0.LineItemGroups.0.LineItems', []);

        return [
            'stores' => $this->getStores($expenseDocument),
            'products' => $this->getProducts($productsLineItems),
        ];
    }

    protected function getStores(array $expenseDocument): array
    {
        return collect($expenseDocument)
            ->filter(function ($value) {
                return Arr::get($value, 'Type.Text', null) === 'VENDOR_NAME';
            })
            ->map(function ($value) {
                return Arr::get($value, 'ValueDetection.Text');
            })
            ->values()
            ->toArray();
    }

    private function getProducts(array $productsLineItems): array
    {
        return collect($productsLineItems)
            ->map(function ($productLine) {
                return [
                    'name' => Arr::get(
                        $this->getKeyFromTypeTextValue($productLine['LineItemExpenseFields'], 'ITEM'),
                        'ValueDetection.Text'
                    ),
                    'price' => Arr::get(
                        $this->getKeyFromTypeTextValue($productLine['LineItemExpenseFields'], 'PRICE'),
                        'ValueDetection.Text'
                    ),
                ];
            })
            ->toArray();
    }

    private function getKeyFromTypeTextValue(array $array, string $value): mixed
    {
        return collect($array)
            ->firstWhere(function ($item) use ($value) {
                return Arr::get($item, 'Type.Text') === $value;
            });
    }
}
