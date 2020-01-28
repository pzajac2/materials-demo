<?php

namespace Application\Hydrator;

use Application\Entity\Material;
use Application\Entity\MaterialGroup;
use Application\Entity\UnitOfMeasure;
use Doctrine\ORM\EntityManager;

class MaterialHydrator extends EntityHydrator
{
    /**
     * @param Material|object $object
     * @return array
     * @throws \InvalidArgumentException
     */
    public function extract($object)
    {
        $this->checkInstance($object);

        return [
            'id' => $object->getId(),
            'code' => $object->getCode(),
            'name' => $object->getName(),
            'unit_id' => $object->getUnitOfMeasure() ? $object->getUnitOfMeasure()->getId() : null,
            'material_group_id' => $object->getMaterialGroup() ? $object->getMaterialGroup()->getId() : null
        ];
    }

    /**
     * @param array $data
     * @param Material|object $object
     * @return Material|object
     * @throws \Doctrine\ORM\ORMException
     * @throws \InvalidArgumentException
     */
    public function hydrate(array $data, $object)
    {
        $this->checkInstance($object);

        if (!empty($data['id'])) {
            $object->setId((int)$data['id']);
        }
        if (isset($data['code'])) {
            $object->setName($data['code']);
        }
        if (isset($data['name'])) {
            $object->setName($data['name']);
        }
        if (isset($data['unit_id'])) {
            /** @var EntityManager $objectManager */
            $objectManager = $this->objectManager;
            $object->setUnitOfMeasure($objectManager->getReference(UnitOfMeasure::class, (int)$data['unit_id']));
        }
        if (isset($data['material_group_id'])) {
            /** @var EntityManager $objectManager */
            $objectManager = $this->objectManager;
            $object->setMaterialGroup($objectManager->getReference(MaterialGroup::class, (int)$data['material_group_id']));
        }

        return $object;
    }

    /**
     * @param $object
     * @throws \InvalidArgumentException
     */
    private function checkInstance($object): void
    {
        if (!($object instanceof Material)) {
            throw new \InvalidArgumentException('Expecting Material class');
        }
    }


}
