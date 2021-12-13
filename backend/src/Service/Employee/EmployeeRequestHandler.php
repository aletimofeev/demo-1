<?php

/*
 * (c) Alexandr Timofeev <tim31al@gmail.com>
 */

namespace App\Service\Employee;

use App\DTO\ErrorDTO;
use App\DTO\ResponseDtoInterface;
use App\DTO\SuccessDTO;
use App\Entity\User;
use App\Message\EmployeeSpreadsheetMessage;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Security\Core\Security;

class EmployeeRequestHandler
{
    private const DATA_FIELD = 'ids';
    private Security $security;
    private MessageBusInterface $bus;

    public function __construct(Security $security, MessageBusInterface $bus)
    {
        $this->security = $security;
        $this->bus = $bus;
    }

    public function handleEmailRequest(Request $request): ResponseDtoInterface
    {
        /** @var User $user */
        $user = $this->security->getUser();

        try {
            $body = $request->toArray();

            if (!$body || !isset($body[self::DATA_FIELD]) || !\is_array($body[self::DATA_FIELD])) {
                throw new BadRequestException();
            }

            $message = new EmployeeSpreadsheetMessage(
                $body[self::DATA_FIELD],
                $user->getEmail(),
                $user->getFirstname()
            );
            $this->bus->dispatch($message);

            return new SuccessDTO();
        } catch (BadRequestException $e) {
            return new ErrorDTO('ids required', Response::HTTP_BAD_REQUEST);
        } catch (\Exception $e) {
            dump($e);
            return new ErrorDTO($e->getMessage());
        }
    }
}
