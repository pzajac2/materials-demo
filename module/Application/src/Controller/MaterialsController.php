<?php

declare(strict_types=1);

namespace Application\Controller;

use Application\Entity\Material;
use Application\Form\UnitOfMeasureForm;
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
        return new MaterialForm('material');
    }

}
