<?php

namespace App\Modules\Exchange\Services;

use App\Modules\Exchange\Clients\Contracts\BaseExchangeClient;
use App\Modules\Exchange\Clients\OpenExchangeClient;
use App\Modules\Exchange\Dto\ExchangeRequestDTO;
use App\Modules\Exchange\Dto\ExchangeResponseDTO;
use App\Modules\Exchange\Models\ExchangeApiSettings;

/**
 * Exchange service contains methods for exchange api manipulation
 */
class ExchangeService
{
    private BaseExchangeClient $client;

    /**
     * Constructor for ExchangeService
     *
     * @param BaseExchangeClient $client api client
     */
    public function __construct(
        $client = null
    ) {
        $this->client = $client ?? $this->createDefaultClient();
    }

    /**
     * Setting default params and setting-up client
     *
     * @return OpenExchangeClient client
     */
    private function createDefaultClient(): BaseExchangeClient
    {
        $params = include_once __DIR__ . '/../Configs/exchange.php';

        $settings = new ExchangeApiSettings(
            $params['base_url'],
            $params['app_id'],
            $params['endpoints']
        );

        return new OpenExchangeClient($settings);
    }

    /**
     * Getting client data by "latest" endpoint
     *
     * @return ExchangeDTO response data
     */
    public function getLatestRates(ExchangeRequestDTO $requestDTO): ExchangeResponseDTO
    {
        $data = $this->client->getLatestRates(
            [
                'base' => $requestDTO->base,
                'symbols' => $requestDTO->symbols,
                'prettyprint' => $requestDTO->prettyprint,
                'show_alternative' => $requestDTO->showAlternative,
            ]
        );

        return new ExchangeResponseDTO(
            $data['disclaimer'],
            $data['license'],
            $data['timestamp'],
            $data['base'],
            $data['rates']
        );
    }
}
