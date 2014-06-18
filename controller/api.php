<?

switch (@$this->url_var[1]) {
    case('v1'):
    	if (@$this->url_var[2] == "click"){
    	
	    	if ($this->get_request_method() == "POST"){
	    	
				$id_con = strip_tags($this->conn->mysql_real_escape_string(@$_REQUEST['idcon']));
				$id_sim = strip_tags($this->conn->mysql_real_escape_string(@$_REQUEST['idsim']));
				
				
				$insert = $this->loadClass('simulation')->setConditionClick($id_sim, $id_con);
				
				if ($insert){
					echo json_encode("OK");
				}
				
			} else {
				echo "Esto no es accesible...";
			}
    	}
    	break;
}



