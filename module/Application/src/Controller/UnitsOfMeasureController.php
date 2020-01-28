<?php

declare(strict_types=1);

namespace Application\Controller;

use Application\Entity\UnitOfMeasure;
use Application\Form\UnitOfMeasureForm;
use Zend\Form\Form;

/**
 * Class UnitsOfMeasureController
 * @package Application\Controller
 */
class UnitsOfMeasureController extends SimpleCrudController
{
    const ROUTE_NAME = 'units_of_measure';
    const TEMPLATE_INDEX = 'application/units-of-measure/index';
    const TEMPLATE_EDIT = 'application/units-of-measure/edit';

    /**
     * @return string
     */
    protected function getEntityClass(): string
    {
        return UnitOfMeasure::class;
    }

    /**
     * @return Form
     */
    protected function getForm(): Form
    {
        return new UnitOfMeasureForm('unit');
    }

}
