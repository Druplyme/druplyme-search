<?php

namespace AppBundle\Service;

use AppBundle\Entity\Project;
use Symfony\Component\Serializer\Encoder\XmlEncoder;

class Fetcher
{
    /** @var XmlEncoder $encoder */
    private $encoder;

    const PROJECTS_URL = 'https://updates.drupal.org/release-history/project-list/all';

    public function __construct($encoder, $rooNodeName)
    {
        $this->encoder = $encoder;
        $this->encoder->setRootNodeName($rooNodeName);
    }

    public function fetch()
    {
        $data = file_get_contents(self::PROJECTS_URL);
        $decoded = $this->encoder->decode($data, 'xml');
//        $decoded = $this->get('serializer')->deserialize($data, 'AppBundle\Entity\Project[]', 'xml');

        $projects = array_map(function ($data) {
            return new Project($data);
        }, $decoded['project']);

        return $projects;
    }

}
