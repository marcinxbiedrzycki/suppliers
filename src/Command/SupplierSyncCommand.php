<?php

declare(strict_types=1);

namespace App\Command;

use App\Exception\InvalidParserException;
use App\Supplier\Factory\SupplierFactoryInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

final class SupplierSyncCommand extends Command
{
    protected static $defaultName = 'divante:supplier-sync';

    public function __construct(
        private SupplierFactoryInterface $supplierFactory,
    ) {
        parent::__construct(self::$defaultName);
    }

    protected function configure(): void
    {
        $this->setDescription('Synchronises a given supplier')
            ->addArgument(
                'supplier',
                InputArgument::REQUIRED,
                'Which supplier do you want to synchronize?'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $name = $input->getArgument('supplier');
        $io->info('Synchronising supplier ' . $name);
        $supplier = $this->supplierFactory->getSupplier($name);

        try {
            $table = new Table($output);
            $table->setHeaders(array('ID', 'Name', 'Desc'))->setRows($supplier->getProducts());
            $table->render();

        } catch (\InvalidArgumentException | InvalidParserException $exception) {
            $output->writeln('<error>' . $exception->getMessage() . '</error>');

            return Command::FAILURE;
        }
        $io->success('Done!');

        return Command::SUCCESS;
    }
}
