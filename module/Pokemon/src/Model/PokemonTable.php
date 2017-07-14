<?php

namespace Pokemon\Model;
use Zend\Db\TableGateway\AbstractTableGateway,
    Zend\Db\Adapter\Adapter,
    Zend\Db\ResultSet\ResultSet;

class PokemonTable extends AbstractTableGateway
{
	protected $table ='mypokedex';
    protected $tableName ='mypokedex';
    
    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet(new Pokemon);
        $this->initialize();
    }
    
    public function fetchAll()
    {
        $resultSet = $this->select();
        return $resultSet;
    }
    
    public function getPokemon($id)
    {
        $id = (int) $id;
        $rowset = $this->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }
    
    public function savePokemon(Pokemon $pokemon)
    {
        $data = array(
            'Name' => $pokemon->name,
            'Type1' => $pokemon->type1,
            'Type2' => $pokemon->type2,
            'Parent_id' => $pokemon->parentId,
            'Description' => $pokemon->description,
        );
        $id = (int)$pokemon->id;
        
        if ($id == 0) {
            $this->insert($data);
        } else {
            if ($this->getPokemon($id)) {
                $this->update($data, array('id' => $id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }
    
    public function addPokemon($name, $type1, $type2, $parentId, $description)
    {
        $data = array(
            'Name' => $name,
            'Type1' => $type1,
            'Type2' => $type2,
            'Parent_id' => $parentId,
            'Description' => $description,
        );
        $this->insert($data);
    }
    
    public function updatePokemon($id, $name, $type1, $type2, $parentId, $description)
    {
        $data = array(
            'Name' => $name,
            'Type1' => $type1,
            'Type2' => $type2,
            'Parent_id' => $parentId,
            'Description' => $description,
        );
        $this->update($data, array('id' => $id));
    }
    
    public function deletePokemon($id)
    {
        $this->delete(array('id' => $id));
    }
    
}