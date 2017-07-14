<?php

namespace Pokedex\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Pokedex\Entity\Hydrator\PokemonHydrator;
use Pokedex\Entity\Hydrator\CategoryHydrator;
use Zend\Hydrator\Aggregate\AggregateHydrator;

class Add extends Form
{
  public function __construct()
  {
    parent::__construct('add');

    $hydrator = new AggregateHydrator();
    $hydrator->add(new PokemonHydrator());
    $hydrator->add(new CategoryHydrator());

    $this->setHydrator($hydrator);

    $title = new Element\Text('title');
    $title->setLabel('Title');
    $title->setAttribute('class', 'form-control');

    $slug = new Element\Text('slug');
    $slug->setLabel('Slug');
    $slug->setAttribute('class', 'form-control');

    $content = new Element\Textarea('content');
    $content->setLabel('Content');
    $content->setAttribute('class', 'form-control');

    $category = new Element\Select('category_id');
    $category->setLabel('Category');
    $category->setAttribute('class', 'form-control');
    $category->setValueOptions([
      1 => 'Zend Framework',
      2 => 'Symfony',
      3 => 'React'
    ]);

    $submit = new Element\Submit('submit');
    $submit->setValue('Add pokemon');
    $submit->setAttribute('class', 'btn btn-primary');

    $this->add($title);
    $this->add($slug);
    $this->add($content);
    $this->add($category);
    $this->add($submit);
  }
}
