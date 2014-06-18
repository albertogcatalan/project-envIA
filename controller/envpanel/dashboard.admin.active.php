<?
if (!$_user->isAdmin()) {
    header("Location: /");
    exit;
} 

if (!$_user->logged) {
    header("Location: /");
    exit;
}


/* PAGINATION */



$pag = $this->url_var[3];

if ($pag){
	$pag = $pag-1;
	$pagSQL = $pag*5;
} else {
	$pag = 0;
	$pagSQL = 0;
}


$pagLimit = ceil($getDashboardActiveCountALL/5);

$this->addTwigVars('pag', $pag+1);
$this->addTwigVars('pagLimit', $pagLimit);
		
$myProjects = $this->loadClass("project")->getCampaingsAdmin($pagSQL);
$this->addTwigVars('myProjects', $myProjects);


if ($pagLimit > 1){
	for ($p = 1;$p <= $pagLimit;$p++){
	
		$arrayPag[$p]['n'] = $p;
					
		if ($pag == 0){
			$arrayPag[1]['s'] = "active";
		} else if ($p == $pag+1){
			$arrayPag[$p]['s'] = "active";
		}		
					
	}
	
}

$this->addTwigVars('pagNum', $arrayPag);



$template = $twig->loadTemplate('dashboard-admin-active.twig');
echo $template->render($this->twigVars);




