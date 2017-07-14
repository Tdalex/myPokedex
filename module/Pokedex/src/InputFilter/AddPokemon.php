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
      $title = new Input('title');
      $title->setRequired(true);
      $title->setFilterChain($this->getStringTrimFilterChain());
      $title->setValidatorChain($this->getTitleValidatorChain());

      $slug = new Input('slug');
      $slug->setRequired(true);
      $slug->setFilterChain($this->getStringTrimFilterChain());
      $slug->setValidatorChain($this->getSlugValidatorChain());

      $content = new Input('content');
      $content->setRequired(true);
      $content->setFilterChain($this->getStringTrimFilterChain());
      $content->setValidatorChain($this->getContentValidatorChain());

      $this->add($title);
      $this->add($slug);
      $this->add($content);
  }

  protected function getTitleValidatorChain()
  {
      $stringLength = new StringLength();
      $stringLength->setMin(5);
      $stringLength->setMax(50);

      $validatorChain = new ValidatorChain();
      $validatorChain->attach(new Alnum(true));
      $validatorChain->attach($stringLength);

      return $validatorChain;
  }

  protected function getSlugValidatorChain()
  {
    $stringLength = new StringLength();
    $stringLength->setMin(5);
    $stringLength->setMax(50);

    $validatorChain = new ValidatorChain();
    $validatorChain->attach($stringLength);

    return $validatorChain;
  }

  protected function getContentValidatorChain()
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
