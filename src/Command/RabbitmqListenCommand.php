<?php

namespace App\Command;

use App\Interface\RabbitmqManagerInterface;
use App\Manager\RabbitmqManager;
use PhpAmqpLib\Message\AMQPMessage;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'rabbitmq_listen',
    description: 'Add a short description for your command',
)]
class RabbitmqListenCommand extends Command
{

    public function __construct(
        private readonly RabbitmqManagerInterface $rabbitmqManager,
    )
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    /**
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $connection = $this->rabbitmqManager->getConnection();
        $channel = $connection->channel();

        $channel->queue_declare(
            'test',
            false,
            false,
            false,
            false,
        );

        $channel->basic_consume(
            'test',
            '',
            false,
            true,
            false,
            false,
            $this->process(...),
        );

        while (count($channel->callbacks)) {
            $channel->wait();
        }

        $channel->close();
        $connection->close();

        $io = new SymfonyStyle($input, $output);
        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }

    private function process(AMQPMessage $ampqMessage)
    {
        $message = unserialize($ampqMessage->getBody());
        dump($message);
    }
}
