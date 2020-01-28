<?php


namespace Application\ViewHelper;


use Zend\Form\ElementInterface;
use Zend\Form\View\Helper\FormRow;

class BootstrapElement extends FormRow
{

    public function __invoke(ElementInterface $element = null, $labelPosition = null, $renderErrors = null, $partial = null)
    {
        // standard rendering
        if ($element->getAttribute('type') === 'hidden') {
            return parent::__invoke($element, $labelPosition, $renderErrors, $partial);
        }
        $element->setAttribute('class', $element->getAttribute('class') . ' form-control');
        $html .= '';
        $html .= '<div class="form-group">';
        $html .= '<div class="row">';
        $html .= '<div class="col-sm-3">';

        if (!empty($element->getLabel())) {
            $html .= $this->getLabelHelper()->__invoke($element);
        }
        $html .= '</div>';
        $html .= '<div class="col-sm-9">';
        $html .= $this->getElementHelper()->__invoke($element);
        $html .= $this->getElementErrorsHelper()->__invoke($element);
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';
        return $html;
    }

}
