<?php

namespace Pokedex\Entity;

class Localisation
{
    protected $id;

    protected $latitude;

    protected $longitude;

    protected $ville;

    protected $pokemon_id;

    protected $date;

    public function setId($id)
    {
      $this->id = $id;
    }

    public function getId()
    {
      return $this->id;
    }

    public function setLatitude($latitude)
    {
      $this->latitude = $latitude;
    }

    public function getLatitude()
    {
      return $this->latitude;
    }

    public function setLongitude($longitude)
    {
      $this->longitude = $longitude;
    }

    public function getLongitude()
    {
      return $this->longitude;
    }

    public function setVille($ville)
    {
      $this->ville = $ville;
    }

    public function getVille()
    {
      return $this->ville;
    }

    public function setPokemonId($pokemon_id)
    {
      $this->pokemon_id = $pokemon_id;
    }

    public function getPokemonId()
    {
      return $this->pokemon_id;
    }

    public function setDate($date)
    {
      $this->date = $date;
    }

    public function getDate()
    {
      return $this->date;
    }

    
}
