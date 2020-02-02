<?php

namespace Gerfey\ResponseBuilder;

use Illuminate\Http\JsonResponse;

class ResponseBuilder extends ResponseBaseBuilder
{
    public static function success(array $data = [], string $message = '', int $http_code = 200): JsonResponse
    {
        return ResponseBuilder::setSuccess($http_code)
            ->setData($data)
            ->setMessage($message)
            ->build();
    }

    public static function error(string $message, int $http_code = 404, array $data = []): JsonResponse
    {
        return ResponseBuilder::setError($http_code)
            ->setData($data)
            ->setMessage($message)
            ->build();
    }
}
