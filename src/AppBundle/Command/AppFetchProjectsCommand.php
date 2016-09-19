<?php

namespace AppBundle\Command;

use AppBundle\Entity\Project;
use AppBundle\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Serializer\Encoder\XmlEncoder;

class AppFetchProjectsCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('app:fetch-projects')
             ->setDescription('Fetch projects list from drupal.org');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $data = file_get_contents('https://updates.drupal.org/release-history/project-list/all');
        $encoder = new XmlEncoder('projects');
        $decoded = $encoder->decode($data, 'xml');

//        $serializer = new Serializer(
//          [new GetSetMethodNormalizer(), new ArrayDenormalizer()],
//          [new XmlEncoder('projects')]
//        );
//        $decoded = $serializer->deserialize($data, 'AppBundle\Entity\Project[]', 'xml');

        $projects = array_map(function ($data) {
            return new Project($data);
        },
          $decoded['project']);

        /** @var $projectRepo ProjectRepository */
        $projectRepo = $this->getContainer()
                            ->get('doctrine')
                            ->getRepository('AppBundle:Project');

        $projectRepo->deleteAll()
                    ->insertMultiple($projects);

        $output->writeln('Projects has been fetched from drupal.org.');
    }

}
