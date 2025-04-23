<?php

namespace App\Modules\Exchange\Exceptions;

use Throwable;
use Illuminate\Http\Client\Response;

/**
 * Custom exception for API client errors
 */
class ApiClientException extends \RuntimeException
{
    private ?string $requestUrl;
    private ?string $requestMethod;
    private ?array $requestParams;
    private ?array $responseData;

    /**
     * Exception for API client errors with HTTP context
     *
     * @param string         $message    The error message
     * @param int|null       $httpStatus HTTP status code from API response (optional)
     * @param array          $context    Additional error context (optional)
     * @param Throwable|null $previous   Previous exception for chaining (optional)
     */
    public function __construct(
        string $message,
        private ?int $httpStatus = null,
        array $context = [],
        ?Throwable $previous = null
    ) {
        $this->requestUrl = $context['url'] ?? null;
        $this->requestMethod = $context['method'] ?? null;
        $this->requestParams = $context['params'] ?? null;
        $this->responseData = $context['response'] ?? null;

        parent::__construct($message, 0, $previous);
    }

    /**
     * Creates ApiClientException from HTTP response with additional context
     *
     * @param Response $response HTTP response object containing error details
     * @param array    $context  Additional context about the failed request (optional)
     *
     * @return self Configured exception instance with response data
     */
    public static function fromResponse(Response $response, array $context = []): self
    {
        $status = $response->status();
        $message = "API request failed with status: {$status}";

        if ($response->json('message')) {
            $message .= ". Message: " . $response->json('message');
        }

        return new self(
            $message,
            $status,
            array_merge(
                $context,
                [
                    'response' => $response->json()
                ]
            )
        );
    }

    /**
     * Getting status code
     *
     * @return int|null status code
     */
    public function getHttpStatus(): ?int
    {
        return $this->httpStatus;
    }

    /**
     * Getting request URL
     *
     * @return string request URL
     */
    public function getRequestUrl(): ?string
    {
        return $this->requestUrl;
    }

    /**
     * Getting request method
     *
     * @return string request method
     */
    public function getRequestMethod(): ?string
    {
        return $this->requestMethod;
    }

    /**
     * Getting request params
     *
     * @return array request params
     */
    public function getRequestParams(): ?array
    {
        return $this->requestParams;
    }

    /**
     * Getting error response data
     *
     * @return array response data
     */
    public function getResponseData(): ?array
    {
        return $this->responseData;
    }

    /**
     * Getting error response data as array
     *
     * @return array data
     */
    public function toArray(): array
    {
        return [
            'message' => $this->getMessage(),
            'status' => $this->httpStatus,
            'url' => $this->requestUrl,
            'method' => $this->requestMethod,
            'params' => $this->requestParams,
            'response' => $this->responseData,
        ];
    }
}
