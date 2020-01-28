<?php

namespace Application\Repository;

use Application\Entity\MaterialGroup;
use Doctrine\ORM\EntityRepository;

class MaterialGroupsRepository extends EntityRepository
{
    public function getAssocList(): array
    {
        /** @var MaterialGroup[] $entities */
        $entities = $this->findAll();
        $data = [];
        foreach ($entities as $entity) {
            $data[(int)$entity->getId()] = $entity->getName();
        }
        return $data;
    }
}
