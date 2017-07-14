<?php

namespace Pokedex;

return [
  'invokables' => [
    'Pokedex\Repository\PokemonRepository' => 'Pokedex\Repository\PokemonRepositoryImpl'
  ],
  'factories' => [
    'Pokedex\Service\PokedexService' => function(\Zend\ServiceManager\ServiceManager $sl) {
        $pokedexService = new \Pokedex\Service\PokedexServiceImpl();
        $pokedexService->setPokemonRepository($sl->get('Pokedex\Repository\PokemonRepository'));

        return $pokedexService;
    }
  ],
  // initializers are called on every instantiation
  'initializers' => [
    function (\Zend\ServiceManager\ServiceManager $sl, $instance) {
        if ($instance instanceof \Zend\Db\Adapter\AdapterAwareInterface) {
          $instance->setDbAdapter($sl->get('Zend\Db\Adapter\Adapter'));
        }
    }
  ]
];
