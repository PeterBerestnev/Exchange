<?php

namespace App\Modules\Exchange\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Sett output exchange data
 */
class ExchangeLatestResource extends JsonResource
{
    /**
     * Set rules for returning exchange data
     *
     * @param $request dirty exchange data
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            "timestamp" => $this->timestamp,
            "base" => $this->base,
            "rates" => $this->rates ?? null
        ];
    }
}
