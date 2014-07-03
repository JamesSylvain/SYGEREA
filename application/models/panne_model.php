<?php
class Panne_model extends CI_Model {
	
	private $panne = 'pannes';
	
	function __construct(){
		parent::__construct();
	}
	
	function list_all(){
		$this->db->order_by('code_panne','asc');
		return $this->db->get($panne);
	}
	
	function count_all(){
		return $this->db->count_all($this->panne);
	}
	
	function get_paged_list($limit = 10, $offset = 0){
		$this->db->order_by('code_panne','asc');
		return $this->db->get($this->panne, $limit, $offset);
	}
	
	function get_by_code_panne($code_panne){
		$this->db->where('code_panne', $code_panne);
		return $this->db->get($this->panne);
	}
	
	function save($panne){
		$this->db->insert($this->panne, $panne);
		return $this->db->insert_id();
	}
	
	function update($code_panne, $panne){
		$this->db->where('code_panne', $code_panne);
		$this->db->update($this->panne, $panne);
	}
	
	function delete($code_panne){
		$this->db->where('code_panne', $code_panne);
		$this->db->delete($this->panne);
	}
}
?>