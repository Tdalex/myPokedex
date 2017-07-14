<?php

namespace User\Controller;

use Interop\Container\ContainerInterface;

class IndexControllerFactory
{
  public function __invoke(ContainerInterface $container)
  {
    return new IndexController(
      $container->get('User\Service\UserService'),
      $container->get('User\InputFilter\AddUser')
    );
  }
}
