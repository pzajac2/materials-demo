<?php

namespace Application\Controller;

use Application\Hydrator\EntityHydrator;
use Application\Traits\EntityManagerProperty;
use Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\TransactionRequiredException;
use Laminas\Http\PhpEnvironment\Request;
use Laminas\Http\PhpEnvironment\Response;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Zend\Form\Form;

/**
 * Class SimpleCrudController
 * Kontroler odpowiada za podstawowe operacje na encjach:
 *  dodanie, edycja, skasowanie, listowanie
 *
 * @package Application\Controller
 * @method Request getRequest()
 * @method Response getResponse()()
 */
abstract class SimpleCrudController extends AbstractActionController
{
    use EntityManagerProperty;

    /**
     * SimpleCrudController constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->setEntityManager($entityManager);
    }

    /**
     * @return string zwraca nazwę klasy encji (FQDN)
     */
    abstract protected function getEntityClass(): string;

    /**
     * Zwraca formularz odpowiedzialny za encję
     * @return Form
     */
    abstract protected function getForm(): Form;

    /**
     * @return EntityHydrator
     */
    protected function getEntityHydrator(): EntityHydrator
    {
        return new EntityHydrator($this->getEntityManager());
    }

    /**
     * Index - lista encji
     * @return ViewModel
     */
    public function indexAction()
    {
        /** @var EntityRepository $repository */
        $repository = $this->getEntityManager()->getRepository($this->getEntityClass());

        $entities = $repository->findAll();

        return new ViewModel([
            'entities' => $entities
        ]);
    }

    /**
     * Add - dodanie nowej encji
     *
     * @return Response|ViewModel
     * @throws EntityNotFoundException
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function addAction()
    {
        return $this->editAction();
    }

    /**
     * Edit - edycja istniejącej encji
     * Ta sama metoda obsługuje akcję dodania (add)
     *
     * @return \Laminas\Http\Response|ViewModel
     * @throws EntityNotFoundException
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function editAction()
    {
        $entityClass = $this->getEntityClass();

        /** @var EntityRepository $repository */
        $repository = $this->getEntityManager()->getRepository($entityClass);

        $id = $this->getEvent()->getRouteMatch()->getParam('id', null);
        $newEntity = ($id === null);

        $form = $this->getForm();
        $form->setData([]);
        $hydrator = $this->getEntityHydrator();

        $entity = new $entityClass();
        if (!$newEntity) {
            $entity = $repository->find($id);
            if (!$entity) {
                throw new EntityNotFoundException(sprintf(
                    'Entity %s, id=%d not found',
                    $entityClass,
                    $id
                ));
            }

            $data = $hydrator->extract($entity);
            $form->setData($data);
        }

        $viewModel = (new ViewModel())
            ->setVariables([
                'form' => $form,
                'newEntity' => $newEntity
            ])
            ->setTemplate(static::TEMPLATE_EDIT);

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost());

            $isValid = $form->isValid();
            $data = $form->getData();
            $form->setData($data);

            if ($isValid) {
                $hydrator->hydrate($data, $entity);

                $this->getEntityManager()->persist($entity);
                $this->getEntityManager()->flush();

                return $this->redirect()->toRoute(static::ROUTE_NAME);
            }
        }

        return $viewModel;

    }

    /**
     * Delete - kasowanie encji
     *
     * @return \Laminas\Http\Response
     * @throws EntityNotFoundException
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws TransactionRequiredException
     *
     * @todo Possible XSS - request should be validated
     */
    public function deleteAction()
    {
        $id = $this->getEvent()->getRouteMatch()->getParam('id', null);
        if (!$id) {
            throw new \InvalidArgumentException('Id argument missing');
        }

        $entity = $this->getEntityManager()->find($this->getEntityClass(), $id);

        if (!$entity) {
            throw new EntityNotFoundException(sprintf(
                'Entity %s, id=%d not found',
                $this->getEntityClass(),
                $id
            ));
        }

        try {
            $this->getEntityManager()->remove($entity);
            $this->getEntityManager()->flush();
        } catch (ForeignKeyConstraintViolationException $e) {
            // nie można skasować - rekord jest używany
        }

        return $this->redirect()->toRoute(static::ROUTE_NAME);
    }
}
