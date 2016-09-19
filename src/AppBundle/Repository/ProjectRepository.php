<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Project;

/**
 * ProjectRepository
 */
class ProjectRepository extends \Doctrine\ORM\EntityRepository
{
    const CHUNK_SIZE = 5000;

    public function insertMultiple($entities)
    {
        $conn = $this->getEntityManager()->getConnection();
        foreach (array_chunk($entities, self::CHUNK_SIZE) as $chunk) {
            $conn->beginTransaction();

            /** @var $project Project */
            foreach ($chunk as $project) {
                $conn->insert('project', $project->toArray($project));
                $index[] = $project;
            }

            $conn->commit();
        }
    }

    public function deleteAll()
    {
        $this->getEntityManager()
             ->createQueryBuilder()
             ->delete($this->_entityName)
             ->getQuery()->execute();

        return $this;
    }
}
