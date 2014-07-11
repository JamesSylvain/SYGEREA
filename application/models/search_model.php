<?php
class Search_model extends CI_Model {
	
	private $search= 'search';
	
	function __construct(){
		parent::__construct();
	}
	
	function list_all(){
		$this->db->order_by('id','asc');
		return $this->db->get($search);
	}
	
	
	function get_paged_list($limit = 10, $offset = 0){
		$this->db->order_by('id','asc');
		return $this->db->get($this->search, $limit, $offset);
	}
	

}
?>