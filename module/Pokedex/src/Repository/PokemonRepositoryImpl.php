<?php

namespace Pokedex\Repository;

use Pokedex\Entity\Hydrator\CategoryHydrator;
use Pokedex\Entity\Hydrator\PokemonHydrator;
use Zend\Hydrator\Aggregate\AggregateHydrator;
use Zend\Db\ResultSet\HydratingResultSet;
use Pokedex\Repository\PokemonRepository;
use Zend\Db\Adapter\AdapterAwareTrait;
use Pokedex\Entity\Pokemon;

class PokemonRepositoryImpl implements PokemonRepository
{
  use AdapterAwareTrait;

  public function save(Pokemon $pokemon)
  {
      try {
          $this->adapter
            ->getDriver()
            ->getConnection()
            ->beginTransaction();

      $sql = new \Zend\Db\Sql\Sql($this->adapter);
      $insert = $sql->insert()
        ->values([
          'title' => $pokemon->getTitle(),
          'slug'  => $pokemon->getSlug(),
          'content' => $pokemon->getContent(),
          'category_id' => $pokemon->getCategory()->getId(),
          'created' => time()
        ])
        ->into('pokemon');
     $statement = $sql->prepareStatementForSqlObject($insert);
     $statement->execute();
     $this->adapter->getDriver()
      ->getConnection()
      ->commit();
   } catch (\Exception $e) {
        $this->adapter->getDriver()
          ->getConnection()->rollback();
   }
  }

  public function fetchAll()
  {
      $sql = new \Zend\Db\Sql\Sql($this->adapter);
      $select = $sql->select();
      $select->columns([
          'id',
      ])->from([
        'p' => 'pokemon'
      ])->join(
          ['c' => 'category'], // table name
          'c.id = p.category_id',
          ['category_id' => 'id', 'name', 'category_slug' => 'slug'] // column alias
      );

      $statement = $sql->prepareStatementForSqlObject($select);
      $result = $statement->execute();

      $hydrator = new AggregateHydrator();
      $hydrator->add(new PokemonHydrator());
      $hydrator->add(new CategoryHydrator());
      $resultSet = new HydratingResultSet($hydrator, new Pokemon());
      $resultSet->initialize($result);

      $pokemons = [];
      foreach($resultSet as $pokemon) {
          /**
           * @var \Pokedex\Entity\Pokemon $pokemon
           */
          $pokemons[] = $pokemon;
      }
      return $pokemons;
  }

  public function fetch($page)
  {
	  return array();
      $sql = new \Zend\Db\Sql\Sql($this->adapter);
      $select = $sql->select();
      $select->columns([
          'id',
          'title',
          'slug',
          'content',
          'created'
      ])->from([
        'p' => 'pokemon'
      ])->join(
          ['c' => 'category'], // table name
          'c.id = p.category_id',
          ['category_id' => 'id', 'name', 'category_slug' => 'slug'] // column alias
      );

      $hydrator = new AggregateHydrator();
      $hydrator->add(new PokemonHydrator());
      $hydrator->add(new CategoryHydrator());
      $resultSet = new HydratingResultSet($hydrator, new Pokemon());

        $paginatorAdapter = new \Zend\Paginator\Adapter\DbSelect(
            $select,
            $this->adapter,
            $resultSet
          );
          $paginator = new \Zend\Paginator\Paginator($paginatorAdapter);
          $paginator->setCurrentPageNumber($page);
          $paginator->setItemCountPerPage(3);

          return $paginator;
  }

  /**
   * @return Pokemon|null
   */
  public function find($categorySlug, $pokemonSlug)
  {
      $sql = new \Zend\Db\Sql\Sql($this->adapter);
      $select = $sql->select();
      $select->columns([
        'id',
        'title',
        'slug',
        'content',
        'created'
      ])->from(
        ['p' => 'pokemon']
      )->join(
        ['c' => 'category'], // TABLE NAME
        'c.id = p.category_id', // JOIN CONDITION
        ['category_id' => 'id', 'name', 'category_slug' => 'slug']
      )->where(
        [ 'c.slug' => $categorySlug, 'p.slug' => $pokemonSlug]
      );

      $statement = $sql->prepareStatementForSqlObject($select);
      $results = $statement->execute();

      $hydrator = new AggregateHydrator();
      $hydrator->add(new PokemonHydrator());
      $hydrator->add(new CategoryHydrator());

      $resultSet = new HydratingResultSet($hydrator, new Pokemon());
      $resultSet->initialize($results);

      return ($resultSet->count() ? $resultSet->current() : null);
  }

  /**
   * @return Pokemon|null
   */
  public function findById($pokemonId)
  {
    $sql = new \Zend\Db\Sql\Sql($this->adapter);
    $select = $sql->select();
    $select->columns([
      'id',
      'title',
      'slug',
      'content',
      'created'
    ])->from(
      ['p' => 'pokemon']
    )->join(
      ['c' => 'category'], // TABLE NAME
      'c.id = p.category_id', // JOIN CONDITION
      ['category_id' => 'id', 'name', 'category_slug' => 'slug']
    )->where(
      [ 'p.id' => $pokemonId ]
    );

    $statement = $sql->prepareStatementForSqlObject($select);
    $results = $statement->execute();

    $hydrator = new AggregateHydrator();
    $hydrator->add(new PokemonHydrator());
    $hydrator->add(new CategoryHydrator());

    $resultSet = new HydratingResultSet($hydrator, new Pokemon());
    $resultSet->initialize($results);

    return ($resultSet->count() ? $resultSet->current() : null);
  }

  public function update(Pokemon $pokemon)
  {
    $sql = new \Zend\Db\Sql\Sql($this->adapter);
    $update = $sql->update('pokemon')
      ->set([
        'title'       => $pokemon->getTitle(),
        'slug'        => $pokemon->getSlug(),
        'content'     => $pokemon->getContent(),
        'category_id' => $pokemon->getCategory()->getId()
      ])->where([
        'id' => $pokemon->getId()
      ]);

      $statement = $sql->prepareStatementForSqlObject($update);
      $statement->execute();
  }

  public function delete($pokemonId)
  {
      $sql = new \Zend\Db\Sql\Sql($this->adapter);
      $delete = $sql->delete()
        ->from('pokemon')
        ->where([
          'id' => $pokemonId
        ]);

        $statement = $sql->prepareStatementForSqlObject($delete);
        $statement->execute();
  }
}
