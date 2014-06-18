<?php

class simulation extends base_object
{

    var $id;
    var $status;
    var $user;
    var $added;
    var $started;
    var $period;
    var $daysCount;
    var $active;
   
    var $name;
    var $short_description;
    
    //extras
    var $dateFinish;
   
    var $conditions; // Conditions
    var $click;
    

    // Calculated
    var $finish;
    var $remaining;
    var $author;

    var $table = 'simulation';
    var $table_condition = 'simulation_condition';
    var $table_relations = 'simulation_condition_rel';
    var $table_click = 'simulation_click';


    function getFromId($_id)
    {
        global $core;

        $item = $core->conn->getArray("SELECT * FROM " . $this->table . " WHERE id = '$_id'");
        if (@$item) {
        	
            $this->setItem($item[0]);
            // Future feature
            //$this->getMultimedia();
            $this->getCondition();
            $this->getData();
            $this->calculate();
        }
        
        
        return $this;
    }

   
    function getLastSimulation($_num = 1, $_id = 0) {
        global $core;

        $return = null;
		
		if ($_id > 0){
			$where = " WHERE user = '$_id'";
		}
		
        $items = $core->conn->getArray("SELECT id
            FROM " . $this->table . "
            $where ORDER BY started DESC LIMIT $_num");

        if (@$items) {
            foreach ($items as $item) {
                $return[] = $core->loadClass('simulation')->getFromId($item['id']);
            }
        }

        return $return;
    }

    function getFromUser($_id)
    {
        global $core;

        $return = array();
        $_id = (int)$_id;

        $items = $core->conn->getArray("SELECT id
            FROM " . $this->table . "
            WHERE user = '$_id'
            ORDER BY added DESC");

        if (@$items) {
            foreach ($items as $item) {
                $return[] = $core->loadClass('simulation')->getFromId($item['id']);
            }
        }

        return $return;
    }

    function start() {
        if (!empty($this->id) and $this->started == 0) {
            $this->started = time();
            $this->save();
        }
    }

    function calculate()
    {
        if (!empty($this->started)) {
            if ($this->period > (60 * 60 * 24 * 44))
                $this->finish = $this->started + $this->period - (60 * 60 * 3);
            else
                $this->finish = $this->started + $this->period;
            $this->remaining = $this->finish - time();
        }
    }

	// Get all conditions of simulation
    function getCondition()
    {
    	
        global $core;
        if (!empty($this->id))
            $this->conditions = $core->loadClass('simulation_condition')->getFromSimulation($this->id);
        
    }

	// Set click to condition
	function setConditionClick($_simulation, $_condition)
	{
		global $core;
		
		if (!empty($_simulation) && !empty($_condition)){
			
			$_day = $this->getDay($_simulation);
			
			//$_day = 0; 
			
					
			if ($_day >= 0){
				$return = $core->conn->doQuery("INSERT INTO simulation_click (simulation, conditions, day) VALUES ('$_simulation', '$_condition', '$_day')");
			}
			
		
		}
		
		return $return;
		
	}

	// Get day of simulation
	function getDay($_simulation)
	{
		global $core;
		
		$sim = $core->loadClass("simulation")->getFromId($_simulation);
		$finish = $sim->started + $sim->period;
		$actual = mktime(0,0,0,date('m'),date('d'),date('Y'));
		
		if ($actual < $finish){
		
			for ($i = 1; $i <= $sim->daysCount; $i++){
			
				$init = date('d-m-Y', strtotime("$init +$i day"));
				//echo "<br/>".$init;
				
				if ($init == date('d-m-Y')){
					$day = $i;
				} 
			
			}
		
		}
		
		
		
		return $day;	
	}
	
	
	// Get array with days and visits per condition
	function getClicks()
	{
		global $core;

        $return = array();
        $_id = $this->id;
        $days = null;
	
		$items = $core->conn->getArray("SELECT DISTINCT id
            FROM ".$this->table_condition." c, ".$this->table_relations." sc
			WHERE c.id = sc.conditions
			AND sc.simulation = '$_id' ");
		
		for ($d = 0; $d <= $this->daysCount-1; $d++){
			if ($d == 0){
    			$days = $d;
			} else {
    			$days = $days.",".$d;
			}
			
		}
				
        if (@$items) {
        	
        	foreach ($items as $item) {
        	
        		$con = $core->loadClass("simulation_condition")->getFromId($item['id']);
        	        	
	    		$return[$item['id']]['name'] = $con->name;
	    		$return[$item['id']]['day'] = $days;
			  	$return[$item['id']]['visits'] = $this->getVisitsOfCondition($item['id'], $con->vpc);				           
				
			}
		    
        }
       
        return $return;
		
	}
	
	// Get visits per condition
	function getVisitsOfCondition($_id, $_vpc)
	{
		
		global $core;

        $visits = null;

		for ($d = 0; $d <= $this->daysCount-1; $d++){
		
			$v = $core->conn->getResult("SELECT count(id)
				            FROM simulation_click
				            WHERE day = '$d' AND conditions = '$_id'");		            
				           
			if ($d == 0){
    			$visits = ($v * $_vpc);
			} else {
    			$visits = $visits.",".($v * $_vpc);
			}
			
		}
		
		return $visits;
				
	}
    
    // Get name of condition
    function getNameOfCondition($_id)
    {
	    global $core;

        $item = $core->conn->getResult("SELECT name
            FROM " . $this->table_condition . "
            WHERE id = '$_id'
            ");
            
        return $item;
			
    }
   
    function getData()
    {
        global $core;

        if (!empty($this->id)) {
            $this->author = $core->loadClass("user")->getFromId($this->user);
            $this->dateFinish = $this->f_finish();
            $this->click = $this->getClicks();
        }
    }

    public function save()
    {
        global $core;

        $item = $this->getItem();

        if (!empty($this->id)) {
            // UPDATE
            $return = $core->conn->update($item, $this->table, "id = '" . $this->id . "'");
            $this->saveAll();
        } else {
            // INSERT
            $return = $core->conn->insert($item, $this->table);
            $this->id = $core->conn->getLastId();
            $this->saveAll();
        }
        return $return;
    }

  
  

    function saveAll()
    {
        global $core;

        // Conditions
        if (!empty($this->conditions)) {
            foreach ($this->conditions as $item) {
                $condition = $core->loadClass('simulation_condition');
                $condition->setItem((array)$item);
                $condition->save();
                $this->setRelation("condition", $condition->id);
            }
        }

	}

    function setRelation($_type, $_id)
    {
        global $core;

        if (!empty($this->id))
            $core->loadClass("simulation_" . $_type)->setRelation($this->id, $_id);
    }

      
    function formatDate($_time)
    {
        if (!empty($_time))
            $return = date("d-m-Y H:i:s", $_time);
        else
            $return = '--';
        return $return;
    }

    function daysLeft($_time)
    {
        if (empty($_time)) $return = '--';

        $remaining = floor($_time / 60 / 60 / 24);

        if ($remaining < 1)
            $return = $this->timeLeft($_time);
        else
            $return = $remaining . "";

        return $return;
    }

    function timeLeft($_time)
    {
        global $_lang;

        if (empty($_time)) return '--';

        if ($_time < 0) return 0;

        // TODO improve this function, less if more while
        if (!empty($_time) && is_int($_time)) {
            $seconds = $_time;
            if ($seconds / 60 >= 1) {
                $minutes = floor($seconds / 60);
                if ($minutes / 60 >= 1) { # Hours
                    $hours = floor($minutes / 60);
                    if ($hours / 24 >= 1) { #days
                        $days = floor($hours / 24);
                        if ($days / 30 >= 1) { #months
                            $months = floor($days / 30);
                            $return = "$months" . "m";
                        } #end of weeks
                        $days = $days - (floor($days / 30)) * 30;
                        if (@$months >= 1 && $days >= 1) $return = "$return ";
                        $return = @$return . " " . $days . "d";
                    } #end of days
                    $hours = $hours - (floor($hours / 24)) * 24;
                    if (@$days >= 1 && $hours >= 1) $return = "$return ";
                    $return = @$return . " $hours" . "h";
                } #end of Hours
                $minutes = $minutes - (floor($minutes / 60)) * 60;
                if ((@$hours < 3 && @$days == 0) && $minutes >= 1) $return = @$return . " $minutes" . "m";
            } #end of minutes
            $seconds = $_time - (floor($_time / 60)) * 60;
            if (@$minutes >= 1 && $seconds >= 1) $return = @$return . " ";
            //$return = "$return $seconds" . "s";
            $return = @$return . "";
            return @$return;
        }
    }

    function getList($_id = 0)
    {
        global $core;

        $return = array();
        $where = '';

        if ($_id > 0)
            $where = " WHERE user = '$_id'";

        $items = $core->conn->getArray("SELECT id FROM " . $this->table . " $where");
        
        
        if (@$items)
            foreach ($items as $item) {
                $return[] = $core->loadClass($this->table)->getFromId($item['id']);
            }

        return @$return;
    }


    function getItem()
    {
        $item = array();
        $item['id'] = $this->id;
        $item['name'] = $this->name;
        $item['short_description'] = $this->short_description;
        $item['status'] = $this->status;
        $item['user'] = $this->user;
        $item['added'] = $this->added;
        $item['started'] = $this->started;
        $item['period'] = $this->period;
        $item['daysCount'] = $this->daysCount;
        $item['active'] = $this->active;
        

        return $item;
    }

    function setItem($_item)
    {
        if (!empty($_item['id'])) $this->id = $_item['id'];
        if (!empty($_item['status'])) $this->status = @$_item['status'];
        if (!empty($_item['user'])) $this->user = $_item['user'];
        if (@$_item['added']) $this->added = $_item['added'];
        if (!empty($_item['started'])) $this->started = $_item['started'];
        if (!empty($_item['active'])) $this->active = $_item['active'];
        if (!empty($_item['period'])) $this->period = $_item['period'];
        if (!empty($_item['daysCount'])) $this->daysCount = $_item['daysCount'];
        if (@$_item['name']) $this->name = $_item['name'];
        if (@$_item['short_description']) $this->short_description = $_item['short_description'];
        if (@$_item['conditions']) {
            $this->conditions = $_item['conditions'];
        }

       

    }

  
    function delete()
    {
        global $core;

        $return = false;

        if (!empty($this->id)) {

            if (@$this->conditions) foreach ($this->conditions as $i) {
                $i->delete();
            }

            $return = $core->conn->delete($this->id, $this->table);
        }

        return $return;
    }

        
    function isOwnProject()
    {
        global $_user;

        return ($this->user == $_user->id);
    }
    
    /*
     * Finish Simulations
     */

    function finishSimulations()
    {
        $simulations = $this->getFinishedSimulations();
        if (@$simulations)
            foreach ($simulations as $p) {
                $p->finishSimulation();
            }
    }

    function getFinishedSimulations()
    {
        global $core;

        $return = array();

        $items = $core->conn->getArray("SELECT *
            FROM simulation
            WHERE status = 'launched'
                AND started > 0
                AND (simulation.started + (simulation.period - (60*60*2))) < UNIX_TIMESTAMP()");
        if (@$items)
            foreach ($items as $item) {
                $return[] = $core->loadClass($this->table)->getFromId($item['id']);
            }

        return @$return;
    }
    
        
    function finishSimulation()
    {
        global $core;
        
        if (!empty($this->id)) {
	        $this->status = "completed";
			$this->active = "n";
	        $this->save();
	    }
         
    }

    function getDaysRemaining()
    {
        if (!empty($this->remaining)) {
            return $this->timeLeft($this->remaining);
        } else {
            return '--';
        }
    }

    function f_finish(){
	    
	    
	    $f = ($this->started / 60 / 60 / 24)-1;
	    
	    $finish = ($f * 60 * 60 * 24); 
	    
	    return $this->period + $finish;
	    
	    
    }
    
}
