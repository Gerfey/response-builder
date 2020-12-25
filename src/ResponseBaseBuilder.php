<?php

namespace Gerfey\ResponseBuilder;

use Gerfey\ResponseBuilder\Contracts\ResponseBuilderInterface;
use Illuminate\Http\JsonResponse;

class ResponseBaseBuilder implements ResponseBuilderInterface
{
    protected $success = false;

    protected $http_code = null;

    protected $message = null;

    protected $data = [];

    public static function setSuccess(int $http_code = 200): self
    {
        return new self(true, $http_code);
    }

    public static function setError(int $http_code): self
    {
        return new self(false, $http_code);
    }

    public function setHttpCode(int $http_code = 200): self
    {
        $this->http_code = $http_code;
        return $this;
    }

    public function setMessage(string $message = ''): self
    {
        $this->message = $message;
        return $this;
    }

    public function setData(array $data = []): self
    {
        $this->data = $data;
        return $this;
    }

    public function build(): JsonResponse
    {
        $success = $this->success;
        $http_code = $this->http_code;
        $message = $this->message;
        $data = $this->data;

        return $this->make($success, $http_code, $message, $data);
    }

    private function make(bool $success, int $http_code, string $message, $data = []): JsonResponse
    {
        return new JsonResponse($this->buildResponse($success, $http_code, $message, $data), $http_code);
    }

    private function buildResponse(bool $success, int $http_code, string $message, $data = []): array
    {
        $response = [
            'success' => $success,
            'code' => $http_code,
            'message' => $message,
            'data' => $data,
        ];

        return $response;
    }

    private function __construct(bool $success, int $http_code)
    {
        $this->success = $success;
        $this->http_code = $http_code;
    }
}
