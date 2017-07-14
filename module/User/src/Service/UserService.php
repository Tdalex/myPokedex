<?php

namespace User\Service;

use User\Entity\User;

interface UserService
{
  public function add(User $user);

  public function getAuthenticationService();
  /**
   * @return bool
   */
  public function login($email, $password);
}
