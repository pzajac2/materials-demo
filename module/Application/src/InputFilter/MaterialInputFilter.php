<?php

namespace Application\InputFilter;

use Application\Entity\Material;
use Application\Form\MaterialForm;
use Application\Traits\EntityManagerProperty;
use Doctrine\ORM\EntityManager;
use DoctrineModule\Validator\UniqueObject;
use Laminas\Validator\NotEmpty;

class MaterialInputFilter extends AbstractInputFilter
{
    use EntityManagerProperty;

    public function __construct(EntityManager $entityManager)
    {
        $this->setEntityManager($entityManager);

        // NAME
        $input = $this->getTextInput(MaterialForm::NAME, true, 255);
        $input->getValidatorChain()->attach(new NotEmpty());
        $input->getValidatorChain()->attach($this->getUniqueNameValidator());

        $this->add($input);

        // CODE
        $this->add($this->getInput(MaterialForm::CODE, false));

        // UNIT
        $this->add($this->getInput(MaterialForm::UNIT_ID, true));

        // GROUP
        $input = $this->getInput(MaterialForm::MATERIAL_GROUP_ID, true);
        $this->add($input);
    }

    protected function getUniqueNameValidator()
    {
        $em = $this->getEntityManager();
        $repo = $em->getRepository(Material::class);

        $validator = new UniqueObject([
            'object_manager' => $em,
            'object_repository' => $repo,
            'target_class' => Material::class,
            'fields' => ['name'],
            'use_context' => true
        ]);

        return $validator;
    }
}
