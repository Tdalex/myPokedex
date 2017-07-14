<?php

namespace Pokedex\Entity\Hydrator;

use Pokedex\Entity\Pokemon;
use Zend\Hydrator\HydratorInterface;

class PokemonHydrator implements HydratorInterface
{
  public function extract($object)
  {
      if (!$object instanceof Pokemon) {
        return [];
      }
	  
      return [
        'id'          => $object->getId(),
        'name'        => $object->getName(),
        'typeA'       => $object->getTypeA(),
        'typeB'       => $object->getTypeB(),
        'parent_id'   => $object->getParentId(),
        'description' => $object->getDescription()
      ];
  }

  public function hydrate(array $data, $object)
  {
    if (!$object instanceof Pokemon) {
      return $object;
    }

    $object->setId(isset($data['id']) ? intval($data['id']) : null);
    $object->setName(isset($data['name']) ? $data['name'] : null);
    $object->setTypeA(isset($data['typeA']) ? $data['typeA'] : null);
    $object->setTypeB(isset($data['typeB']) ? $data['typeB'] : null);
    $object->setParentId(isset($data['parent_id']) ? intval($data['parent_id']) : null);
    $object->setDescription(isset($data['description']) ? intval($data['description']) : null);

    return $object;
  }
}
