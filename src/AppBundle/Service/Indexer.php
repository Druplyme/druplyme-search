<?php

namespace AppBundle\Service;

use AppBundle\Repository\ProjectRepository;
use Symfony\Component\DependencyInjection\Container;

class Indexer
{

    /** @var ProjectRepository $repository */
    private $repository;

    /** @var Fetcher $fetcher */
    private $fetcher;

    public function __construct(ProjectRepository $repository, Fetcher $fetcher, Container $container)
    {
        $this->fetcher = $fetcher;
        $this->repository = $repository;
        $this->container = $container;
    }

    public function index($prefetch = false)
    {
        $projects = $prefetch ? $this->fetcher->fetch() : $this->repository->findAll();
        $solr = $this->container->get('solr.client');

        foreach (array_chunk($projects, 300) as $entities) {
            $solr->synchronizeIndex($entities);
        }

    }
}
