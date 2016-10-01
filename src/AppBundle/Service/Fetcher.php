<?php

namespace AppBundle\Service;

use AppBundle\Entity\Project;
use Symfony\Component\Serializer\Encoder\XmlEncoder;

class Fetcher
{
    /** @var XmlEncoder $encoder */
    private $encoder;

    public function __construct()
    {
        $this->encoder = new XmlEncoder('projects');
    }

    public function fetch()
    {
        $data = file_get_contents('https://updates.drupal.org/release-history/project-list/all');
        $decoded = $this->encoder->decode($data, 'xml');

//        $serializer = new Serializer(
//          [new GetSetMethodNormalizer(), new ArrayDenormalizer()],
//          [new XmlEncoder('projects')]
//        );
//        $decoded = $serializer->deserialize($data, 'AppBundle\Entity\Project[]', 'xml');

        $projects = array_map(function ($data) {
            return new Project($data);
        }, $decoded['project']);

        return $projects;
    }

}
