<?php

declare(strict_types=1);

namespace Application\Controller;

use Application\Entity\UnitOfMeasure;
use Application\Traits\EntityManagerProperty;
use Doctrine\ORM\EntityManager;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class UnitsOfMeasureController extends AbstractActionController
{
    use EntityManagerProperty;

    const ROUTE_NAME = 'units_of_measure';

    public function __construct(EntityManager $entityManager)
    {
        $this->setEntityManager($entityManager);
    }

    public function indexAction()
    {
        $unitsRepository = $this->getEntityManager()->getRepository(UnitOfMeasure::class);

        $units = $unitsRepository->findAll();

        return new ViewModel([
            'units' => $units
        ]);
    }

}