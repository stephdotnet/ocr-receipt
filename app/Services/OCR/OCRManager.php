<?php

namespace App\Services\OCR;

use App\Services\OCR\Drivers\Aws\AwsOCR;
use Illuminate\Support\Manager;

class OCRManager extends Manager
{
    public function getDefaultDriver(): string
    {
        return $this->config->get('services.OCR.default');
    }

    public function createAwsDriver(): AwsOCR
    {
        return new AwsOCR();
    }

    /**
     * Dynamically call the default driver instance.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        if (config('services.OCR.mocked')
            && method_exists($this->driver()->getMock(), $method)
        ) {
            return $this->driver()->getMock()->$method(...$parameters);
        }

        return $this->driver()->$method(...$parameters);
    }
}
