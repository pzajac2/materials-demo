<?php

namespace Application\Hydrator;

use Application\Entity\Material;
use Application\Form\MaterialForm;
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
            MaterialForm::ID => $object->getId(),
            MaterialForm::CODE => $object->getCode(),
            MaterialForm::NAME => $object->getName(),
            MaterialForm::UNIT_ID => $object->getUnitOfMeasure() ? $object->getUnitOfMeasure()->getId() : null,
            MaterialForm::MATERIAL_GROUP_ID => $object->getMaterialGroup() ? $object->getMaterialGroup()->getId() : null
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

        if (!empty($data[MaterialForm::ID])) {
            $object->setId((int)$data[MaterialForm::ID]);
        }
        if (isset($data[MaterialForm::CODE])) {
            $object->setCode($data[MaterialForm::CODE]);
        }
        if (isset($data[MaterialForm::NAME])) {
            $object->setName($data[MaterialForm::NAME]);
        }
        if (isset($data[MaterialForm::UNIT_ID])) {
            /** @var EntityManager $objectManager */
            $objectManager = $this->objectManager;
            $object->setUnitOfMeasure($objectManager->getReference(
                UnitOfMeasure::class,
                (int)$data[MaterialForm::UNIT_ID]
            ));
        }
        if (!empty($data[MaterialForm::MATERIAL_GROUP_ID])) {
            /** @var EntityManager $objectManager */
            $objectManager = $this->objectManager;
            $object->setMaterialGroup($objectManager->getReference(
                MaterialGroup::class,
                (int)$data[MaterialForm::MATERIAL_GROUP_ID]
            ));
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
