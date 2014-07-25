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
	
	function search_ouvrage($post){
	
		if(empty($post['etat_ouvrage']) && empty($post['type_ouvrage']) && empty($post['code_localite']) && empty($post['code_arrondissement']) && empty($post['code_departement']) && empty($post['code_region'])){
			return 1;
		}else{
						
			$this->db->select('ouvrage.*, libelle_region as nom_region, libelle_departement as nom_dept, libelle_arrondissement as nom_arrondiss, localites.nom as nom_localite');
			$this->db->from('region, departements,arrondissements,localites,ouvrage');
			$this->db->where('arrondissements.code_departement = departements.code_departement and region.code_region = departements.code_region and localites.code_arrondissement = arrondissements.code_arrondissement and localites.code_de_la_localite = ouvrage.code_de_la_localite');
		
		
			/*if(!empty($post['etat_ouvrage'])){
				$etat_ouvrage = $post['etat_ouvrage'];
				$this->db->where('code_arrondissement', $etat_ouvrage);
			}		*/	
		/*	if(!empty($post['type_ouvrage'])){
				$type_ouvrage = $post['type_ouvrage'];
				$this->db->where('code_arrondissement', $code_arrondissement);
			}*/	
			if(!empty($post['code_localite'])){
				$code_localite = $post['code_localite'];
				$this->db->where('localites.code_de_la_localite', $code_localite);
			}			
			if(!empty($post['code_arrondissement'])){
				$code_arrondissement = $post['code_arrondissement'];
				$this->db->where('arrondissements.code_arrondissement', $code_arrondissement);
			}				
			if(!empty($post['code_departement'])){
				$code_departement = $post['code_departement'];
				$this->db->where('departements.code_departement', $code_departement);
			}	
			if(!empty($post['code_region'])){
				$code_region = $post['code_region'];
				$this->db->where('region.code_region', $code_region);
			}	
					
			return $this->db->get()->result();
		}

	}
	

}
?>