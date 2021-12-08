<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\MessageHandler;

use App\Message\EmployeeSpreadsheetMessage;
use App\Service\Employee\EmployeeService;
use Exception;
use const PHP_EOL;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Mime\Email;

final class EmployeeSpreadsheetMessageHandler implements MessageHandlerInterface
{
    private EmployeeService $service;
    private MailerInterface $mailer;
    private string $adminEmail;

    public function __construct(EmployeeService $service, MailerInterface $mailer, $adminEmail)
    {
        $this->service = $service;
        $this->mailer = $mailer;
        $this->adminEmail = $adminEmail;
    }

    public function __invoke(EmployeeSpreadsheetMessage $message)
    {
        list($ids, $email) = array_values($message->getContext());
        $filename = $this->service->createSpreadsheet($ids);

        try {
            $this->sendEmail($filename, $email);
            unlink($filename);
        } catch (Exception $e) {
            echo $e->getMessage(), PHP_EOL;
        }
    }

    private function sendEmail(string $filename, string $to): void
    {
        $email = (new Email())
            ->from($this->adminEmail)
            ->to($to)
            ->subject('Список работников')
            ->text('Запрошенные данные во вложении')
            ->attachFromPath($filename);

        $this->mailer->send($email);
    }
}
