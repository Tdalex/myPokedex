<?php

namespace Pokedex\Controller;

use Zend\Http\Response;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Pokedex\Form\Add;
use Pokedex\Form\Edit;
use Pokedex\InputFilter\AddPokemon;
use Pokedex\Entity\Pokemon;

class IndexController extends AbstractActionController
{
  protected $pokedexService;

  public function __construct($pokedexService)
  {
    $this->pokedexService = $pokedexService;
  }

  public function indexAction()
  {
      $pokemons = $this->pokedexService->fetch(
          $this->params()->fromRoute('page')
      );

      $variables = [
        'pokemons' => $pokemons
      ];

      return new ViewModel($variables);
  }

  public function addAction()
  {
    $form = new Add();

    $variables = [
      'form' => $form
    ];

    if ($this->request->isPokemon()) { // if form is submitted
        $pokedexPokemon = new Pokemon();
        $form->bind($pokedexPokemon);

        $form->setInputFilter(new AddPokemon());

        $data = $this->request->getPokemon(); // key value array
        $form->setData($data);

        if ($form->isValid()) {
          $this->pokedexService->save($pokedexPokemon);

          return $this->redirect()->toRoute('pokedex_home');
        }
    }

    return new ViewModel($variables);
  }

  public function viewPokemonAction()
  {
    $pokemon = $this->pokedexService->find(
      $this->params()->fromRoute('categorySlug'),
      $this->params()->fromRoute('pokemonSlug')
    );

    if (is_null($pokemon)) {
      $this->getResponse()->setStatusCode(Response::STATUS_CODE_404);
    }

    return new ViewModel(['pokemon' => $pokemon]);
  }

  public function deleteAction()
  {
    $this->pokedexService->delete($this->params()->fromRoute('pokemonId'));
    $this->redirect()->toRoute('pokedex_home');
  }

  public function editAction()
  {
    $form = new Edit();
    $variables = ['form' => $form];

    if ($this->request->isPokemon()) { // FORM HAS BEEN SUBMITTED
      $pokedexPokemon = new Pokemon();
      $form->bind($pokedexPokemon);
      $form->setInputFilter(new AddPokemon());
      $data = $this->request->getPokemon();
      $form->setData($data); // KEY VALUE ARRAY
      if ($form->isValid()) {
        $this->pokedexService->update($pokedexPokemon);
        return $this->redirect()->toRoute('pokedex_home');
      }
    } else {  // VIEWING POST
        $pokemon = $this->pokedexService
          ->findById(
            $this->params()->fromRoute('pokemonId')
        );
        if (is_null($pokemon)) {
          $this->getResponse()->setStatusCode(Response::STATUS_CODE_404);
        } else {
          $form->bind($pokemon);
          $form->get('slug')->setValue($pokemon->getSlug());
          $form->get('id')->setValue($pokemon->getId());
          $form->get('category_id')->setValue($pokemon->getCategory()->getId());
        }
      }
    return new ViewModel($variables);
  }
}
