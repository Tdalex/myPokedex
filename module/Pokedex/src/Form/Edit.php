<?php

namespace Pokedex\Form;

use Pokedex\Entity\Hydrator\PokemonHydrator;
use Zend\Form\Form;
use Zend\Form\Element;
use Zend\Hydrator\Aggregate\AggregateHydrator;

class Edit extends Form
{
  public function __construct()
  {
    parent::__construct('edit');

    $hydrator = new AggregateHydrator();
    $hydrator->add(new PokemonHydrator());
    $this->setHydrator($hydrator);

    $id = new Element\Hidden('ID');

    $name = new Element\Text('Nom');
    $name->setLabel('name');
    $name->setAttribute('class', 'form-control');

    $typeA = new Element\Text('Type 1');
    $typeA->setLabel('typeA');
    $typeA->setAttribute('class', 'form-control');
    // $typeA->setValueOptions([
      // 'feu'     => 'feu',
      // 'eau'     => 'eau',
      // 'plante'  => 'plante',
      // 'roche'   => 'roche',
      // 'spectre' => 'spectre',
      // 'vol'     => 'vol',
      // 'foudre'  => 'foudre',
	  // 'dragon'  => 'dragon',
      // 'combat'  => 'combat',
      // 'normal'  => 'normal',
      // 'sol'     => 'sol',
      // 'psy'     => 'psy',
      // 'insecte' => 'insecte',
      // 'poison'  => 'poison',
      // 'glace'   => 'glace',
    // ]);
	
    $typeB = new Element\Textarea('Type 2');
    $typeB->setLabel('typeB');
    $typeB->setAttribute('class', 'form-control');
    // $typeB->setValueOptions([
      // ''        => '',
      // 'feu'     => 'feu',
      // 'eau'     => 'eau',
      // 'plante'  => 'plante',
      // 'roche'   => 'roche',
      // 'spectre' => 'spectre',
      // 'vol'     => 'vol',
      // 'foudre'  => 'foudre',
	  // 'dragon'  => 'dragon',
      // 'combat'  => 'combat',
      // 'normal'  => 'normal',
      // 'sol'     => 'sol',
      // 'psy'     => 'psy',
      // 'insecte' => 'insecte',
      // 'poison'  => 'poison',
      // 'glace'   => 'glace',
    // ]);
	
    $description = new Element\Select('Description');
    $description->setLabel('description');
    $description->setAttribute('class', 'form-control');
	
	$parentId = new Element\Select('Id parent');
    $parentId->setLabel('parentId');
    $parentId->setAttribute('class', 'form-control');
	
    $submit = new Element\Submit('Confirmer');
    $submit->setValue('Mettre a jour le pokemon');
    $submit->setAttribute('class', 'btn btn-primary');

    $this->add($id);
    $this->add($name);
    $this->add($typeA);
    $this->add($typeB);
    $this->add($description);
    $this->add($parentId);
    $this->add($submit);
  }
}
