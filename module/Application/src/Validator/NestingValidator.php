<?php

namespace Application\Validator;

use Application\Entity\MaterialGroup;
use Application\Traits\EntityManagerProperty;
use Doctrine\ORM\EntityManager;
use Laminas\Validator\AbstractValidator;

/**
 * Class NestingValidator
 * @package Application
 */
class NestingValidator extends AbstractValidator
{
    use EntityManagerProperty;

    const LOOP_DETECTED = 'loop_detected';


    public function __construct(EntityManager $entityManager, $options = null)
    {
        $options['messageTemplates'] = [
            self::LOOP_DETECTED => 'Loop in nesting detected, choose different parent'
        ];
        parent::__construct($options);

        $this->setEntityManager($entityManager);
    }

    public function isValid($value, $context = [])
    {
        $id = $context['id'] ?? null;
        if (empty($value) || empty($id)) {
            return true;
        }
        /** @var MaterialGroup $parentEntity */
        $parentEntity = $this->entityManager->find(MaterialGroup::class, $value);
        $parentsIds = [];
        do {
            $parentsIds[] = $parentEntity->getId();
        } while ($parentEntity = $parentEntity->getParent());

        if (in_array((int)$id, $parentsIds, true)) {
            $this->error(self::LOOP_DETECTED);
            return false;
        }

        return true;
    }

}
