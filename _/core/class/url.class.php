<?php

class url extends base_object
{

    var $id;
    var $url;
    var $controller;
    var $template;
    var $language;
    var $queue;
    var $enabled;

    var $items;
    var $table = 'url';

    function __construct($_id = '')
    {
        if (!empty($_id)) {
            $_id = (int)$_id;
            $this->getFromId($_id);
        }
    }

    function getItem()
    {
        $item = array();
        $item['id'] = $this->id;
        $item['url'] = $this->url;
        $item['controller'] = $this->controller;
        $item['template'] = $this->template;
        $item['language'] = $this->language;
        $item['queue'] = $this->queue;
        $item['enabled'] = $this->enabled;

        return $item;
    }

    function setItem($_item)
    {
        if (!empty($_item['id'])) $this->id = @$_item['id'];
        $this->url = $_item['url'];
        $this->controller = $_item['controller'];
        $this->template = $_item['template'];
        $this->language = @$_item['language'];
        $this->queue = $_item['queue'];
        $this->enabled = $_item['enabled'];
    }

}

?>