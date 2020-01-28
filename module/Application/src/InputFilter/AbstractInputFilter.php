<?php


namespace Application\InputFilter;


use Laminas\Validator\StringLength;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;

abstract class AbstractInputFilter extends InputFilter
{
    protected function getInput(string $name, bool $required = false)
    {
        $input = new Input($name);
        $input->setRequired($required);
        return $input;
    }

    protected function getTextInput(string $name, bool $required = false, $maxLength = 255)
    {
        $input = $this->getInput($name, $required);
        $input->getFilterChain()
            ->attach(new StripTags())
            ->attach(new StringTrim())
        ;

        $input->getValidatorChain()
            ->attach(
                (new StringLength())
                    ->setMin(1)
                    ->setMax($maxLength)
            )
        ;

        return $input;
    }
}