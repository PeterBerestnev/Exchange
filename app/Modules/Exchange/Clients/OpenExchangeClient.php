<?php

namespace App\Modules\Exchange\Clients;

use App\Modules\Exchange\Clients\Contracts\BaseExchangeClient;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use App\Modules\Exchange\Exceptions\ApiClientException;
use App\Modules\Exchange\Models\ExchangeApiSettings;

/**
 * Openexchanerates client
 */
class OpenExchangeClient implements BaseExchangeClient
{
    private PendingRequest $client;
    private ExchangeApiSettings $settings;

    /**
     * Setting up connection params and prepearing client with static data
     *
     * @param ExchangeApiSettings $settings array of api settings
     */
    public function __construct(?ExchangeApiSettings $settings = null)
    {
        $this->settings = $settings;

        $this->initializeClient();
    }
    /**
     * Setting-up client params
     *
     * @return void
     */
    private function initializeClient(): void
    {
        $this->client = Http::baseUrl($this->settings->getBaseUrl())
            ->timeout(15)
            ->retry(3, 100)
            ->withQueryParameters(
                [
                    'app_id' => $this->settings->getAppId()
                ]
            );
    }

    /**
     * Get latest exchange rates
     *
     * @param array $params array of params (optional)
     *
     * @return array response
     */
    public function getLatestRates(array $params = []): array
    {
        $endpoint = $this->settings->getEndpoint('latest');

        try {
            // Если есть дополнительные параметры, добавьте их к запросу
            $response = $this->client->get($endpoint, $params);

            if ($response->failed()) {
                throw ApiClientException::fromResponse(
                    $response,
                    [
                        'url' => $endpoint,
                        'method' => 'GET',
                        'params' => ['app_id' => $this->settings->getAppId()] + $params // Объединяем параметры
                    ]
                );
            }

            return $response->json();
        } catch (\Exception $e) {
            throw new ApiClientException(
                "API request to {$endpoint} failed: " . $e->getMessage(),
                $e->getCode(),
                [
                    'url' => $endpoint,
                    'method' => 'GET'
                ],
                $e
            );
        }
    }
}
