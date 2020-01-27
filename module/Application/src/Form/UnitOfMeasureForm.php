<?php


namespace Application\Form;


use Zend\Form\Element\Text;
use Zend\Form\Form;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;

class UnitOfMeasureForm extends Form
{
    const NAME = 'name';

    const SHORT_NAME = 'short_name';

    public function __construct($name = null, $options = [])
    {
        parent::__construct($name, $options);

        $this->add(
            (new Text(self::NAME))
                ->setLabel('Nazwa')
        );

        $this->add(
            (new Text(self::SHORT_NAME))
                ->setLabel('Nazwa skrócona')
        );

        $this->prepare();
    }

    public function getInputFilter()
    {
        $inputFilter = new InputFilter();
        $inputFilter->add(new Input(self::NAME));
        $inputFilter->add(new Input(self::SHORT_NAME));
        return $inputFilter;
    }


}