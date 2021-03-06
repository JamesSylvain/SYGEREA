<?php
class Param_model extends CI_Model {
	
	private $region= 'region';
	private $departements= 'departements';
	private $arrondissements= 'arrondissements';
	private $localites= 'localites';
	private $entreprise= 'entreprise';
	
	function __construct(){
		parent::__construct();
	}
	
	function list_all(){
		$this->db->order_by('idContrib','asc');
		return $this->db->get($param);
	}
	
	function count_all($table){
		return $this->db->count_all($table);
	}
	
	
	function get_paged_region($table, $limit = 10, $offset = 0){
		$this->db->order_by('code_region','asc');
		return $this->db->get($table, $limit, $offset);
	}	
	
	function get_paged_departements($table, $limit = 10, $offset = 0){
		$this->db->order_by('code_departement','asc');
		return $this->db->get($table, $limit, $offset);
	}		
	
	function get_paged_localites($table, $limit = 10, $offset = 0){
		$this->db->order_by('code_de_la_localite','asc');
		return $this->db->get($table, $limit, $offset);
	}	
	
	function get_paged_caract_eaux($table, $limit = 10, $offset = 0){
		$this->db->order_by('code_caracteristique','asc');
		return $this->db->get($table, $limit, $offset);
	}	
	
	function get_paged_arrondissements($table, $limit = 10, $offset = 0){
		$this->db->order_by('code_arrondissement','asc');
		return $this->db->get($table, $limit, $offset);
	}	
	
	function get_by_id($idContrib){
		$this->db->where('idContrib', $idContrib);
		return $this->db->get($this->param);
	}		
	
	function get_by_code_rehabilite($code_rehabilite){
		$this->db->where('code_rehabilite', $code_rehabilite);
		return $this->db->get('rehabiliter');
	}		
	
	function get_region($code_region){
		$this->db->where('code_region', $code_region);
		return $this->db->get($this->region);
	}		
	
	function get_departement($code_departement){
		$this->db->where('code_departement', $code_departement);
		return $this->db->get($this->departements);
	}	
		
		
	function get_departement_by_region($code_region){
		$this->db->where('code_region', $code_region);
		return $this->db->get($this->departements);
	}	
	
	function get_arrondissement_by_dept($code_departement){
		$this->db->where('code_departement', $code_departement);
		return $this->db->get($this->arrondissements);
	}	
	
	function get_localites_by_arrondis($code_arrondissement){
		$this->db->where('code_arrondissement', $code_arrondissement);
		return $this->db->get($this->localites);
	}		
	
	function get_ouvrages_by_localite($code_localite){
		$this->db->where('code_de_la_localite', $code_localite);
		return $this->db->get('ouvrage');
	}	
	
	function get_arrondissement($code_arrondissement){
		$this->db->where('code_arrondissement', $code_arrondissement);
		return $this->db->get($this->arrondissements);
	}		
	
	function get_localite($code_localite){
		$this->db->where('code_de_la_localite', $code_localite);
		return $this->db->get($this->localites);
	}	
	
	function get_by_id_element($id, $element, $name_code){
		$this->db->where($name_code, $id);
		return $this->db->get($element);
	}
	
	function save($table, $param){
		$this->db->insert($table, $param);
		return $this->db->insert_id();
	}
	
	function save_rehabilite($rehabilite){
		$this->db->insert('rehabiliter', $rehabilite);
		return $this->db->insert_id();
	}
	
	function update($name_code, $code_element, $param, $table){
		$this->db->where($name_code, $code_element);
		$this->db->update($table, $param);
	}	
	
	function update_rehabilite($code_rehabilite, $rehabiliter){
		$this->db->where('code_rehabilite', $code_rehabilite);
		$this->db->update('rehabiliter', $rehabiliter);
	}
	
	function delete($id, $name_code, $table){
		$this->db->where($name_code, $id);
		$this->db->delete($table);
	}
	
	function getregionname($code_region){
		$this->db->where('code_region', $code_region);
		return $this->db->get('region')->row()->libelle_region;
	}	
	
	function get_entreprisename($code_entreprise){
		$this->db->where('code_entreprise', $code_entreprise);
		return $this->db->get('entreprise')->row()->nom_de_l_entreprise;
	}	
	
	function getdepartementname($code_departement){
		$this->db->where('code_departement', $code_departement);
		return $this->db->get('departements')->row()->libelle_departement;
	}	
	
	function getarrondissementname($code_arrondissement){
		$this->db->where('code_arrondissement', $code_arrondissement);
		return $this->db->get('arrondissements')->row()->libelle_arrondissement;
	}	
	
	function get_regionlist(){
	
		return $this->db->get('region');
	}		
	
	function get_departementlist(){
	
		return $this->db->get('departements');
	}		
	
	function get_arrondissementlist(){
	
		return $this->db->get('arrondissements');
	}		
	
	function get_localitelist(){
	
		return $this->db->get('localites');
	}	
	
	function get_ouvragelist(){
	
		return $this->db->get('ouvrage');
	}	
	
	function get_entrepriselist(){
	
		return $this->db->get($this->entreprise);
	}		
	
	function get_administrationby_localite($code_arrondissement){
	
		$this->db->select('libelle_region as nom_region, libelle_departement as nom_dept');
		$this->db->from('region, departements,arrondissements');
		$this->db->where('arrondissements.code_departement = departements.code_departement and region.code_region = departements.code_region');
		$this->db->where('code_arrondissement', $code_arrondissement);
		return $this->db->get();
	}
}
?>