<?php

namespace Pokedex\Controller;

use Interop\Container\ContainerInterface;

class PokedexPokemonControllerFactory
{
  public function __invoke(ContainerInterface $container)
  {
    return new PokedexPokemonController($container->get('Pokedex\Service\PokedexService'));
  }
}
