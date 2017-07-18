<?php

namespace Pokedex\Repository;

use Application\Repository\RepositoryInterface;
use Pokedex\Entity\Pokemon;

interface PokemonRepository extends RepositoryInterface
{
  public function save(Pokemon $pokemon);

  public function fetchAll();

  public function fetch($page);

  /**
   * @return Pokemon|null
   */
  public function find($pokemonSlug);

  /**
   * @return Pokemon|null
   */
  public function findById($pokemonId);

  public function update(Pokemon $pokemon);

  public function delete($pokemonId);

  /**
   * @return Pokemon|null
   */
  public function findEvolution($pokemonId);
}
