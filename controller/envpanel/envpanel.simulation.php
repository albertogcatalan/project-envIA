<?

if (!$_user->logged) {
    header("Location: /");
    exit;
}


// Add simulation
if (isset($_POST['add'])) {
	
	$fields = array(
        "name" => strip_tags($this->conn->mysql_real_escape_string(@$_POST['name'])),
        "short_description" => strip_tags($this->conn->mysql_real_escape_string(@$_POST['description']))
	);
         
	$sim = new simulation;
    			
	$items['name'] = $fields["name"];
	$items['short_description'] = $fields["short_description"];	 
	$items['user'] = $_user->id;  	
	$items['status'] = "launched";  
	$items['period'] = (int)$_POST['days'] * 60 * 60 * 24;
    $items['_period'] = (int)$_POST['days'];
    $items['daysCount'] = (int)$_POST['days'];  		
	$items['added'] = time();
	$items['active'] = 'y';
			
    
	foreach ($_POST['name-condition'] as $k => $v) {
        
        	$condition = $this->loadClass('simulation_condition');
        
        	if ($_POST['condition-id'][$k]){
        		$p_item['id'] = $_POST['condition-id'][$k];
            } else {
                $p_item['id'] = null;
            }
            
            $p_item['name'] = addslashes($_POST['name-condition'][$k]);
            
            $val = $this->cleanNumber($_POST['value-condition'][$k]);
            $vpc = $this->cleanNumber($_POST['vpc-condition'][$k]);
            $lUp = $this->cleanNumber($_POST['limitUp-condition'][$k]);
			$lDw = $this->cleanNumber($_POST['limitDown-condition'][$k]);
        
			if (is_numeric($val)) {
			    $p_item['value'] = (int)$val;
			}
			if (is_numeric($vpc)) {
			    $p_item['vpc'] = (int)$vpc;
			}
			if (is_numeric($lUp)) {
			    $p_item['limitUp'] = (int)$lUp;
			}
            if (is_numeric($lDw)) {
			    $p_item['limitDown'] = (int)$lDw;
			}  
			
			
			$condition->setItem($p_item);
			$items['conditions'][] = $condition;   	  	
	}
	
	$items['started'] = time();

	$sim->setItem($items); 
     
	if($sim->save()) {
		header("Location: /envpanel/simulation/list");
	}
	
	$this->addTwigVars('alertError', true);
    
}

if (isset($_POST['del'])) {
    if ($_user->isAdmin()) {
	    $sim = $this->loadClass('simulation')->getFromId($_POST['id']);
		$sim->delete();
	} 
}



switch ($this->url_var[2]) {
    case('add'):
    	$this->addTwigVars('typeAction', 'add');
	    $template = $twig->loadTemplate('envpanel/envpanel.simulation.add.twig');
    	echo $template->render($this->twigVars);
    	break;
    case('c'):
    	require "./controller/envpanel/envpanel.clicks.php";
    	break;
    case('view'):
    	// DEBUG
    	//print_r( $this->loadClass('simulation')->getFromId($this->url_var[3]));
    	//exit;
    	$this->addTwigVars('sim', $this->loadClass('simulation')->getFromId($this->url_var[3]));
	    $template = $twig->loadTemplate('envpanel/envpanel.simulation.view.twig');
    	echo $template->render($this->twigVars);
    	break;
    case('list'):
    	if ($_user->isAdmin()){
	    	$this->addTwigVars('mySimulation', $this->loadClass('simulation')->getList());
    	} else {
	    	$this->addTwigVars('mySimulation', $this->loadClass('simulation')->getList($_user->id));
    	}
	    $template = $twig->loadTemplate('envpanel/envpanel.simulation.list.twig');
    	echo $template->render($this->twigVars);
    	break;   
    default:
    	if ($_user->isAdmin()){
	    	$this->addTwigVars('mySimulation', $this->loadClass('simulation')->getList());
    	} else {
	    	$this->addTwigVars('mySimulation', $this->loadClass('simulation')->getList($_user->id));
    	}
	    $template = $twig->loadTemplate('envpanel/envpanel.simulation.list.twig');
	    echo $template->render($this->twigVars);
        break;
}






