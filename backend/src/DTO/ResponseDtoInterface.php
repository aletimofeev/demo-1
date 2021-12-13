<?php

namespace App\DTO;

interface ResponseDtoInterface
{
    public function getData(): array;
    public function getCode(): int;

}
