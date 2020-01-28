<?php

declare(strict_types=1);

namespace Application\Controller;

use Application\Entity\MaterialGroup;
use Application\Form\MaterialGroupForm;
use Application\Hydrator\EntityHydrator;
use Application\Hydrator\MaterialGroupHydrator;
use Application\InputFilter\MaterialGroupInputFilter;
use Application\Repository\MaterialGroupsRepository;
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
        /** @var MaterialGroupsRepository $repository */
        $repository = $this->getEntityManager()->getRepository(MaterialGroup::class);

        $form = new MaterialGroupForm('group', [
            MaterialGroupForm::OPTION_AVAILABLE_GROUPS => ($repository ? $repository->getAssocList() : [])
        ]);

        $inputFilter = new MaterialGroupInputFilter($this->getEntityManager());
        $form->setInputFilter($inputFilter);

        return $form;
    }

}
