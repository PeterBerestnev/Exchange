<?php

namespace App\Modules\Exchange\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Exchange\Dto\ExchangeRequestDTO;
use App\Modules\Exchange\Resources\ExchangeLatestResource;
use App\Modules\Exchange\Requests\ExchangeRequest;
use App\Modules\Exchange\Services\ExchangeService;

/**
 * Contains methods to interact with OpenExchangeApi
 */
class ExchangeController extends Controller
{
    protected $exchangeService;

    /**
     * Constructor for ExchangeController
     *
     * @param ExchangeService         $exchangeService Service for ExchangeController
     */
    public function __construct(ExchangeService $exchangeService)
    {
        $this->exchangeService = $exchangeService;
    }

    /**
     * @OA\Get(
     *     path="/api/exchange/latest",
     *     tags={"Exchange"},
     *     summary="Get the latest exchange rates",
     *     description="Returns the latest exchange rates for the specified base currency.",
     *     @OA\Parameter(
     *         name="base",
     *         in="query",
     *         required=false,
     *         @OA\Schema(ref="#/components/schemas/ExchangeLatestRequest/properties/base")
     *     ),
     *     @OA\Parameter(
     *         name="symbols",
     *         in="query",
     *         required=false,
     *         @OA\Schema(ref="#/components/schemas/ExchangeLatestRequest/properties/symbols")
     *     ),
     *     @OA\Parameter(
     *         name="prettyprint",
     *         in="query",
     *         required=false,
     *         @OA\Schema(ref="#/components/schemas/ExchangeLatestRequest/properties/prettyprint")
     *     ),
     *     @OA\Parameter(
     *         name="show_alternative",
     *         in="query",
     *         required=false,
     *         @OA\Schema(ref="#/components/schemas/ExchangeLatestRequest/properties/show_alternative")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(ref="#/components/schemas/ExchangeLatestResource")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     )
     * )
     */
    public function latest(ExchangeRequest $request)
    {
        $data = $request->validated();

        $rates = $this->exchangeService->getLatestRates(
            new ExchangeRequestDTO(
                $data['base'] ?? null,
                $data['symbols'] ?? null,
                $data['prettyprint'] ?? null,
                $data['show_alternative'] ?? null
            )
        );
        return new ExchangeLatestResource($rates);
    }
}
