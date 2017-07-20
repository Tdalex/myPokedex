<?php

namespace Pokedex\Service;

use Pokedex\Entity\Pokemon;
use Pokedex\Entity\Localisation;

interface PokedexService
{
  public function save(Pokemon $pokemon);

  public function saveLocalisation(Localisation $localisation);

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

  /**
   * @return Localisation|null
   */
  public function getLocalisation($pokemonId);
}
