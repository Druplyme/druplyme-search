<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AppFetchCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('app:fetch')
             ->setDescription('Fetch projects list from drupal.org');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getContainer()->get('app.fetcher')
             ->fetch();

        $output->writeln('Projects has been fetched from drupal.org.');
    }
}
