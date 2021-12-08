<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Command;

use App\Message\EmployeeSpreadsheetMessage;
use App\Repository\EmployeeRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Messenger\MessageBusInterface;

class EmployeesMessageCommand extends Command
{
    public const ARG_NAME = 'limit';

    protected MessageBusInterface $bus;
    protected EmployeeRepository $repository;
    protected static $defaultName = 'app:employees-message';
    protected static $defaultDescription = 'Тест мессенджер';

    public function __construct(MessageBusInterface $bus, EmployeeRepository $repository)
    {
        parent::__construct();
        $this->bus = $bus;
        $this->repository = $repository;
    }

    protected function configure(): void
    {
        $this
            ->addArgument(
                self::ARG_NAME,
                InputArgument::OPTIONAL, 'Количество работников'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $limit = (int) $input->getArgument(self::ARG_NAME);

        if ($limit) {
            try {
                $io->note(sprintf('You passed an argument: %s', $limit));

                $employees = $this->repository->findBy([], ['lastname' => 'ASC'], $limit);
                $ids = array_map(fn ($item) => $item->getId(), $employees);

                $message = new EmployeeSpreadsheetMessage($ids, 'user@example.com');
                $this->bus->dispatch($message);

                $io->success('Данные улетели');
            } catch (\Exception $e) {
                $io->error($e->getMessage());
            }
        } else {
            $io->warning(self::ARG_NAME.' required');
        }

        return Command::SUCCESS;
    }
}
