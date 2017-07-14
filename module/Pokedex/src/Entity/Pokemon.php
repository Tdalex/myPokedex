<?php

namespace Pokedex\Entity;

class Pokemon
{
    protected $id;

    protected $title;

    protected $slug;

    protected $content;

    protected $created;

    protected $category;

    public function setId($id)
    {
      $this->id = $id;
    }

    public function getId()
    {
      return $this->id;
    }

    public function getTitle()
    {
      return $this->title;
    }

    public function setTitle($title)
    {
      $this->title = $title;
    }

    public function getSlug()
    {
      return $this->slug;
    }

    public function setSlug($slug)
    {
      $this->slug = $slug;
    }

    public function getContent()
    {
      return $this->content;
    }

    public function setContent($content)
    {
      $this->content = $content;
    }

    public function getCategory()
    {
      return $this->category;
    }

    public function setCategory($category)
    {
      $this->category = $category;
    }

    public function getCreated()
    {
      return $this->created;
    }

    public function setCreated($created)
    {
      $this->created = $created;
    }
}
