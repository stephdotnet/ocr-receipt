<?php

namespace App\Http\Controllers;

use App\DataTransferObjects\ReceiptDto;
use App\Facades\OCR;
use App\Http\Requests\StoreOCRScanRequest;
use App\Http\Resources\OCRScanResource;
use App\Models\OCRScan;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;

class OCRScanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $queryBuilder = QueryBuilder::for(OCRScan::class)
            ->allowedFilters(['hash'])
            ->allowedSorts(['created_at']);

        return OCRScanResource::collection($queryBuilder->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOCRScanRequest $request): OCRScanResource
    {
        $OCRResponse = OCR::analyzeExpense($request->file('file')->get());

        $OCRScan = OCRScan::create([
            'hash' => $OCRResponse->hash,
            'data' => (new ReceiptDto($OCRResponse->data))->fromAWStoArray(),
        ]);

        return OCRScanResource::make($OCRScan);
    }

    /**
     * Display the specified resource.
     */
    public function show(OCRScan $OCRScan): OCRScanResource
    {
        return OCRScanResource::make($OCRScan);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OCRScan $OCRScan): JsonResponse
    {
        return response()->json(null, $OCRScan->delete()
            ? JsonResponse::HTTP_NO_CONTENT
            : JSONResponse::HTTP_INTERNAL_SERVER_ERROR
        );
    }
}
