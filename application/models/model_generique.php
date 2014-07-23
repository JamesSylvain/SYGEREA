<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Site_model
 *
 * @author CIC-1
 */

class Model_generique extends CI_Model{
    //put your code here
    function __construct() {
        parent::__construct();
    }
    
	function list_all($table){
		return $this->db->get($table);
//                return $this->conversion($q);
	}
	
	function count_all($table){
		return $this->db->count_all($table);
	}
	
	function get_paged_list($table, $limit = 10, $offset = 0,$key=''){
            if($key!=='') $this->db->order_by($key,'desc');
               return $this->db->get($table, $limit, $offset);
//               return $q;
	}
	
	function get_by_id($table,$id,$key=''){
		if($key!=='') $this->db->where($key, $id);
		return $this->db->get($table);
//                return $this->conversion($q);
	}
        
	function get_where_attrib($table, $attrib, $value){
		$this->db->where($attrib, $value);
		return $this->db->get($table);
//                return $this->conversion($q);
	}
	
	function save($table,$object){
		$this->db->insert($table, $object);
		return $this->db->insert_id();
	}
	
	function update($table, $key,$id, $object){
		$this->db->where($key, $id);
		$this->db->update($table, $object);
	}
        
	function update_Where($table, $attrib, $value, $object){
		$this->db->where($attrib, $value);
		$this->db->update($table, $object);
	}
	
	function delete($table,$key,$id){
		$this->db->where($key, $id);
		$this->db->delete($table);
	}
        
        function getEntities($req){
//           return $this->db->get($req);
             return $this->db->query($req);
//             return $this->conversion($q);
            
        }
        function getEntity($req){
			return $this->db->query($req);
            
        }
        
        function countEntities($req){
          $query = $this->db->query($req);
           return $query->num_rows();
        }
        
        function conversion($q){
            if ($q->num_rows()>0){
                    
                    foreach ($q->result() as $row){
                        $data[]=$row;
                    }
                    return $data;
                }
        }
        
        function add_geom_param($table, $longt, $lat, $id_name, $id_val){
	
		$this->db->query("UPDATE $table SET \"geom\" = ST_GeomFromText('POINT($longt $lat)', 2154) WHERE $id_name=$id_val");
	}
}

?>
