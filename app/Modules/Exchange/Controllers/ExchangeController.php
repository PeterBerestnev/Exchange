<?php

namespace App\Modules\Exchange\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Exchange\Dto\ExchangeRequestDTO;
use App\Modules\Exchange\Resources\ExchangeLatestResource;
use App\Modules\Exchange\Requests\ExchangeRequest;
use App\Modules\Exchange\Services\ExchangeService;

class ExchangeController extends Controller
{
    protected $exchangeService;

    /**
     * Constructor for ExchangeController
     *
     * @param ExchangeService         $exchangeService Service for ExchangeController
     * @param BaseExchangeClient|null $client          Optional client for the exchange service
     */
    public function __construct(ExchangeService $exchangeService)
    {
        $this->exchangeService = $exchangeService;
    }

    /**
     * Talks to exchange api by "latest" endpoint
     *
     * @param ExchangeRequest $request contains request params
     *
     * @return JsonResponse response resource
     **/
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
