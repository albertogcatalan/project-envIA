<?

// GO BACK TO YOU BELONG
if ($_user->logged) header("Location: /envpanel");

$_error_name = false;
$_error_email = false;
$_error_pass = false;

if (!empty($_POST)) {
    $fields = array(
        "name" => strip_tags($this->conn->mysql_real_escape_string(@$_POST['name'])),
        "password" => @$_POST['password'],
        "repeatPassword" => @$_POST['repeatPassword'],
        "email" => strip_tags($this->conn->mysql_real_escape_string(@$_POST['email']))
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
        $item['level'] = "user";
        $item['registered'] = time();
        $item['last_login'] = time();

        $user = new user;

        $user->setItem($item);
        $user->hashPassword();

        $user->save();
        if (@$user->id > 0) {
        
            $user->cookie();
            $user->setCookie();
                        
            header("Location: /envpanel");
        }
    }
}

$template = $twig->loadTemplate("register.twig");
echo $template->render($this->twigVars);
