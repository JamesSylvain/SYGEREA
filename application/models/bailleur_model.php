<?php
class Bailleur_model extends CI_Model {
	
	private $bailleur = 'bailleur';
	private $financer = 'financer';
	private $projet = 'projet';
	
	function __construct(){
		parent::__construct();
	}
	
	function list_all(){
		$this->db->order_by('code_bailleur','asc');
		return $this->db->get($bailleur);
	}
	
	function count_all(){
		return $this->db->count_all($this->bailleur);
	}	
	
	function count_all_finance(){
		return $this->db->count_all($this->financer);
	}
	
	function get_paged_list($limit = 10, $offset = 0){
		$this->db->order_by('code_bailleur','asc');
		return $this->db->get($this->bailleur, $limit, $offset);
	}	
	
	function get_paged_list_finance($limit = 10, $offset = 0){
	
		$this->db->select('financer.*, bailleur.denomination as nom_bailleur, bailleur.type_bailleur as type_bailleur, projet.libelle_du_projet as nom_projet');
		$this->db->from('bailleur, financer, projet');
		$this->db->where('bailleur.code_bailleur = financer.code_bailleur and projet.code_projet = financer.code_projet');
		$this->db->limit($limit, $offset);
		$this->db->order_by('annee_financement','desc');
		return $this->db->get();
	}
	
	function get_by_code_bailleur($code_bailleur){
		$this->db->where('code_bailleur', $code_bailleur);
		return $this->db->get($this->bailleur);
	}	
	
	function get_by_code_finance($code_finance){
	
		$this->db->select('financer.*, bailleur.denomination as nom_bailleur, bailleur.type_bailleur as type_bailleur, projet.libelle_du_projet as nom_projet');
		$this->db->from('bailleur, financer, projet');
		$this->db->where('bailleur.code_bailleur = financer.code_bailleur and projet.code_projet = financer.code_projet');
		$this->db->where('code_finance', $code_finance);
		return $this->db->get();
	}
	
	function save($bailleur){
		$this->db->insert($this->bailleur, $bailleur);
		return $this->db->insert_id();
	}	
	
	function save_finance($finance){
		$this->db->insert($this->financer, $finance);
		return $this->db->insert_id();
	}
	function verify_finance($code_bailleur, $code_projet){
		$this->db->where('code_bailleur', $code_bailleur);
		$this->db->where('code_projet', $code_projet);
		return $this->db->get($this->financer);
	}
	
	function update($code_bailleur, $bailleur){
		$this->db->where('code_bailleur', $code_bailleur);
		$this->db->update($this->bailleur, $bailleur);
	}	
	
	function update_finance($code_finance, $finance){
		$this->db->where('code_finance', $code_finance);
		$this->db->update($this->financer, $finance);
	}
	
	function delete($code_bailleur){
		$this->db->where('code_bailleur', $code_bailleur);
		$this->db->delete($this->bailleur);
	}
		
	function delete_finance($code_finance){
		$this->db->where('code_finance', $code_finance);
		$this->db->delete($this->financer);
	}
	
	function get_bailleurlist(){
	
		return $this->db->get($this->bailleur);
	}		
	
	function get_projetlist(){
	
		return $this->db->get($this->projet);
	}	
}
?>