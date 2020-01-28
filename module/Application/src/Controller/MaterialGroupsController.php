<?php

declare(strict_types=1);

namespace Application\Controller;

use Application\Entity\Material;
use Application\Entity\MaterialGroup;
use Application\Form\MaterialGroupForm;
use Application\Form\UnitOfMeasureForm;
use Application\Hydrator\EntityHydrator;
use Application\Hydrator\MaterialGroupHydrator;
use Zend\Form\Form;

/**
 * Class MaterialGroupsController
 * @package Application\Controller
 */
class MaterialGroupsController extends SimpleCrudController
{
    const ROUTE_NAME = 'material_groups';
    const TEMPLATE_INDEX = 'application/material-groups/index';
    const TEMPLATE_EDIT = 'application/material-groups/edit';

    /**
     * @return string
     */
    protected function getEntityClass(): string
    {
        return MaterialGroup::class;
    }

    protected function getEntityHydrator(): EntityHydrator
    {
        return new MaterialGroupHydrator($this->getEntityManager());
    }

    /**
     * @return Form
     */
    protected function getForm(): Form
    {
        $form = new MaterialGroupForm('material', []);
        $form->setEntityManager($this->getEntityManager());
        return $form;
    }

}
