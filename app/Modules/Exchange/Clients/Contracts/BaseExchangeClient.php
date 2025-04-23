<?php

namespace App\Modules\Exchange\Clients\Contracts;

/**
 * Base client to provide dependency inversion for services
**/
interface BaseExchangeClient
{
    /**
     * Gettting latest rates
     *
     * @param array $params array of params
     *
     * @return array json response
     */
    public function getLatestRates(array $params = []): array;
}
