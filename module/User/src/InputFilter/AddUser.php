<?php

namespace User\InputFilter;

use Zend\Filter\FilterChain;
use Zend\Filter\StringTrim;
use Zend\Form\Element\Email;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;
use Zend\Validator\StringLength;
use Zend\Validator\ValidatorChain;
use Zend\Validator\Db\NoRecordExists;
use Zend\Validator\EmailAddress;
use Zend\Validator\Regex;
use Zend\Validator\Identical;

class AddUser extends InputFilter
{
  protected $dbAdapter;

  public function __construct(\Zend\Db\Adapter\Adapter $dbAdapter)
  {
    $this->dbAdapter = $dbAdapter;

    $firstname = new Input('firstName');
    $firstname->setRequired(true);
    $firstname->setValidatorChain($this->getFirstnameValidatorChain());
    $firstname->setFilterChain($this->getStringTrimFilterChain());

    $lastname = new Input('lastName');
    $lastname->setRequired(true);
    $lastname->setValidatorChain($this->getLastnameValidatorChain());
    $lastname->setFilterChain($this->getStringTrimFilterChain());

    // @todo
    $email = new Input('email');
    $email->setRequired(true);
    $email->setValidatorChain($this->getEmailValidatorChain());
    $email->setFilterChain($this->getStringTrimFilterChain());

    $password = new Input('password');
    $password->setRequired(true);
    $password->setValidatorChain($this->getPasswordValidatorChain());
    $password->setFilterChain($this->getStringTrimFilterChain());

    $repeatPassword = new Input('repeatPassword');
    $repeatPassword->setRequired(true);
    $repeatPassword->setValidatorChain($this->getRepeatPasswordValidatorChain());

    $this->add($firstname);
    $this->add($lastname);
    $this->add($email);
    $this->add($password);
    $this->add($repeatPassword);
  }

  protected function getFirstnameValidatorChain()
  {
    $stringLength = new StringLength();
    $stringLength->setMax(50);

    $validatorChain = new validatorChain();
    $validatorChain->attach($stringLength);

    return $validatorChain;
  }

  protected function getLastnameValidatorChain()
  {
    $stringLength = new StringLength();
    $stringLength->setMax(100);

    $validatorChain = new validatorChain();
    $validatorChain->attach($stringLength);

    return $validatorChain;
  }

  protected function getPasswordValidatorChain()
  {
    $stringLength = new StringLength();
    $stringLength->setMin(6);

    $oneNumber = new Regex('/\d/');
    $oneNumber->setMessage('Must contain at least one number');

    $validatorChain = new validatorChain();
    $validatorChain->attach($stringLength);
    $validatorChain->attach($oneNumber);

    return $validatorChain;
  }

  protected function getRepeatPasswordValidatorChain()
  {
    $identical = new Identical();
    $identical->setToken('password');
    $identical->setMessage('Passwords must match');

    $validatorChain = new ValidatorChain();
    $validatorChain->attach($identical);

    return $validatorChain;
  }

  protected function getEmailValidatorChain()
  {
    $stringLength = new StringLength();
    $stringLength->setMin(7);

    $emailDoesNotExist = new NoRecordExists([
      'table' => 'user',
      'field' => 'email',
      'adapter' => $this->dbAdapter
    ]);
    $emailDoesNotExist->setMessage('This email address is already in use');

    $validatorChain = new ValidatorChain();
    $validatorChain->attach($stringLength);
    $validatorChain->attach(new EmailAddress(), true);
    $validatorChain->attach($emailDoesNotExist);

    return $validatorChain;
  }

  protected function getStringTrimFilterChain()
  {
    $filterChain = new FilterChain();
    $filterChain->attach(new StringTrim());

    return $filterChain;
  }
}
