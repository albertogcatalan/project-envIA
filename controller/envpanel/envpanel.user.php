<?
if (!$_user->isAdmin()) {
    header("Location: /");
    exit;
} 

if (!$_user->logged) {
    header("Location: /");
    exit;
}
    
if (isset($_POST['add'])) {
   
     $fields = array(
        "name" => strip_tags($this->conn->mysql_real_escape_string(@$_POST['name'])),
        "password" => @$_POST['password'],
        "repeatPassword" => @$_POST['repeatPassword'],
        "email" => strip_tags($this->conn->mysql_real_escape_string(@$_POST['email'])),
        "level" => strip_tags($this->conn->mysql_real_escape_string(@$_POST['level']))
         );
    
    // Checking fields
    if (empty($fields['name'])) {
        $_error_name = true;
    }
    if (empty($fields['password'])) {
        $_error_pass = true;
    }
    if (empty($fields['repeatPassword'])) {
        $_error_pass = true;
    }
    if (empty($fields['email'])) {
        $_error_email = true;
    }


    // Checking if mail already registered
    if ($this->loadClass('user')->isEmailRegistered($fields['email'])) {
        $_error_mail = true;
    }

    // Checking passwords
    if ($fields['password'] != $fields['repeatPassword']) {
        $_error_pass = true;
    }

	// Check errors
    if ($_error_name) {
        $this->addTwigVars('nameError', $_error_name);
    } else if ($_error_mail) {
    	$this->addTwigVars('mailError', $_error_mail);
    } else if ($_error_pass) {
    	$this->addTwigVars('passError', $_error_pass);
    } else {
    	// Create user
        $item['active'] = "y";
        $item['name'] = $fields['name'];
        $item['plainPassword'] = $fields['password'];
        $item['email'] = $fields['email'];
        $item['level'] = $fields['level'];
        $item['registered'] = time();

        $user = new user;

        $user->setItem($item);
        $user->hashPassword();

        $user->save();
        if (@$user->id > 0) {                  
            header("Location: /envpanel/user/list");
        }
    }
  
}


if (isset($_POST['edit'])) {

    $fields = array(
        "name" => strip_tags($this->conn->mysql_real_escape_string(@$_POST['name'])),
        "password" => @$_POST['password'],
        "repeatPassword" => @$_POST['repeatPassword'],
        "email" => strip_tags($this->conn->mysql_real_escape_string(@$_POST['email'])),
        "level" => strip_tags($this->conn->mysql_real_escape_string(@$_POST['level'])),
        "active" => strip_tags($this->conn->mysql_real_escape_string(@$_POST['active']))
         );
    
    // Checking fields
    if (empty($fields['name'])) {
        $_error_name = true;
    }
    if (empty($fields['email'])) {
        $_error_email = true;
    }

    // Checking if mail already registered
    if ($this->loadClass('user')->isEmailRegistered($fields['email'], true)) {
        $_error_mail = true;
    }

    // Checking passwords
    if ($fields['password'] != $fields['repeatPassword']) {
        $_error_pass = true;
    }

	// Check errors
    if ($_error_name) {
        $this->addTwigVars('nameError', $_error_name);
    } else if ($_error_mail) {
    	$this->addTwigVars('mailError', $_error_mail);
    } else if ($_error_pass) {
    	$this->addTwigVars('passError', $_error_pass);
    } else {
    	// Edit user
    	if ($_POST['active']){
	    	$item['active'] = "y";
    	} else {
	    	$item['active'] = "n";
    	}
        
        $item['name'] = $fields['name'];
        
        if ($fields['password'] && $fields['repeatPassword']){
	    	$item['plainPassword'] = $fields['password'];
        }
        
        $item['email'] = $fields['email'];
        $item['level'] = $fields['level'];
        $item['registered'] = time();

        $user = $this->loadClass("user")->getFromId($_POST['userID']);

        $user->setItem($item);
        
        if ($fields['password'] && $fields['repeatPassword']){
	    	$user->hashPassword();
        }
        

        $user->save();
        if (@$user->id > 0) {                  
            header("Location: /envpanel/user/list");
        }
    }


}

if (isset($_POST['del'])) {
    if ($_user->isAdmin()) {
	    $userDel = $this->loadClass('user')->getFromId($_POST['id']);
		$userDel->delete();
	} 
}


switch ($this->url_var[2]) {

    case('add'):
    	$this->addTwigVars('typeAction', 'add');
	    $template = $twig->loadTemplate('envpanel/envpanel.user.add.twig');
    	echo $template->render($this->twigVars);
    	break;
    case('list'):
    	$this->addTwigVars('myUsers', $this->loadClass("user")->getListUsers());
	    $template = $twig->loadTemplate('envpanel/envpanel.user.list.twig');
    	echo $template->render($this->twigVars);
    	break;
    case('edit'):
   	 	$this->addTwigVars('typeAction', 'edit');
   	 	$this->addTwigVars('u', $this->loadClass("user")->getFromId($this->url_var[3]));
   	 	$template = $twig->loadTemplate('envpanel/envpanel.user.add.twig');
    	echo $template->render($this->twigVars);
   	 	break;
    default:
    	$this->addTwigVars('myUsers', $this->loadClass("user")->getListUsers());
	    $template = $twig->loadTemplate('envpanel/envpanel.user.list.twig');
	    echo $template->render($this->twigVars);
        break;
}

