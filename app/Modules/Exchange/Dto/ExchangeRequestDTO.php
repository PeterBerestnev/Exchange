<?php

namespace App\Modules\Exchange\Dto;

class ExchangeRequestDTO
{
    public ?string $base;
    public ?string $symbols;
    public ?string $prettyprint;
    public ?string $showAlternative;

    public function __construct(string|null $base, string|null $symbols, string|null $prettyprint, string|null $showAlternative)
    {
        $this->base = $base;
        $this->symbols = $symbols;
        $this->prettyprint = $prettyprint;
        $this->showAlternative = $showAlternative;
    }
}
