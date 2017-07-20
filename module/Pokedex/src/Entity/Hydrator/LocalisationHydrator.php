<?php

namespace Pokedex\Entity\Hydrator;

use Pokedex\Entity\Localisation;
use Zend\Hydrator\HydratorInterface;

class LocalisationHydrator implements HydratorInterface
{
  public function extract($object)
  {
      if (!$object instanceof Localisation) {
        return [];
      }
	  
      return [
        'id'          => $object->getId(),
        'latitude' => $object->getLatitude(),
        'longitude'        => $object->getLongitude(),
        'ville'    => $object->getVille(),
        'pokemon_id'       => $object->getPokemonId(),
        'date'       => $object->getDate()
      ];
  }

  public function hydrate(array $data, $object)
  {
    if (!$object instanceof Localisation) {
      return $object;
    }

    $object->setId(isset($data['id']) ? intval($data['id']) : null);
    $object->setLatitude(isset($data['latitude']) ? intval($data['latitude']) : null);
    $object->setLongitude(isset($data['longitude']) ? intval($data['longitude']) : null);
    $object->setVille(isset($data['ville']) ? $data['ville'] : null);
    $object->setPokemonId(isset($data['pokemon_id']) ? intval($data['pokemon_id']) : null);
    $object->setDate(isset($data['date']) ? $data['date'] : null);

    return $object;
  }
}
