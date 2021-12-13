<?php

namespace App\DTO;


abstract class ResponseDTO implements ResponseDtoInterface
{
    protected array $data;
    protected int $statusCode;

    public function __construct(array $data, int $statusCode)
    {
        $this->data = $data;
        $this->statusCode = $statusCode;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getCode(): int
    {
        return $this->statusCode;
    }
}
