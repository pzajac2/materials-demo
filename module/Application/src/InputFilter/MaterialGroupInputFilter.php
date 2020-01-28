<?php

namespace Application\InputFilter;

use Application\Entity\MaterialGroup;
use Application\Form\MaterialGroupForm;
use Application\Traits\EntityManagerProperty;
use Application\Validator\NestingValidator;
use Doctrine\ORM\EntityManager;
use DoctrineModule\Validator\UniqueObject;
use Laminas\Validator\NotEmpty;

class MaterialGroupInputFilter extends AbstractInputFilter
{
    use EntityManagerProperty;

    public function __construct(EntityManager $entityManager)
    {
        $this->setEntityManager($entityManager);

        // NAME
        $input = $this->getTextInput(MaterialGroupForm::NAME, true, 255);
        $input->getValidatorChain()->attach(new NotEmpty());
        $input->getValidatorChain()->attach($this->getUniqueNameValidator());

        $this->add($input);

        // PARENT_ID
        $input = $this->getInput(MaterialGroupForm::PARENT_ID, false);
        $input->getValidatorChain()->attach(new NestingValidator($entityManager));
        $this->add($input);
    }

    protected function getUniqueNameValidator()
    {
        $em = $this->getEntityManager();
        $repo = $em->getRepository(MaterialGroup::class);

        $validator = new UniqueObject([
            'object_manager' => $em,
            'object_repository' => $repo,
            'target_class' => MaterialGroup::class,
            'fields' => ['name'],
            'use_context' => true
        ]);

        return $validator;
    }
}
