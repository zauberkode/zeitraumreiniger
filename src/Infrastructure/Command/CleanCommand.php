<?php

namespace App\Infrastructure\Command;

use App\Application\UseCase\Command\Period\Reset\ResetPeriodUseCase;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:clean',
    description: "Resets IDE evaluation status",
    hidden: false
)]
class CleanCommand extends Command
{
    private ResetPeriodUseCase $useCase;

    public function __construct(ResetPeriodUseCase $useCase)
    {
        $this->useCase = $useCase;
        parent::__construct(null);
    }

    protected function configure(): void
    {
        parent::configure();
        $this->setHelp("This command allows you to reset IDE evaluation status");
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->useCase->reset();
        return Command::SUCCESS;
    }
}
