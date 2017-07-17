<?php
namespace Pokedex\InputFilter;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;
use Zend\Filter\FilterChain;
use Zend\Filter\StringTrim;
use Zend\Validator\StringLength;
use Zend\Validator\ValidatorChain;
use Zend\I18n\Validator\Alnum;

class AddPokemon extends InputFilter
{
  public function __construct()
  {
      $name = new Input('name');
      $name->setRequired(true);
      $name->setFilterChain($this->getStringTrimFilterChain());
      $name->setValidatorChain($this->getNameValidatorChain());

      $description = new Input('description');
      $description->setRequired(true);
      $description->setFilterChain($this->getStringTrimFilterChain());
      $description->setValidatorChain($this->getDescriptionValidatorChain());

      $typeB = new Input('typeB');
      $typeB->setRequired(false);

      $this->add($name);
      $this->add($description);
      $this->add($typeB);
  }

  protected function getNameValidatorChain()
  {
      $stringLength = new StringLength();
      $stringLength->setMin(5);
      $stringLength->setMax(50);

      $validatorChain = new ValidatorChain();
      $validatorChain->attach(new Alnum(true));
      $validatorChain->attach($stringLength);

      return $validatorChain;
  }

  protected function getDescriptionValidatorChain()
  {
    $stringLength = new StringLength();
    $stringLength->setMin(10);

    $validatorChain = new ValidatorChain();
    $validatorChain->attach($stringLength);

    return $validatorChain;
  }

  protected function getStringTrimFilterChain()
  {
      $filterChain = new FilterChain();
      $filterChain->attach(new StringTrim());

      return $filterChain;
  }
}
