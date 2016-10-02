<?php

namespace AppBundle\Service;

use AppBundle\Repository\ProjectRepository;

class Indexer
{
    /** @var ProjectRepository $repository */
    private $repository;

    /** @var Fetcher $fetcher */
    private $fetcher;

    public function __construct(ProjectRepository $repository, Fetcher $fetcher)
    {
        $this->fetcher = $fetcher;
        $this->repository = $repository;
    }

    public function index($prefetch = false)
    {
        $projects = $prefetch ? $this->fetcher->fetch() : $this->repository->findAll();

        //        $container->get('solr.client')
//                  ->synchronizeIndex($projects);
    }
}
