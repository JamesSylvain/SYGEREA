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
						
			$this->db->select('ouvrage.*, libelle_region as nom_region, libelle_departement as nom_dept, libelle_arrondissement as nom_arrondiss, localites.nom as nom_localite');
			
			
			if(!empty($post['type_ouvrage'])){
				$type_ouvrage = $post['type_ouvrage'];
				switch ($type_ouvrage){
					case 1:
						$this->db->from('region, departements,arrondissements,localites,ouvrage, source_amenagees');
						$this->db->where('ouvrage.code_de_l_ouvrage = source_amenagees.code_de_l_ouvrage');
						break;
					case 2:
						$this->db->from('region, departements,arrondissements,localites,ouvrage, forages_ou_puits');
						$this->db->where('ouvrage.code_de_l_ouvrage = forages_ou_puits.code_de_l_ouvrage');
						break;
					case 3:
						$this->db->from('region, departements,arrondissements,localites,ouvrage, bornes_fontaines');
						$this->db->where('ouvrage.code_de_l_ouvrage = bornes_fontaines.code_de_l_ouvrage');
						break;					
					case 4:
						$this->db->from('region, departements,arrondissements,localites,ouvrage, aep');
						$this->db->where('ouvrage.code_de_l_ouvrage = aep.code_de_l_ouvrage');
						break;					
					case 5:
						$this->db->from('region, departements,arrondissements,localites,ouvrage, station_d_epuration');
						$this->db->where('ouvrage.code_de_l_ouvrage = station_d_epuration.code_de_l_ouvrage');
						break;					
					case 6:
						$this->db->from('region, departements,arrondissements,localites,ouvrage, puisard');
						$this->db->where('ouvrage.code_de_l_ouvrage = puisard.code_de_l_ouvrage');
						break;				
					case 7:
						$this->db->from('region, departements,arrondissements,localites,ouvrage, latrine');
						$this->db->where('ouvrage.code_de_l_ouvrage = latrine.code_de_l_ouvrage');
						break;
				}

			}else{
			
				$this->db->from('region, departements,arrondissements,localites,ouvrage');
				$this->db->where('arrondissements.code_departement = departements.code_departement and region.code_region = departements.code_region and localites.code_arrondissement = arrondissements.code_arrondissement and localites.code_de_la_localite = ouvrage.code_de_la_localite');

			}
			
			$this->db->where('arrondissements.code_departement = departements.code_departement and region.code_region = departements.code_region and localites.code_arrondissement = arrondissements.code_arrondissement and localites.code_de_la_localite = ouvrage.code_de_la_localite');

			if(!empty($post['etat_ouvrage'])){
				$etat_ouvrage = $post['etat_ouvrage'];
				$this->db->where('ouvrage.etat_de_l_ouvrage', $etat_ouvrage);
			}			

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
		//	$this->db->get()->result(); echo $this->db->last_query(); exit;


	}	
	
	function search_pannes($post){

			$this->db->select('pannes.*, libelle_region as nom_region, libelle_departement as nom_dept, libelle_arrondissement as nom_arrondiss, localites.nom as nom_localite', 'ouvrage.code_de_l_ouvrage');
			
			if(!empty($post['type_ouvrage'])){
				$type_ouvrage = $post['type_ouvrage'];
				switch ($type_ouvrage){
					case 1:
						$this->db->from('region, departements,arrondissements,localites,ouvrage, pannes, source_amenagees');
						$this->db->where('ouvrage.code_de_l_ouvrage = source_amenagees.code_de_l_ouvrage');
						break;
					case 2:
						$this->db->from('region, departements,arrondissements,localites,ouvrage, pannes, forages_ou_puits');
						$this->db->where('ouvrage.code_de_l_ouvrage = forages_ou_puits.code_de_l_ouvrage');
						break;
					case 3:
						$this->db->from('region, departements,arrondissements,localites,ouvrage, pannes, bornes_fontaines');
						$this->db->where('ouvrage.code_de_l_ouvrage = bornes_fontaines.code_de_l_ouvrage');
						break;					
					case 4:
						$this->db->from('region, departements,arrondissements,localites,ouvrage, pannes, aep');
						$this->db->where('ouvrage.code_de_l_ouvrage = aep.code_de_l_ouvrage');
						break;					
					case 5:
						$this->db->from('region, departements,arrondissements,localites,ouvrage, pannes, station_d_epuration');
						$this->db->where('ouvrage.code_de_l_ouvrage = station_d_epuration.code_de_l_ouvrage');
						break;					
					case 6:
						$this->db->from('region, departements,arrondissements,localites,ouvrage, pannes, puisard');
						$this->db->where('ouvrage.code_de_l_ouvrage = puisard.code_de_l_ouvrage');
						break;				
					case 7:
						$this->db->from('region, departements,arrondissements,localites,ouvrage, pannes, latrine');
						$this->db->where('ouvrage.code_de_l_ouvrage = latrine.code_de_l_ouvrage');
						break;
				}

			}else{
			
				$this->db->from('region, departements,arrondissements,localites,ouvrage, pannes');
				$this->db->where('arrondissements.code_departement = departements.code_departement and region.code_region = departements.code_region and localites.code_arrondissement = arrondissements.code_arrondissement and localites.code_de_la_localite = ouvrage.code_de_la_localite and ouvrage.code_de_l_ouvrage = pannes.code_de_l_ouvrage');

			}
			
		//	$this->db->from('region, departements, arrondissements, localites, ouvrage, pannes');
			$this->db->where('arrondissements.code_departement = departements.code_departement and region.code_region = departements.code_region and localites.code_arrondissement = arrondissements.code_arrondissement and localites.code_de_la_localite = ouvrage.code_de_la_localite and ouvrage.code_de_l_ouvrage = pannes.code_de_l_ouvrage');

		/*	if(!empty($post['etat_ouvrage'])){
				$etat_ouvrage = $post['etat_ouvrage'];
				$this->db->where('ouvrage.etat_de_l_ouvrage', $etat_ouvrage);
			}*/				
			
			if(!empty($post['code_ouvrage'])){
				$code_ouvrage = $post['code_ouvrage'];
				$this->db->where('ouvrage.code_de_l_ouvrage', $code_ouvrage);
			}			

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
		//	$this->db->get()->result(); echo $this->db->last_query(); exit;


	}
	

}
?>