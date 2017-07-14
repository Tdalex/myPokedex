<?php

namespace User\Repository;

use User\Entity\User;
use Zend\Crypt\Password\Bcrypt;
use Zend\Db\Adapter\AdapterAwareTrait;
use Zend\Authentication\Adapter\DbTable\CallbackCheckAdapter;

class UserRepositoryImpl implements UserRepository
{
  use AdapterAwareTrait;

  public function add(User $user)
  {
    $sql = new \Zend\Db\Sql\Sql($this->adapter);
    $insert = $sql->insert()
      ->values([
        'first_name'  => $user->getFirstName(),
        'last_name'   => $user->getLastName(),
        'email'       => $user->getEmail(),
        'password'    => $this->generatePassword($user->getPassword()),
        'created'     => time()
      ])->into('user');

      $statement = $sql->prepareStatementForSqlObject($insert);
      $statement->execute();
  }

  public function generatePassword($clearPassword)
  {
    // composer require zendframework/zend-crypt
    $encrypter = new Bcrypt();
    $encrypter->setCost(12);

    return $encrypter->create($clearPassword);
  }

  public function getAuthenticationAdapter()
  {
    $callback = function($encryptedPassword, $clearTextPassword) {
        $encrypter = new Bcrypt();
        $encrypter->setCost(12);

        return $encrypter->verify($clearTextPassword, $encryptedPassword);
    };

    $authenticationAdapter = new CallbackCheckAdapter(
      $this->adapter,
      'user', // name of table
      'email', // field name
      'password',
      $callback
    );

    return $authenticationAdapter;
  }
}
