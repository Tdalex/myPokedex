<?php

namespace User\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class Login extends Form
{
  public function __construct()
  {
    parent::__construct('login');

    $email = new Element\Text('email');
    $email->setLabel('email');
    $email->setAttribute('class', 'form-control');

    $password = new Element\Password('password');
    $password->setLabel('password');
    $password->setAttribute('class', 'form-control');

    $submit = new Element\Submit('submit');
    $submit->setValue('Log me in');
    $submit->setAttribute('class', 'btn btn-primary');

    $this->add($email);
    $this->add($password);
    $this->add($submit);
  }
}
