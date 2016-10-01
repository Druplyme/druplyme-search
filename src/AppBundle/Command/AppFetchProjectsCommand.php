<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AppFetchProjectsCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('app:fetch-projects')
             ->setDescription('Fetch projects list from drupal.org');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $projects = $this->getContainer()
                         ->get('app.fetcher')
                         ->fetch();

        $this->getContainer()
             ->get('doctrine')
             ->getRepository('AppBundle:Project')
             ->deleteAll()
             ->insertMultiple($projects);

        $output->writeln('Projects has been fetched from drupal.org.');
    }
}
