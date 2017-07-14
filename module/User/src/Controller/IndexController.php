<?php

namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use User\Form\Add;
use User\Form\Login;
use User\Entity\User;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
  protected $addUserFilter;
  protected $userService;

  public function __construct(\User\Service\UserService $userService, \User\InputFilter\AddUser $addUserFilter)
  {
    $this->addUserFilter = $addUserFilter;
    $this->userService = $userService;
  }

  public function addAction()
  {
    $form = new Add();

    $variables = [
      'form' => $form
    ];

    if ($this->request->isPost()) {
      $user = new User();
      $form->bind($user);
      $form->setInputFilter($this->addUserFilter);
      $form->setData($this->request->getPost());

      if ($form->isValid()) {
        $this->userService->add($user);
      }
    }

    return new ViewModel($variables);
  }

  public function loginAction()
  {
    if ($this->identity() != null) {
      return $this->redirect()->toRoute('pokedex_home');
    }

    $form = new Login();
    if ($this->request->isPost()) {
      $form->setData($this->request->getPost());
      // @todo use login InputFilter
      // $form->setInputFilter();

      if ($form->isValid()) {
        $data = $form->getData();
        $loginResult = $this->userService
          ->login(
            $data['email'],
            $data['password']
          );

        if ($loginResult === true) {
          $this->flashMessenger()->addSuccessMessage('You are now logged in');
        } else {
          $this->flashMessenger()->addWarningMessage('Invalid credentials');
        }
      }
    }

    return new ViewModel([
      'form' => $form
    ]);
  }

  public function logoutAction()
  {
    $authenticationService = $this->userService->getAuthenticationService();
    $authenticationService->clearIdentity();

    return $this->redirect()->toRoute('login');
  }
}
