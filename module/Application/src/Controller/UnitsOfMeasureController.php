<?php

declare(strict_types=1);

namespace Application\Controller;

use Application\Entity\UnitOfMeasure;
use Application\Form\UnitOfMeasureForm;
use Application\Hydrator\EntityHydrator;
use Application\Traits\EntityManagerProperty;
use Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException;
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
    const TEMPLATE_EDIT = 'application/units-of-measure/edit';

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

        $form = new UnitOfMeasureForm('unit');
        $hydrator = new EntityHydrator($this->getEntityManager());

        $entity = new UnitOfMeasure();
        if (!$newEntity) {
            $entity = $this->getRepository()->find($id);
            if (!$entity) {
                throw new EntityNotFoundException(sprintf('Unit of measure with id=%d not found', $id));
            }

            $data = $hydrator->extract($entity);
            $form->setData($data);
        }

        $viewModel = (new ViewModel())
            ->setVariables([
                'form' => $form,
                'newEntity' => $newEntity
            ])
            ->setTemplate(self::TEMPLATE_EDIT)
        ;

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost());

            $isValid = $form->isValid();
            $data = $form->getData();
            $form->setData($data);

            if ($isValid) {
                $hydrator->hydrate($data, $entity);

                $this->getEntityManager()->persist($entity);
                $this->getEntityManager()->flush();

                return $this->redirect()->toRoute(self::ROUTE_NAME);
            }
        }

        return $viewModel;

    }

    public function deleteAction()
    {
        $id = $this->getEvent()->getRouteMatch()->getParam('id', null);

        $entity = $this->getRepository()->find($id);
        if (!$entity) {
            throw new EntityNotFoundException(sprintf('Unit of measure with id=%d not found', $id));
        }

        try {
            $this->getEntityManager()->remove($entity);
            $this->getEntityManager()->flush();
        } catch (ForeignKeyConstraintViolationException $e) {
            // nie można skasować - rekord jest używany
        }

        return $this->redirect()->toRoute(self::ROUTE_NAME);
    }
}
