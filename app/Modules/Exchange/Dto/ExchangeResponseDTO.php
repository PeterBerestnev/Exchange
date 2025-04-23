<?php

namespace App\Modules\Exchange\Dto;

class ExchangeResponseDTO
{
    public ?string $disclaimer;
    public ?string $license;
    public ?int $timestamp;
    public ?string $base;
    public array $rates;

    public function __construct(string|null $disclaimer, string|null $license, int|null $timestamp, string|null $base, array|null $rates)
    {
        $this->disclaimer = $disclaimer;
        $this->license = $license;
        $this->timestamp = $timestamp;
        $this->base = $base;
        $this->rates = $rates ?? [];
    }
}
