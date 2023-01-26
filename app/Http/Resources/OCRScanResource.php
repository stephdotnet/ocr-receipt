<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OCRScanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'hash' => $this->hash,
            'OCRData' => $this->data,
            'created_at' => $this->created_at,
        ];
    }
}
