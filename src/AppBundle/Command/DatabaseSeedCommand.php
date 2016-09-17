<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DatabaseSeedCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('database:seed')
            ->setDescription('Creates necessary records in database');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getContainer()->get('app.service.review')->seedDatabase();

        $output->writeln('Command result.');
    }

}
