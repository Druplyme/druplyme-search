<?php

namespace AppBundle\Command;

use AppBundle\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AppIndexingCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('app:index')
             ->setDescription('Index projects with Solr');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var $projectRepo ProjectRepository */
        $projectRepo = $this->getContainer()
                            ->get('doctrine')
                            ->getRepository('AppBundle:Project');

        $projects = $projectRepo->findAll();
        $this->getContainer()
             ->get('solr.client')
             ->synchronizeIndex($projects);

        $output->writeln('Projects indexing has been finished.');
    }

}
