<?php

declare(strict_types=1);

namespace Application\Controller;

use Application\Entity\MaterialGroup;
use Application\Form\MaterialGroupForm;
use Application\Hydrator\EntityHydrator;
use Application\Hydrator\MaterialGroupHydrator;
use Application\InputFilter\MaterialGroupInputFilter;
use Application\Repository\MaterialGroupsRepository;
use Laminas\View\Model\ViewModel;
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

        $form->setInputFilter(new MaterialGroupInputFilter($this->getEntityManager()));

        return $form;
    }

    /**
     * Wyświetla kategorię w formie drzewa
     */
    public function treeAction()
    {
        $id = $this->getEvent()->getRouteMatch()->getParam('id', null);

        $repository = $this->getEntityManager()->getRepository(MaterialGroup::class);

        if ($id === null) {
            $nodes = $repository->findBy([
                'parent' => $id
            ]);
        } else {
            $nodes = $repository->findBy([
                'id' => $id
            ]);
        }

        return new ViewModel([
            'id' => $id,
            'nodes' => $nodes
        ]);
    }

}
