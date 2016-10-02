<?php

namespace AppBundle\Service;

use AppBundle\Entity\Project;
use AppBundle\Repository\ProjectRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Serializer\Encoder\XmlEncoder;

class Fetcher
{
    /** @var EntityRepository $repository */
    private $repository;

    /** @var XmlEncoder $encoder */
    private $encoder;

    const PROJECTS_URL = 'https://updates.drupal.org/release-history/project-list/all';

    public function __construct(EntityRepository $repository, $encoder, $rootNodeName)
    {
        $this->repository = $repository;
        $this->encoder = $encoder;
        $this->encoder->setRootNodeName($rootNodeName);
    }

    public function fetch()
    {
        // Fetch projects from drupal.org.
        $data = file_get_contents(self::PROJECTS_URL);
        $decoded = $this->encoder->decode($data, 'xml');
//        $decoded = $this->get('serializer')->deserialize($data, 'AppBundle\Entity\Project[]', 'xml');

        $projects = array_map(function ($data) {
            return new Project($data);
        }, $decoded['project']);

        // Put to database.
        $this->repository->deleteAll()
                         ->insertMultiple($projects);

        return $projects;
    }
}
