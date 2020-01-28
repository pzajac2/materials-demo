<?php

declare(strict_types=1);

namespace Application\Controller;

use Application\Entity\Material;
use Application\Entity\MaterialGroup;
use Application\Entity\UnitOfMeasure;
use Application\Form\MaterialForm;
use Application\Form\MaterialGroupForm;
use Application\Form\UnitOfMeasureForm;
use Application\Hydrator\EntityHydrator;
use Application\Hydrator\MaterialHydrator;
use Application\Repository\MaterialGroupsRepository;
use Application\Repository\UnitsOfMeasureRepository;
use Zend\Form\Form;

/**
 * Class MaterialsController
 * @package Application\Controller
 */
class MaterialsController extends SimpleCrudController
{
    const ROUTE_NAME = 'materials';
    const TEMPLATE_INDEX = 'application/materials/index';
    const TEMPLATE_EDIT = 'application/materials/edit';

    /**
     * @return string
     */
    protected function getEntityClass(): string
    {
        return Material::class;
    }

    /**
     * @return Form
     */
    protected function getForm(): Form
    {
        /** @var MaterialGroupsRepository $materialGroupsRepository */
        $materialGroupsRepository = $this->getEntityManager()->getRepository(MaterialGroup::class);

        /** @var UnitsOfMeasureRepository $unitsRepository */
        $unitsRepository = $this->getEntityManager()->getRepository(UnitOfMeasure::class);

        return new MaterialForm('material', [
            MaterialForm::OPTION_AVAILABLE_GROUPS => ($materialGroupsRepository ? $materialGroupsRepository->getAssocList() : []),
            MaterialForm::OPTION_AVAILABLE_UNITS => ($unitsRepository ? $unitsRepository->getAssocList() : [])
        ]);
    }

    protected function getEntityHydrator(): EntityHydrator
    {
        return new MaterialHydrator($this->getEntityManager());
    }

}
