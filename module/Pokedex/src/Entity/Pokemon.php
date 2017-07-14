<?php

namespace Pokedex\Entity;

class Pokemon
{
    protected $id;

    protected $name;

    protected $typeA;

    protected $typeB;

    protected $parent_id;

    protected $description;

    public function setId($id)
    {
      $this->id = $id;
    }

    public function getId()
    {
      return $this->id;
    }

    public function getName()
    {
      return $this->name;
    }

    public function setName($name)
    {
      $this->name = $name;
    }

    public function getTypeA()
    {
      return $this->typeA;
    }

    public function setTypeA($typeA)
    {
      $this->typeA = $typeA;
    }

    public function getParentId()
    {
      return $this->parent_id;
    }

    public function setParentId($parent_id)
    {
      $this->parent_id = $parent_id;
    }

    public function getDescription()
    {
      return $this->description;
    }

    public function setDescription($description)
    {
      $this->description = $description;
    }

    public function getTypeB()
    {
      return $this->typeB;
    }

    public function setTypeB($typeB)
    {
      $this->typeB = $typeB;
    }
}
