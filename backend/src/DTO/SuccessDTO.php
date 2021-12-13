<?php


namespace App\DTO;

use Symfony\Component\HttpFoundation\Response;

class SuccessDTO extends ResponseDTO
{
    /**
     * @param int $statusCode
     * @param array|null $data
     */
    public function __construct(int $statusCode = Response::HTTP_OK)
    {
        parent::__construct(['success' => true], $statusCode);
    }
}
