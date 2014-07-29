<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller {

	// num of records per page
	private $limit = 10;
	
	function __construct()
	{
		parent::__construct();
		
		// load library
		$this->load->library(array('table','form_validation'));
		
		// load helper
		$this->load->helper('url');
		
		if (!$this->ion_auth->logged_in())
		{
			//redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		// load model
		$this->load->model('Search_model','',TRUE);
		$this->load->model('Model_generique', 'model', TRUE);
	}
	
	function index($offset = 0)
	{
	
		$data['title'] = 'Rechercher ouvrages';
		$data['action'] = site_url('search/index/');
		$data['regions'] = $this->Param_model->get_regionlist()->result();
	
		if(isset($_POST['enregistrer'])){
			if(empty($_POST['etat_ouvrage']) && empty($_POST['type_ouvrage']) && empty($_POST['code_localite']) && empty($_POST['code_arrondissement']) && empty($_POST['code_departement']) && empty($_POST['code_region'])){
				$this->session->set_flashdata('message', 'veuillez choisir au moins un critere de recherche!!!');
				redirect('search/index/');
			}else{
				
				$ouvrages = $this->Search_model->search_ouvrage($_POST);	
				
				$data['title'] = 'Resultat de la recherche';
		
				if(count($ouvrages)>0){		
								// generate table data
					$this->load->library('table');
					$this->table->set_empty("&nbsp;");
					$this->table->set_heading('No', 'Entreprise ', 'Projet','Localité', 'Population', 'Date Réalisation','Actions');
					$i = 0 + $offset;
					foreach ($ouvrages as $ouvrage) {
						$projet = $this->model->getEntity("SELECT * FROM projet WHERE code_projet=" . $ouvrage->code_projet)->row();
						$entreprise = $this->model->getEntity("SELECT * FROM entreprise WHERE code_entreprise=" . $ouvrage->code_entreprise . ";")->row();
						$localite = $this->model->getEntity("SELECT localites.* FROM localites,ouvrage 
							WHERE ouvrage.code_de_la_localite=localites.code_de_la_localite and 
							ouvrage.code_de_l_ouvrage=" . $ouvrage->code_de_l_ouvrage . ";")->row();
						$this->table->add_row(++$i, strtoupper($entreprise->nom_de_l_entreprise), 
								$projet->libelle_du_projet, 
								$localite->nom.' : '.$localite->lieudit,
								$ouvrage->population_desservie, 
								$ouvrage->date_de_realisation,
								'+ de details');
					}
				 $data['table'] = $this->table->generate();
				 $data['link'] = anchor('search/index/','Faire une autre recherche',array('class'=>'search'));
				}else{
					$data['table'] = '<br /><br /><strong>Pas de resultat !!</strong>';
					$data['link'] = anchor('search/index/','Faire une autre recherche',array('class'=>'search'));
				}
				// load view
				$this->template->layout('sidebar_search', 'search/ouvrage_result', $data);
				
			}
		
		}

		$this->template->layout('sidebar_search', 'search/search', $data);

	}
	
	function searchOuvrage(){
	
	
	}
	
}
?>