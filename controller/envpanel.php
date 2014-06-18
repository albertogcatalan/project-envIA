<?

if (!$_user->logged) {
    header("Location: /login");
    exit;
}

if ($_user->isAdmin()){
	$this->addTwigVars('lastSimulations', $this->loadClass("simulation")->getLastSimulation(10));	
} else {
	$this->addTwigVars('lastSimulations', $this->loadClass("simulation")->getLastSimulation(10, $_user->id));
}


switch (@$this->url_var[1]) {
    case('simulation'):
    	$this->addTwigVars('section', $this->url_var[2]);
        require "./controller/envpanel/envpanel.simulation.php";
    	break;
    case('user'):
    	$this->addTwigVars('section', $this->url_var[2]);
    	require "./controller/envpanel/envpanel.user.php";
    	break;
    default:	
    	$template = $twig->loadTemplate('envpanel/main.twig');
    	echo $template->render($this->twigVars);
        break;
}



