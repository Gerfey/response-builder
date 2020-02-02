<?php

namespace Gerfey\ResponseBuilder\Contracts;

use Illuminate\Http\JsonResponse;

interface ResponseBuilderInterface
{
    public static function setSuccess(int $http_code = 200);

    public static function setError(int $http_code);

    public function setHttpCode(int $http_code = 200);

    public function setMessage(string $message = '');

    public function setData(array $data = []);

    public function build(): JsonResponse;
}
