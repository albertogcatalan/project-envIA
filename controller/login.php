<?php

if ($_user->logged){
    header("Location: /");
}

if (isset($_POST['email']) and isset($_POST['password'])
    and !empty($_POST['email']) and !empty($_POST['password'])) {
    $_error_login = false;

    // REF
    $goTo = '/';
    if (!empty($_GET['ref'])) {
        $goTo = strip_tags(addslashes($_GET['ref']));
    } elseif (!empty($_SERVER['HTTP_REFERER'])) {
        $goTo = strip_tags(addslashes($_SERVER['HTTP_REFERER']));
    }

    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $user = $this->loadClass('user');
        if ($user->getFromEmailPassword($_POST['email'], $_POST['password']) > 0) {
            if ($user->isActive()) {
            	
                // Logged in
                $user->setCookie();
                header("Location: /envpanel");
                
            } else {
                // User not active
                $_error_login = true;
                $goTo = '/login/?user-disabled';
            }
        } else {
            // Error logging in
            $_error_login = true;
            $goTo = '/login/?login-error';
        }
    }

    if ($goTo == "/") $goTo = "/"; # Avoid unnecessary redirects
    header("Location: $goTo");
} else {
    $template = $twig->loadTemplate('login.twig');
	echo $template->render($this->twigVars);
}