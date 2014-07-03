<?php
class Person_model extends CI_Model {
	
	private $personne= 'personne';
	
	function __construct(){
		parent::__construct();
	}
	
	function list_all(){
		$this->db->order_by('id','asc');
		return $this->db->get($personne);
	}
	
	function count_all(){
		return $this->db->count_all($this->personne);
	}
	
	function get_paged_list($limit = 10, $offset = 0){
		$this->db->order_by('id','asc');
		return $this->db->get($this->personne, $limit, $offset);
	}
	
	function get_by_id($id){
		$this->db->where('id', $id);
		return $this->db->get($this->personne);
	}
	
	function save($personne){
		$this->db->insert($this->personne, $personne);
		return $this->db->insert_id();
	}
	
	function update($id, $personne){
		$this->db->where('id', $id);
		$this->db->update($this->personne, $personne);
	}
	
	function delete($id){
		$this->db->where('id', $id);
		$this->db->delete($this->personne);
	}
}
?>