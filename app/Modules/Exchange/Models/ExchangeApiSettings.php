<?php

namespace App\Modules\Exchange\Models;

/**
 * Exchange Api Model
 */
class ExchangeApiSettings
{
    /**
     * Constructor for ExchangeApiSettings
     *
     * @param string $baseUrl   base URl
     * @param string $appId     app Id
     * @param array  $endpoints array of endpoints
     */
    public function __construct(
        private string $baseUrl,
        private string $appId,
        private array $endpoints
    ) {
        $this->validate();
    }

    /**
     * InitData Validator
     *
     * @return void
     */
    private function validate(): void
    {
        if (!filter_var($this->baseUrl, FILTER_VALIDATE_URL)) {
            throw new \InvalidArgumentException('Invalid base URL');
        }

        if (empty($this->appId)) {
            throw new \InvalidArgumentException('App ID cannot be empty');
        }
    }

    /**
     * Base URL getter
     *
     * @return string base URL
     */
    public function getBaseUrl(): string
    {
        return rtrim($this->baseUrl, '/');
    }

    /**
     * App Id getter
     *
     * @return string app id
     */
    public function getAppId(): string
    {
        return $this->appId;
    }

    /**
     * Returns endpoint path by key without base URL
     *
     * @param string $key key of endpoints array
     *
     * @throws InvalidArgumentException
     *
     * @return string endpoint
     */
    public function getEndpoint(string $key): string
    {
        if (!array_key_exists($key, $this->endpoints)) {
            throw new \InvalidArgumentException(
                sprintf('Unknown endpoint key: %s. Available keys: %s', $key, implode(', ', array_keys($this->endpoints)))
            );
        }

        return $this->endpoints[$key];
    }

    /**
     * Getting full URL by endpoint key
     *
     * @param string $key key of endpoints array
     *
     * @return string full path
     */
    public function getFullEndpoint(string $key): string
    {
        return $this->getBaseUrl() . "app_id" . $this->getAppId() . ($this->endpoints[$key] ?? throw new \InvalidArgumentException("Unknown endpoint: {$key}"));
    }
}
