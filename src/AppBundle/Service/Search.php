<?php

namespace AppBundle\Service;

use FS\SolrBundle\Solr;
use Symfony\Component\HttpFoundation\ParameterBag;

class Search
{
    protected $solr;
    protected $entity;

    const LIMIT = 20;

    public function __construct(Solr $solr, $entity)
    {
        $this->solr = $solr;
        $this->entity = $entity;
    }

    public function find(ParameterBag $parameters)
    {
        $page = $parameters->get('page', 0);
        $limit = $parameters->get('limit', self::LIMIT);
        $offset = $page * $limit;

        $query = $this->solr->createQuery($this->entity);
        $query->setRows($limit);
        $query->setStart($offset);

        if ($phrase = $parameters->get('v')) {
            $query->setUseWildcard(true);
        }

        if ($phrase = $parameters->get('z')) {
            $phrase .= '*';
        }

//        $query->addSort('title', 'asc');
        $query->queryAllFields($phrase);

        return $query->getResult();
    }
}
