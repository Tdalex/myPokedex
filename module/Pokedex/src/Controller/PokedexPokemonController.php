<?php

namespace Pokedex\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
use Pokedex\Entity\Pokemon;
use Pokedex\Entity\Category;
use Zend\Cache\StorageFactory;

class PokedexPokemonController extends AbstractRestfulController
{
  protected $pokedexService;
  protected $cache;

  public function __construct($pokedexService)
  {
    $this->pokedexService = $pokedexService;
    $this->cache = StorageFactory::factory([
      'adapter' => [
        'name'  => 'filesystem', // could be apc, memcache etc....
        'options' => [
          'namespace' => 'api_pokemons'
        ]
      ],
      'plugins' => [
        'exception_handler' => [
          'throw_exceptions'  => false
        ],
        'Serializer'
      ]
    ]);
  }

  public function create($data)
  {
    $pokemon = $this->setPokemon($data);

    $this->pokedexService->save($pokemon);
    return new JsonModel(['success']);
  }

  public function delete($id)
  {
    try {
      $this->pokedexService->delete($id);
      $message = 'success';
    } catch (\Exception $e) {
      $message = $e->getMessage();
    }

    return new JsonModel([$message]);
  }

  public function deleteList($data)
  {

  }

  public function get($id)
  {
    $pokemon = $this->pokedexService->findById($id);

    $result = $this->pokemonToArray($pokemon);

    return new JsonModel($result);
  }

  public function getList()
  {
    $cacheKey = 'list';
    $pokemons = $this->cache->getItem($cacheKey);

    if (is_array($pokemons) && count($pokemons)) {
      return new JsonModel($pokemons);
    }

    $pokemons = $this->pokedexService->fetchAll();

    $results = [];
    foreach ($pokemons as $pokemon) {
      $results[] = $this->pokemonToArray($pokemon);
    }
    $this->cache->setItem($cacheKey, $results);

    return new JsonModel($results);
  }

  public function update($id, $data)
  {
    $pokemon = $this->setPokemon($data);
    $pokemon->setId($id);

    $this->pokedexService->update($pokemon);
    return new JsonModel(['success']);
  }

  public function patch($id, $data)
  {
    try {
      $pokemon = $this->pokedexService->findById($id);
      if (!$pokemon) {
        throw new \Exception(sprintf("Pokemon %s not found", $id));
      }

      foreach ($data as $key => $value) {
        $setter = 'set' . ucfirst($key);
        if ($key == 'category') {
          $category = new Category();
          $category->setId($value);
          $pokemon->setCategory($category);
        } elseif (method_exists($pokemon, $setter)) {
          $pokemon->$setter($value);
        }
      }
      $this->pokedexService->update($pokemon);
    } catch (\Exception $e) {
      return new JsonModel([$e->getMessage()]);
    }

    return new JsonModel(["success"]);
  }

  protected function pokemonToArray($pokemon)
  {
      return [
        'id'        => $pokemon->getId(),
        'title'     => $pokemon->getTitle(),
        'slug'      => $pokemon->getSlug(),
        'content'   => $pokemon->getContent(),
        'created'   => $pokemon->getCreated(),
        'category'  => $pokemon->getCategory()->getName()
      ];
  }

  protected function setPokemon($data)
  {
    $pokemon = new Pokemon();
    $pokemon->setTitle($data['title']);
    $pokemon->setSlug($data['slug']);
    $pokemon->setCreated(time());
    $pokemon->setContent($data['content']);
    $category = new Category();
    $category->setId($data['category']);
    $pokemon->setCategory($category);

    return $pokemon;
  }
}
