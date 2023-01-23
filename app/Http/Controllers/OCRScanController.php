<?php

namespace App\Http\Controllers;

use App\DataTransformObjects\ReceiptDto;
use App\Facades\OCR;
use App\Http\Requests\StoreOCRScanRequest;
use App\Http\Resources\OCRScanResource;
use App\Models\OCRScan;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class OCRScanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOCRScanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOCRScanRequest $request)
    {
        $OCRResponse = OCR::analyzeExpense($request->file('file')->get());

        $scan = OCRScan::create([
            'hash' => $OCRResponse->hash,
            'data' => (new ReceiptDto($OCRResponse->data))->fromAWStoArray(),
        ]);

        return response()->json(
            $scan->data
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OCRScan  $OCRScan
     * @return \Illuminate\Http\Response
     */
    public function show(OCRScan $OCRScan)
    {
        return OCRScanResource::make($OCRScan);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OCRScan  $oCRScan
     * @return \Illuminate\Http\Response
     */
    public function destroy(OCRScan $OCRScan)
    {
        return response()->json(null, $OCRScan->delete()
            ? JsonResponse::HTTP_NO_CONTENT
            : JSONResponse::HTTP_INTERNAL_SERVER_ERROR
        );
    }
}
