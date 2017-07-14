<?php

namespace User\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class Add extends Form
{
  public function __construct()
  {
    parent::__construct('add');

    $this->setHydrator(new \Zend\Hydrator\ClassMethods());

    $firstname = new Element\Text('firstName');
    $firstname->setLabel('First name');
    $firstname->setAttribute('class', 'form-control');

    $lastname = new Element\Text('lastName');
    $lastname->setLabel('Last name');
    $lastname->setAttribute('class', 'form-control');

    $email = new Element\Text('email');
    $email->setLabel('Email address');
    $email->setAttribute('class', 'form-control');

    $password = new Element\Password('password');
    $password->setLabel('Password');
    $password->setAttribute('class', 'form-control');

    $repeatPassword = new Element\Password('repeatPassword');
    $repeatPassword->setLabel('Repeat password');
    $repeatPassword->setAttribute('class', 'form-control');

    $submit = new Element\Submit('submit');
    $submit->setValue('Add user');
    $submit->setAttribute('class', 'btn btn-primary');

    $this->add($firstname);
    $this->add($lastname);
    $this->add($email);
    $this->add($password);
    $this->add($repeatPassword);
    $this->add($submit);

  }
}
