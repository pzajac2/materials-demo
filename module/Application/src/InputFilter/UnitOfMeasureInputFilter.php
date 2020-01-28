<?php


namespace Application\InputFilter;


use Application\Form\UnitOfMeasureForm;

class UnitOfMeasureInputFilter extends AbstractInputFilter
{
    public function __construct()
    {
        $this->add(
            $this->getTextInput(UnitOfMeasureForm::NAME, true)
        );
        $this->add(
            $this->getTextInput(UnitOfMeasureForm::SHORT_NAME, true, 50)
        );
    }
}
