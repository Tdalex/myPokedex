<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Pokemon\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Pokemon\Model\PokemonTable;

class IndexController extends AbstractActionController
{
    protected $pokemonTable;

    public function __construct(PokemonTable $pokemonTable)
    {
        $this->pokemonTable = $pokemonTable;
    }

    public function indexAction()
    {
        return new ViewModel(array(
            'pokemons' => $this->getPokemonTable()->fetchAll(),
        ));
    }

    public function addAction()
    {
    	return new ViewModel();
    }

    public function editAction()
    {
    	return new ViewModel();
    }

    public function viewAction()
    {
    	return new ViewModel();
    }

    public function deleteAction()
    {
    	$this->redirect()->toRoute('home');
    }

    
}
