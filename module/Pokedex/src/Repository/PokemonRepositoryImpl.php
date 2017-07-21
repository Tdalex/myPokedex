<?php

namespace Pokedex\Repository;

use Pokedex\Entity\Hydrator\PokemonHydrator;
use Pokedex\Entity\Hydrator\LocalisationHydrator;
use Zend\Hydrator\Aggregate\AggregateHydrator;
use Zend\Db\ResultSet\HydratingResultSet;
use Pokedex\Repository\PokemonRepository;
use Zend\Db\Adapter\AdapterAwareTrait;
use Pokedex\Entity\Pokemon;
use Pokedex\Entity\Localisation;

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
          'id_national' => $pokemon->getIdNational(),
          'name'        => $pokemon->getName(),
          'typeA'       => $pokemon->getTypeA(),
          'typeB'       => $pokemon->getTypeB(),
          'parent_id'   => $pokemon->getParentId(),
          'description' => $pokemon->getDescription()
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

  public function saveLocalisation(Localisation $localisation)
  {
    try {
          $this->adapter
            ->getDriver()
            ->getConnection()
            ->beginTransaction();

      $sql = new \Zend\Db\Sql\Sql($this->adapter);
      $insert = $sql->insert()
        ->values([
          'latitude' => $localisation->getLatitude(),
          'longitude' => $localisation->getLongitude(),
          'ville'     => $localisation->getVille(),
          'id_pokemon' => $localisation->getPokemonId(),
          'date'       => $localisation->getDate()
        ])
        ->into('lastseen');
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
      ]);

      $statement = $sql->prepareStatementForSqlObject($select);
      $result = $statement->execute();

      $hydrator = new AggregateHydrator();
      $hydrator->add(new PokemonHydrator());
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
	  $sql = new \Zend\Db\Sql\Sql($this->adapter);
	  $select = $sql->select();
	  $select->columns([
		  'id',
      'id_national',
		  'name',
		  'typeA',
		  'typeB',
		  'parent_id',
		  'description'
	  ])->from([
		'p' => 'pokemon'
	  ]);

	  $hydrator = new AggregateHydrator();
	  $hydrator->add(new PokemonHydrator());
	  $resultSet = new HydratingResultSet($hydrator, new Pokemon());

		$paginatorAdapter = new \Zend\Paginator\Adapter\DbSelect(
			$select,
			$this->adapter,
			$resultSet
		  );
		  $paginator = new \Zend\Paginator\Paginator($paginatorAdapter);
		  $paginator->setCurrentPageNumber($page);
		  $paginator->setItemCountPerPage(9);

		  return $paginator;
  }

  /**
   * @return Pokemon|null
   */
  public function find($pokemonSlug)
  {
      $sql = new \Zend\Db\Sql\Sql($this->adapter);
      $select = $sql->select();
      $select->columns([
		  'id',
      'id_national',
		  'name',
		  'typeA',
		  'typeB',
		  'parent_id',
		  'description'
      ])->from(
        ['p' => 'pokemon']
      )->where(
        ['p.name' => $pokemonSlug]
      );

      $statement = $sql->prepareStatementForSqlObject($select);
      $results = $statement->execute();

      $hydrator = new AggregateHydrator();
      $hydrator->add(new PokemonHydrator());

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
      'id_national',
	  'name',
	  'typeA',
	  'typeB',
	  'parent_id',
	  'description'
    ])->from(
      ['p' => 'pokemon']
    )->where(
      [ 'p.id' => $pokemonId ]
    );

    $statement = $sql->prepareStatementForSqlObject($select);
    $results = $statement->execute();

    $hydrator = new AggregateHydrator();
    $hydrator->add(new PokemonHydrator());

    $resultSet = new HydratingResultSet($hydrator, new Pokemon());
    $resultSet->initialize($results);

    return ($resultSet->count() ? $resultSet->current() : null);
  }

  public function update(Pokemon $pokemon)
  {
    $sql = new \Zend\Db\Sql\Sql($this->adapter);
    $update = $sql->update('pokemon')
      ->set([
      'id_national' => $pokemon->getIdNational(),
		  'name'        => $pokemon->getName(),
		  'typeA'       => $pokemon->getTypeA(),
		  'typeB'       => $pokemon->getTypeB(),
		  'parent_id'   => $pokemon->getParentId(),
		  'description' => $pokemon->getDescription()
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

  /**
   * @return Pokemon|null
   */
  public function findEvolution($pokemonId)
  {
      $sql = new \Zend\Db\Sql\Sql($this->adapter);
      $select = $sql->select();
      $select->columns([
      'id_national',
      'name',
      'typeA',
      'typeB',
      'description'
      ])->from(
        ['p' => 'pokemon']
      )->where(
        ['p.parent_id' => $pokemonId]
      );

      $statement = $sql->prepareStatementForSqlObject($select);
      $results = $statement->execute();

      $hydrator = new AggregateHydrator();
      $hydrator->add(new PokemonHydrator());

      $resultSet = new HydratingResultSet($hydrator, new Pokemon());
      $resultSet->initialize($results);
      //changer le resultset->current pour qu'il affiche tous les résultats (pour Evoli)
      return ($resultSet->count() ? $resultSet: null);
  }

  /**
   * @return Localisation|null
   */
  public function getLocalisation($pokemonId)
  {
    $sql = new \Zend\Db\Sql\Sql($this->adapter);
      $select = $sql->select();
      $select->columns([
        'ville',
        'id_pokemon',
        'date'
      ])->from(
        ['ls' => 'lastseen']
      )->where(
        ['ls.id_pokemon' => $pokemonId]
      );

      $statement = $sql->prepareStatementForSqlObject($select);
      $results = $statement->execute();

      $hydrator = new AggregateHydrator();
      $hydrator->add(new LocalisationHydrator());

      $resultSet = new HydratingResultSet($hydrator, new Localisation());
      $resultSet->initialize($results);

      $localisations = [];
      foreach ($resultSet as $loc) {
        /**
           * @var \Pokedex\Entity\Localisation $loc
           */
          $localisations[] = $loc;
      }
      return $localisations;    
  }
}
