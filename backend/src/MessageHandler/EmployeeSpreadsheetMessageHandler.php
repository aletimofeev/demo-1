<?php


namespace App\MessageHandler;

use App\Message\EmployeeSpreadsheetMessage;
use App\Service\Employee\EmployeeService;
use Exception;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

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
        list($ids, $email, $username) = array_values($message->getContext());
        $filename = $this->service->createSpreadsheet($ids);

        try {
            $this->sendEmail($filename, $email, $username);
            unlink($filename);
        } catch (Exception $e) {
            echo $e->getMessage(), \PHP_EOL;
        }
    }

    private function sendEmail(string $filename, string $to, string $username): void
    {
        $email = (new TemplatedEmail())
            ->from($this->adminEmail)
            ->to($to)
            ->subject('Список работников')
            ->htmlTemplate('emails/employees.html.twig')
            ->context(['username' => $username])
            ->attachFromPath($filename);

        $this->mailer->send($email);
    }
}
