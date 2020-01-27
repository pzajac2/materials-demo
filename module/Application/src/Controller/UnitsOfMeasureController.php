<?php

declare(strict_types=1);

namespace Application\Controller;

use Application\Entity\UnitOfMeasure;
use Application\Form\UnitOfMeasureForm;
use Application\Traits\EntityManagerProperty;
use Doctrine\DBAL\Schema\View;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\EntityRepository;
use Laminas\Http\PhpEnvironment\Request;
use Laminas\Http\PhpEnvironment\Response;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

/**
 * Class UnitsOfMeasureController
 * @package Application\Controller
 * @method Request getRequest()
 * @method Response getResponse()()
 */
class UnitsOfMeasureController extends AbstractActionController
{
    use EntityManagerProperty;

    const ROUTE_NAME = 'units_of_measure';

    public function __construct(EntityManager $entityManager)
    {
        $this->setEntityManager($entityManager);
    }

    protected function getRepository(): EntityRepository
    {
        return $this->getEntityManager()->getRepository(UnitOfMeasure::class);
    }

    public function indexAction()
    {
        $units = $this->getRepository()->findAll();

        return new ViewModel([
            'units' => $units
        ]);
    }

    public function addAction()
    {
        return $this->editAction();
    }

    public function editAction()
    {
        $id = $this->getEvent()->getRouteMatch()->getParam('id', null);

        $newEntity = ($id === null);
        if (!$newEntity) {
            $entity = $this->getRepository()->find($id);
            if (!$entity) {
                throw new EntityNotFoundException(sprintf('Unit of measure with id=%d not found', $id));
            }
        }

        $form = new UnitOfMeasureForm('unit');


        return (new ViewModel([
            'form' => $form
        ]))->setTemplate('application/units-of-measure/edit');


    }
}