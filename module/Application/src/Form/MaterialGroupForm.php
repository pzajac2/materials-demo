<?php

namespace Application\Form;

use Zend\Form\Element\Hidden;
use Zend\Form\Element\Select;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\Form\Form;

class MaterialGroupForm extends Form
{
    const ID = 'id';

    const NAME = 'name';

    const PARENT_ID = 'parent_id';

    const SUBMIT = 'submit';

    const OPTION_AVAILABLE_GROUPS = 'list_groups';

    private $listOfMaterialGroups = [];

    /**
     * MaterialGroupForm constructor.
     * @param null $name
     * @param array $options
     */
    public function __construct($name = null, $options = [])
    {
        if (isset($options[self::OPTION_AVAILABLE_GROUPS])) {
            $this->listOfMaterialGroups = $options[self::OPTION_AVAILABLE_GROUPS];
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
            (new Select(self::PARENT_ID))
                ->setEmptyOption('-brak-')
                ->setValueOptions($this->listOfMaterialGroups)
                ->setLabel('Rodzic')
        );

        $this->add(
            (new Submit(self::SUBMIT))
                ->setValue('Zapisz')
        );

//        $this->setUseInputFilterDefaults(false);
        $this->prepare();

    }

    public function setData($data)
    {
        $result = parent::setData($data);
        $this->setOptionsForParentSelect($data['id'] ?? null);
        return $result;
    }

    public function setOptionsForParentSelect($currentId = null)
    {
        $options = $this->getMaterialGroupsList();
        $options = array_filter($options, static function ($elementId) use ($currentId) {
            return ($currentId === null || (int)$currentId !== (int)$elementId);
        }, ARRAY_FILTER_USE_KEY);
        $this->get(self::PARENT_ID)->setValueOptions($options);

    }

    protected function getMaterialGroupsList(): array
    {
        return $this->listOfMaterialGroups;
    }

}
