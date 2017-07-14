<?php

namespace Pokedex\Service;

use Pokedex\Entity\Pokemon;
use Pokedex\Service\PokedexService;

class PokedexServiceImpl implements PokedexService
{
  protected $pokemonRepository;

  public function getPokemonRepository()
  {
      return $this->pokemonRepository;
  }

  public function setPokemonRepository($pokemonRepository)
  {
    $this->pokemonRepository = $pokemonRepository;
  }

  public function save(Pokemon $pokemon)
  {
    $this->pokemonRepository->save($pokemon);
  }

  public function fetchAll()
  {
    return $this->pokemonRepository->fetchAll();
  }

  public function fetch($page)
  {
    return $this->pokemonRepository->fetch($page);
  }

  /**
   * @return Pokemon|null
   */
  public function find($categorySlug, $pokemonSlug)
  {
    return $this->pokemonRepository->find($categorySlug, $pokemonSlug);
  }

  /**
   * @return Pokemon|null
   */
  public function findById($pokemonId)
  {
    return $this->pokemonRepository->findById($pokemonId);
  }

  public function update(Pokemon $pokemon)
  {
    $this->pokemonRepository->update($pokemon);
  }

  public function delete($pokemonId)
  {
    $this->pokemonRepository->delete($pokemonId);
  }
}