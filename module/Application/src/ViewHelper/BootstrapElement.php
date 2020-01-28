<?php


namespace Application\ViewHelper;


use Zend\Form\ElementInterface;
use Zend\Form\View\Helper\FormRow;

class BootstrapElement extends FormRow
{
    public function __invoke(ElementInterface $element = null, $labelPosition = null, $renderErrors = null, $partial = null)
    {
        return parent::__invoke($element, $labelPosition, $renderErrors, $partial);
    }

}
