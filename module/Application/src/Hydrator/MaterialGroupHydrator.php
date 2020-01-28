<?php

namespace Application\Hydrator;

use Application\Entity\MaterialGroup;
use Doctrine\ORM\EntityManager;

class MaterialGroupHydrator extends EntityHydrator
{
    public function extract($object)
    {
        if (!($object instanceof MaterialGroup)) {
            throw new \InvalidArgumentException('Expecting MaterialGroup class');
        }

        return [
            'id' => $object->getId(),
            'name' => $object->getName(),
            'parent_id' => $object->getParent() ? $object->getParent()->getId() : null,
        ];
    }

    public function hydrate(array $data, $object)
    {
        if (!($object instanceof MaterialGroup)) {
            throw new \InvalidArgumentException('Expecting MaterialGroup class');
        }

        if (!empty($data['id'])) {
            $object->setId((int)$data['id']);
        }
        if (isset($data['name'])) {
            $object->setName($data['name']);
        }
        if (isset($data['parent_id'])) {
            /** @var EntityManager $objectManager */
            $objectManager = $this->objectManager;
            $object->setParent($objectManager->getReference(MaterialGroup::class, (int)$data['parent_id']));
        }


        return $object;
    }


}
