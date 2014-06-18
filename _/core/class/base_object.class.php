<?php

class base_object {

    var $id;

    function get($key) {
        return $this->$$key;
    }

    function set($key, $value) {
        $this->$$key = $value;
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
            $this->getFromId($this->id);
        }
        return $return;
    }

    function getFromId($_id)
    {
        global $core;
        
        $_id = (int)$_id;

        $item = $core->conn->getArray("SELECT * FROM " . $this->table . " WHERE id = '$_id'");
        if (@$item) {
            $this->setItem($item[0]);
        }

        return $this;
    }
    
    function delete() {
        global $core;

        $return = false;

        if (!empty($this->id)) {
            $return = $core->conn->delete($this->id, $this->table);
        }
        
        return $return;
    }

    function getList() {
        global $core;

        $return = array();

        $items = $core->conn->getArray("SELECT id FROM " . $this->table . "");
        if (@$items)
            foreach ($items as $item) {
                $return[] = $core->loadClass($this->table)->getFromId($item['id']);
            }

        return @$return;
    }

    function setItem($_item)
    {
        foreach ($this->_fields as $field) {
            if (!empty($_item[$field]))
                $this->$field = $_item[$field];
        }
    }

    function getItem()
    {
        $item = array();
        foreach ($this->_fields as $field) {
            $item[$field] = $this->$field;
        }
        return $item;
    }

    function toArray() {
        $return = false;

        if (!empty($this->_fields)) {
            foreach ($this->_fields as $field) {
                $return[$field] = $this->$field;
            }
        }

        if (!empty($this->_fields_extra)) {
            foreach ($this->_fields_extra as $field) {
                $return[$field] = $this->$field;
            }
        }

        return $return;
    }

    function toJson() {
        $return = $this->toArray();

        return json_encode($return);
    }

    function toTwig() {
        if (method_exists($this, "twigify"))
            $return = $this->twigify();
        else
            $return = $this->toArray();

        return $return;
    }

    function format($_format) {
        switch ($_format) {
            case('json'):
                return $this->toJson();
                break;
            case('twig'):
                return $this->toTwig();
                break;
            case('array'):
                return $this->toArray();
                break;
            default:
                return $this;
                break;
        }
    }
}
