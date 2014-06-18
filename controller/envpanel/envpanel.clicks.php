<?
if ($this->get_request_method() == "POST"){
	$id_con = strip_tags($this->conn->mysql_real_escape_string(@$_POST['id_condition']));
	$id_sim = strip_tags($this->conn->mysql_real_escape_string(@$_POST['id_simulation']));
	$value = strip_tags($this->conn->mysql_real_escape_string(@$_POST['value_condition']));
	$this->loadClass('simulation')->setConditionClick($id_con, $id_sim, $value);
}