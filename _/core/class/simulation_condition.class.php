<?php

class simulation_condition extends base_object
{

    var $id;
    var $name;
    var $value;
    var $vpc;
    var $limitUp;
    var $limitDown;

    var $table = 'simulation_condition';
    var $table_relations = 'simulation_condition_rel';

    function getFromId($_id)
    {
        global $core;

        $item = $core->conn->getArray("SELECT * FROM " . $this->table . " WHERE id = '$_id'");
        if (@$item) {
            $this->setItem($item[0]);
        }
        
        return $this;
    }

    
    public function save()
    {
        global $core;

        $item = $this->getItem();

        if (!empty($this->id)) {
            // UPDATE
            $return = $core->conn->update($item, $this->table, "id = '" . $this->id . "'");
           
        } else {
            // INSERT
            $return = $core->conn->insert($item, $this->table);
            $this->id = $core->conn->getLastId();
            
        }
        return $return;
    }


    function getFromSimulation($_project) {
        global $core;

        $return = array();

        $items = $core->conn->getArray("SELECT *
            FROM " . $this->table_relations . "
                INNER JOIN " . $this->table . " ON " . $this->table . ".id = " . $this->table_relations . ".conditions
            WHERE simulation = '$_project'
            ORDER BY " . $this->table . ".value ASC");
            
       
         
        if (@$items) foreach ($items as $item) {
            $condition = $core->loadClass($this->table)->getFromId($item['id']);
            $return[] = $condition;
        }
          
        return $return;
    }

       

    function checkRelation($_project, $_id) {
        global $core;

        return $core->conn->getNumRows("SELECT * FROM " . $this->table_relations . "
            WHERE simulation = '$_project' AND conditions = '$_id'") > 0;
    }

    function setRelation($_project, $_id) {
        global $core;

        if (!$this->checkRelation($_project, $_id)) {
            $relation['simulation'] = $_project;
            $relation['conditions'] = $_id;
            return $core->conn->insert($relation, $this->table_relations);
        }
    }

    function getItem()
    {
        $item = array();
        $item['id'] = $this->id;
        $item['name'] = $this->name;
        $item['value'] = $this->value;
        $item['vpc'] = $this->vpc;
        $item['limitUp'] = $this->limitUp;
        $item['limitDown'] = $this->limitDown;
        
        return $item;
    }

    function setItem($_item)
    {
        if (!empty($_item['id'])) $this->id = $_item['id'];
		$this->name = @$_item['name'];
        $this->value = $_item['value'];
        $this->vpc = @$_item['vpc'];
        $this->limitUp = @$_item['limitUp'];        
        $this->limitDown = @$_item['limitDown'];

    }

    function delete() {
        global $core;

        $return = false;

        if (!empty($this->id)) {
            $core->conn->doQuery("DELETE FROM " . $this->table_relations . "
                WHERE conditions = '" . $this->id . "'");
            $return = $core->conn->delete($this->id, $this->table);
        }

        return $return;
    }
}
