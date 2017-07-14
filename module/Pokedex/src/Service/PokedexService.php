<?php

namespace Pokedex\Service;

use Pokedex\Entity\Pokemon;

interface PokedexService
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
}
