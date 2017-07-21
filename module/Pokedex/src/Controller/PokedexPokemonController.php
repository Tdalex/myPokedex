<?php

namespace Pokedex\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
use Pokedex\Entity\Pokemon;
use Pokedex\Entity\Localisation;
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
        $pokemon->$setter($value);
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
        'id'          => $object->getId(),
        'name'        => $object->getName(),
        'typeA'       => $object->getTypeA(),
        'typeB'       => $object->getTypeB(),
        'parent_id'   => $object->getParentId(),
        'description' => $object->getDescription()
      ];
  }

  protected function setPokemon($data)
  {
    $pokemon = new Pokemon();
    $pokemon->setName($data['name']);
    $pokemon->setTypeA($data['typeA']);
    $pokemon->setTypeB($data['typeB']);
    $pokemon->setParentId($data['parentId']);
    $pokemon->setDescription($data['description']);

    return $pokemon;
  }

  public function addLocalisationAction(){
    $idPokemon = $this->params()->fromRoute('pokemonId');
    //récupérer l'ipde l'utilisateur pour avoir ses coordonnées géographiques
    //$ip  = !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
    $ip = '86.75.236.178';
    $url = "http://freegeoip.net/json/$ip";
    $ch  = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    $data = curl_exec($ch);
    curl_close($ch);

    if ($data) {
      $location = json_decode($data);

      $latitude = $location->latitude;
      $longitude = $location->longitude;
      $city = $location->city;

    }
      
    $localisation = new Localisation();
    $localisation->setLatitude($latitude);
    $localisation->setLongitude($longitude);
    $localisation->setVille($city);
    $localisation->setPokemonId($idPokemon);
    $localisation->setDate(date('Y-m-d H:i'));

    $this->pokedexService->saveLocalisation($localisation);
    return $this->redirect()->toRoute('display_pokemon', array(
		'pokemonSlug' => $this->pokedexService->findById($idPokemon)->getName(),
	));
  }
}
