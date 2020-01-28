<?php


namespace Application\Form;


use Application\InputFilter\UnitOfMeasureInputFilter;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\Form\Form;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;

class UnitOfMeasureForm extends Form
{
    const NAME = 'name';

    const SHORT_NAME = 'short_name';

    const SUBMIT = 'submit';

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

        $this->add(
            (new Submit(self::SUBMIT))
                ->setValue('Zapisz')
        );

        $this->setUseInputFilterDefaults(false);
        $this->setInputFilter(new UnitOfMeasureInputFilter());

        $this->prepare();
    }

}