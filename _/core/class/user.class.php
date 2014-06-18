<?php

class user extends base_object
{
    var $id;
    var $active;
    var $level;
    var $email;
    var $password;
    var $plainPassword;
    var $name;
    var $surname;
    var $type;
    var $phone;
    var $id_number;
    var $avatar;
    var $address;
    var $city;
    var $timezone;
    var $biography;

    var $registered;
    var $last_login;
    var $last_activity;

    var $cookie = '';
    var $logged = false;
    
    
    var $table = 'user';

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

    function getFromId($_id)
    {
        global $core;
        
        $sql = "SELECT * FROM " . $this->table . " WHERE id = '$_id'";

        $item = $core->conn->getArray($sql);
        if (@$item) {
            $this->setItem($item[0]);
        }

        return $this;
    }

    function cookie()
    {
        if (empty($this->cookie) && !empty($this->id)) {
            $this->cookie = sha1($this->password . md5($this->id));
        }
        return $this->cookie;
    }
    
    function getFromEmail($_email)
    {
        global $core;
        $this->email = $core->conn->mysql_real_escape_string($_email);
        
        $id = $core->conn->getResult("
            SELECT id
            FROM " . $this->table . "
                WHERE email = '" . $this->email . "'");

        if ($id > 0) {
            $return = $this->getFromId($id);
        } else {
            $return = false;
        }

        return $return;
    }
	
    
    function getFromEmailPassword($_email, $_password)
    {
        global $core;
        $this->email = $core->conn->mysql_real_escape_string($_email);
        //$this->plainPassword = $_password;
        $this->password = sha1(md5($_password));

        $id = $core->conn->getResult("
            SELECT id
            FROM " . $this->table . "
                WHERE email = '" . $this->email . "'
                    AND password  = '" . $this->password . "'");

        if ($id > 0) {
            $this->getFromId($id);
            $this->cookie();
            $this->logged = true;
            $this->updateLastLogin();
            $return = $this->id;
        } else {
            $return = false;
        }

        return $return;
    }

    function getFromCookie($_cookie)
    {
        global $core;

        $this->cookie = substr($core->conn->mysql_real_escape_string($_cookie), 0, 40);

        $id = $core->conn->getResult("
            SELECT id
            FROM " . $this->table . "
                WHERE SHA1(CONCAT(password, MD5(id))) = '" . $this->cookie . "'");

        if ($id > 0) {
            $this->getFromId($id);
            if (!$this->isActive())
                $this->unsetCookie();
            else
                $this->logged = true;
            $return = $this->id;
            $this->updateLastActivity();
        } else {
            $this->unsetCookie();
            $return = false;
        }

        return $return;
    }

    function updateLastActivity() {
        if ($this->id > 0) {
            $this->last_activity = time();
            $this->save();
        }
    }

    function updateLastLogin() {
        if ($this->id > 0) {
            $this->last_login = time();
            $this->save();
        }
    }

    function hashPassword()
    {
        if (!empty($this->plainPassword)) {
            $this->password = sha1(md5($this->plainPassword));
            $this->plainPassword = '';
        }
    }

    function isActive($_sql = false) {
        if ($_sql)
            $return = " (active = 'y') ";
        else
            $return = ($this->active == "y");
        return $return;
    }

    function isAdmin()
    {
        return ($this->level == "admin");
    }
    
    function getListUsers(){
	    global $core;
	    
        $items = $core->conn->getArray("SELECT DISTINCT id, name, email, surname
	        			FROM user
						ORDER BY registered DESC");
						
						
												
	        if (@$items){
	            foreach ($items as $item) {
	            
		            $return[$item['id']]['id'] = $item['id'];
	                $return[$item['id']]['name'] = $item['name'];
	                $return[$item['id']]['email'] = $item['email'];
	                $return[$item['id']]['surname'] = $item['surname'];
	                	             
	                
	            }
	        
	         }
	        	$returnOK = @$return;
	        
	    
        
        return $returnOK; 
    }

     function isNewInstall()
    {
        if ($this->password == sha1(md5("1234panel"))) {
            $return = true;
        } else {
            $return = false;
        }

        return $return;
    }

    function setCookie($_cookie = '')
    {
        global $_config;

        if (!empty($_cookie)) $this->cookie = $_cookie;
        if (!empty($this->cookie)) {
            setCookie($_config['cookie_name'] . "_log", $this->cookie, time() + 60 * 60 * 24 * 30, $_config['cookie_path'], $_config['cookie_domain']);
            
        }
    }

    function unsetCookie()
    {       
        global $_config;
        
        setCookie($_config['cookie_name'] . "_log", "", time()-1, $_config['cookie_path'], $_config['cookie_domain']);
        setCookie("PHPSESSID", "", time()-1, $_config['cookie_path']);
	  
	    $this->logged = false;

    }

    function getItem()
    {
        $item = array();
        $item['id'] = $this->id;
        $item['active'] = $this->active;
        $item['level'] = $this->level;
        $item['email'] = $this->email;
        $item['password'] = $this->password;
        $item['name'] = $this->name;
        $item['surname'] = $this->surname;
        $item['type'] = $this->type;
        $item['id_number'] = $this->id_number;
        $item['phone'] = $this->phone;
        $item['avatar'] = $this->avatar;
        $item['address'] = $this->address;
        $item['city'] = $this->city;
        $item['timezone'] = @$this->timezone;
        $item['biography'] = $this->biography;
        $item['registered'] = $this->registered;
        $item['last_login'] = $this->last_login;
        $item['last_activity'] = $this->last_activity;

        return $item;
    }

    function setItem($_item)
    {
        if (!empty($_item['id'])) $this->id = @$_item['id'];
        if (!empty($_item['active'])) $this->active = @$_item['active'];
        if (!empty($_item['level'])) $this->level = @$_item['level'];
        if (!empty($_item['email'])) $this->email = $_item['email'];
        if (!empty($_item['password'])) $this->password = @$_item['password'];
        if (!empty($_item['plainPassword'])) $this->plainPassword = @$_item['plainPassword'];
        if (!empty($_item['name'])) $this->name = $_item['name'];
        if (!empty($_item['surname'])) $this->surname = $_item['surname'];
        if (!empty($_item['type'])) $this->type = $_item['type'];
        if (!empty($_item['id_number'])) $this->id_number = $_item['id_number'];
        if (!empty($_item['phone']))$this->phone = $_item['phone'];
        if (!empty($_item['avatar'])) $this->avatar = $_item['avatar'];
        if (!empty($_item['address'])) $this->address = $_item['address'];
        if (!empty($_item['city'])) $this->city = $_item['city'];
        if (!empty($_item['timezone'])) $this->timezone = @$_item['timezone'];
        if (!empty($_item['biography'])) $this->biography = $_item['biography'];
        if (!empty($_item['registered'])) $this->registered = $_item['registered'];
        if (!empty($_item['last_login'])) $this->last_login = $_item['last_login'];
        if (!empty($_item['last_activity'])) $this->last_activity = $_item['last_activity'];
        
        
    }

    function isEmailRegistered($_email, $_id = 0) {
        global $core;

        $_email = $core->conn->mysql_real_escape_string($_email);

		if ($_id > 0){
			$where = " AND id <> '$_id";
		}

        $item = $core->conn->getResult("SELECT id
            FROM " . $this->table . "
            WHERE email = '$_email' $where");
        if (@$item) {
            $return = true;
        } else {
            $return = false;
        }

        return $return;
    }
    	

  
}

?>
