<?php

namespace App\Modules\Exchange\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="ExchangeLatestResource",
 *     type="object",
 *     required={"timestamp", "base", "rates"},
 *     @OA\Property(
 *         property="timestamp",
 *         type="integer",
 *         format="int64",
 *         description="Timestamp of the exchange rates",
 *         example=1633072800
 *     ),
 *     @OA\Property(
 *         property="base",
 *         type="string",
 *         description="Base currency for the exchange rates",
 *         example="USD"
 *     ),
 *     @OA\Property(
 *         property="rates",
 *         type="object",
 *         additionalProperties={
 *             @OA\Schema(
 *                 type="number",
 *                 format="float",
 *                 description="Exchange rate for the currency"
 *             )
 *         },
 *         description="Exchange rates for the base currency"
 *     )
 * )
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
