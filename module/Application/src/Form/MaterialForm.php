<?php

namespace Application\Form;

use Zend\Form\Element\Hidden;
use Zend\Form\Element\Select;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\Form\Form;

class MaterialForm extends Form
{
    const ID = 'id';

    const NAME = 'name';

    const CODE = 'code';

    const UNIT_ID = 'unit_id';

    const MATERIAL_GROUP_ID = 'material_group_id';

    const SUBMIT = 'submit';

    const OPTION_AVAILABLE_GROUPS = 'list_groups';

    const OPTION_AVAILABLE_UNITS = 'list_units';

    private $listOfMaterialGroups = [];

    private $listOfUnits = [];

    /**
     * MaterialForm constructor.
     * @param null $name
     * @param array $options
     */
    public function __construct($name = null, $options = [])
    {
        if (isset($options[self::OPTION_AVAILABLE_GROUPS])) {
            $this->listOfMaterialGroups = $options[self::OPTION_AVAILABLE_GROUPS];
        }

        if (isset($options[self::OPTION_AVAILABLE_UNITS])) {
            $this->listOfUnits = $options[self::OPTION_AVAILABLE_UNITS];
        }
        parent::__construct($name, $options);

        $this->add(
            (new Hidden(self::ID))
                ->setLabel('ID')
        );
        $this->add(
            (new Text(self::NAME))
                ->setLabel('Nazwa')
        );
        $this->add(
            (new Text(self::CODE))
                ->setLabel('Kod')
        );
        $this->add(
            (new Select(self::UNIT_ID))
                ->setValueOptions($this->listOfUnits)
                ->setLabel('Jednostka miary')
        );
        $this->add(
            (new Select(self::MATERIAL_GROUP_ID))
                ->setValueOptions($this->listOfMaterialGroups)
                ->setLabel('Rodzic')
        );

        $this->add(
            (new Submit(self::SUBMIT))
                ->setValue('Zapisz')
        );

        $this->prepare();
    }

}
