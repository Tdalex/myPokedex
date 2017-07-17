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

    $name = new Element\Text('name');
    $name->setLabel('Nom');
    $name->setAttribute('class', 'form-control');

    $typeA = new Element\Select('typeA');
    $typeA->setLabel('Type 1');
    $typeA->setAttribute('class', 'form-control');
    $typeA->setValueOptions([
      null      => '',
      'Feu'     => 'Feu',
      'Eau'     => 'Eau',
      'Plante'  => 'Plante',
      'Roche'   => 'Roche',
      'Spectre' => 'Spectre',
      'Vol'     => 'Vol',
      'Foudre'  => 'Foudre',
      'Dragon'  => 'Dragon',
      'Combat'  => 'Combat',
      'Normal'  => 'Normal',
      'Sol'     => 'Sol',
      'Psy'     => 'Psy',
      'Insecte' => 'Insecte',
      'Poison'  => 'Poison',
      'Glace'   => 'Glace',
    ]);
  
    $typeB = new Element\Select('typeB');
    $typeB->setLabel('Type 2');
    $typeB->setAttribute('class', 'form-control');
    $typeB->setValueOptions([
      null      => '',
      'Feu'     => 'Feu',
      'Eau'     => 'Eau',
      'Plante'  => 'Plante',
      'Roche'   => 'Roche',
      'Spectre' => 'Spectre',
      'Vol'     => 'Vol',
      'Foudre'  => 'Foudre',
      'Dragon'  => 'Dragon',
      'Combat'  => 'Combat',
      'Normal'  => 'Normal',
      'Sol'     => 'Sol',
      'Psy'     => 'Psy',
      'Insecte' => 'Insecte',
      'Poison'  => 'Poison',
      'Glace'   => 'Glace',
    ]);
  
    $description = new Element\Textarea('description');
    $description->setLabel('Description');
    $description->setAttribute('class', 'form-control');
  
  $parentId = new Element\Text('parentId');
    $parentId->setLabel('Id parent');
    $parentId->setAttribute('class', 'form-control');
	
    $submit = new Element\Submit('submit');
    $submit->setValue('Mettre à jour le pokemon');
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
