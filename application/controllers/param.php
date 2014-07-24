<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Param extends CI_Controller {

	// num of records per page
	private $limit = 10;
	
	function __construct()
	{
		parent::__construct();
		
		// load library
		$this->load->library(array('table','form_validation'));
		$this->form_validation->set_error_delimiters('<p class="msg error" style="min-height: 10px; line-height: 11px; width: 340px;">', '</p>');
		
		// load helper
		$this->load->helper('url');
		
		if (!$this->ion_auth->logged_in())
		{
			//redirect them to the login page
			redirect('auth/login', 'refresh');
		}
	}
	
	function index(){
		
		$this->region();
	}
	
	/////////////////////////////gestion des regions /////////////////////////////////////////////////////////////////////////////////
	function region($offset = 0)
	{
	$table = 'region';
		// offset
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		
		// load data
		$regions = $this->Param_model->get_paged_region($table, $this->limit, $offset)->result();
		
		// generate pagination
		$this->load->library('pagination');
		$config['base_url'] = site_url('param/region/');
 		$config['total_rows'] = $this->Param_model->count_all($table);
 		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		// generate table data
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
	//	$this->table->style('width:530px;');
		$this->table->set_heading('No', 'Nom', 'Superficie (km²)', 'Population', 'Taux d\'accroissement (%)', 'Actions');
		$i = 0 + $offset;
		foreach ($regions as $region)
		{		
			$this->table->add_row(++$i, $region->libelle_region, $region->superficie, $region->population, $region->taux_d_acroissement, 
				anchor('param/view/'.$region->code_region.'/region/code_region/',' ',array('class'=>'view')).' '.
				anchor('param/updateregion/'.$region->code_region,' ',array('class'=>'update')).' '.
				anchor('param/delete/'.$region->code_region.'/region/region/code_region',' ',array('class'=>'delete','onclick'=>"return confirm('Voulez vous supprimer cette region?')"))
			);
		}
		$data['table'] = $this->table->generate();
		
		// load view
	//	$this->load->view('paramList', $data);
	
		$this->template->layout('sidebar_param', 'param/regionList', $data);

	}	

	function addregion()
	{
		$table = 'region';
	
		// set empty default form field values
		$this->form_data = new stdclass;
		$this->form_data->code_region = '';
		$this->form_data->nom_region = '';
		$this->form_data->superficie = '';
		$this->form_data->population = '';
		$this->form_data->taux_accroissement = '';
		
		// set common properties
		$data['title'] = 'Ajouter une Region :';
		//		$data['message'] = '';
		$data['action'] = site_url('param/addregion');
		
			
		if(isset($_POST['enregistrer'])){
			
			
			// set validation properties
			$this->form_validation->set_rules('nom_region', 'Nom de la region', 'trim|required');
			$this->form_validation->set_rules('superficie', 'Superficie', 'trim|required');
			$this->form_validation->set_rules('population', 'Population', 'trim|required');
			$this->form_validation->set_rules('taux_accroissement', 'taux d\'accroissement', 'trim|required');
			
		//	$this->form_validation->set_message('required', '* Champ obligatoire');
			
				// run validation
			if ($this->form_validation->run() == FALSE)
			{
				
				$data['message'] = 'les champs marques * sont obligatoire veuillez verifier votre formulaire!!';
			}
			else
			{
			//	var_dump($_POST);exit;

				// save data
				$region = array('libelle_region' => $this->input->post('nom_region'),
										'population' => $this->input->post('population'),
										'superficie' => $this->input->post('superficie'),
										'taux_d_acroissement' => $this->input->post('taux_accroissement')
										);
										
				$idregion = $this->Param_model->save($table, $region);				
				$this->session->set_flashdata('succes', 'region enregistre avec succes!!');
				redirect('param/region/');

			}
		}else{
			
		}
		// load view
		
		$this->template->layout('sidebar_param', 'param/regionEdit', $data);
		
	}		
	
	function updateregion($code_region)
	{
		$table = 'region';
		
		$region = $this->Param_model->get_region($code_region)->row();
		// set empty default form field values
		$this->form_data = new stdclass;
		$this->form_data->code_region = $region->code_region;
		$this->form_data->nom_region = $region->libelle_region;
		$this->form_data->superficie = $region->superficie;
		$this->form_data->population = $region->population;
		$this->form_data->taux_accroissement = $region->taux_d_acroissement;
		
		// set common properties
		$data['title'] = 'Modifier cette Region :';
		//		$data['message'] = '';
		$data['action'] = site_url('param/updateregion/'.$code_region);
		
			
		if(isset($_POST['enregistrer'])){
			
			
			// set validation properties
			$this->form_validation->set_rules('nom_region', 'Nom de la region', 'trim|required');
			$this->form_validation->set_rules('superficie', 'Superficie', 'trim|required');
			$this->form_validation->set_rules('population', 'Population', 'trim|required');
			$this->form_validation->set_rules('taux_accroissement', 'taux d\'accroissement', 'trim|required');
			
		//	$this->form_validation->set_message('required', '* Champ obligatoire');
			
				// run validation
			if ($this->form_validation->run() == FALSE)
			{
				
				$data['message'] = 'les champs marques * sont obligatoire veuillez verifier votre formulaire!!';
			}
			else
			{
			//	var_dump($_POST);exit;

				// save data
				$region = array('code_region' => $this->input->post('code_region'),
										'libelle_region' => $this->input->post('nom_region'),
										'population' => $this->input->post('population'),
										'superficie' => $this->input->post('superficie'),
										'taux_d_acroissement' => $this->input->post('taux_accroissement')
										);
													
				$this->Param_model->update('code_region', $code_region, $region, $table);				
				$this->session->set_flashdata('succes', 'region modifier avec succes!!');
				redirect('param/region/');

			}
		}else{
			
		}
		// load view
		
		$this->template->layout('sidebar_param', 'param/regionEdit', $data);
		
	}
	///////////////////////// fin de la  gestion des regions//////////////////////////////////////////////////////////////////////////////////////////////////////////			
	
	/////////////////////////////gestion des departements /////////////////////////////////////////////////////////////////////////////////
	function departements($offset = 0)
	{
		$table = 'departements';
		// offset
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		
		// load data
		$departements = $this->Param_model->get_paged_departements($table, $this->limit, $offset)->result();
		
		// generate pagination
		$this->load->library('pagination');
		$config['base_url'] = site_url('param/departements/');
 		$config['total_rows'] = $this->Param_model->count_all($table);
 		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		// generate table data
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('No', 'Nom du departement', 'Region', 'Superficie (km²)', 'Population', 'Taux d\'accroissement (%)', 'Actions');
		$i = 0 + $offset;
		foreach ($departements as $departement)
		{		
		$region_name = $this->Param_model->getregionname($departement->code_region);
			$this->table->add_row(++$i, $departement->libelle_departement, $region_name, $departement->superficie,  $departement->population,  $departement->taux_d_acroissement_pop, 
				anchor('param/view/'.$departement->code_departement.'/departements/code_departement',' ',array('class'=>'view')).' '.
				anchor('param/updatedepartement/'.$departement->code_departement,' ',array('class'=>'update')).' '.
				anchor('param/delete/'.$departement->code_departement,' ',array('class'=>'delete','onclick'=>"return confirm('Voulez vous supprimer ce Departement?')"))
			);
		}
		$data['table'] = $this->table->generate();
		
		// load view

		$this->template->layout('sidebar_param', 'param/departementsList', $data);

	}	

	function adddepartement()
	{
		$table = 'departements';
	
		// set empty default form field values
		$this->form_data = new stdclass;
		$this->form_data->code_departement = '';
		$this->form_data->code_region = '';
		$this->form_data->nom_departement = '';
		$this->form_data->superficie = '';
		$this->form_data->population = '';
		$this->form_data->taux_accroissement = '';
		
		// set common properties
		$data['title'] = 'Ajouter un Departement :';
		//		$data['message'] = '';
		$data['action'] = site_url('param/adddepartement');
		$data['regions'] = $this->Param_model->get_regionlist()->result();
		
			
		if(isset($_POST['enregistrer'])){
			
			
			// set validation properties
			$this->form_validation->set_rules('nom_departement', 'Nom du departement', 'trim|required');
			$this->form_validation->set_rules('code_region', 'Nom de la region', 'trim|required');
			$this->form_validation->set_rules('superficie', 'Superficie', 'trim|required');
			$this->form_validation->set_rules('population', 'Population', 'trim|required');
			$this->form_validation->set_rules('taux_accroissement', 'taux d\'accroissement', 'trim|required');
			
		//	$this->form_validation->set_message('required', '* Champ obligatoire');
			
				// run validation
			if ($this->form_validation->run() == FALSE)
			{
				
				$data['message'] = 'les champs marques * sont obligatoire veuillez verifier votre formulaire!!';
			}
			else
			{
			//var_dump($_POST);exit;

				// save data
				$departement = array('libelle_departement' => $this->input->post('nom_departement'),
										'code_region' => $this->input->post('code_region'),
										'population' => $this->input->post('population'),
										'superficie' => $this->input->post('superficie'),
										'taux_d_acroissement_pop' => $this->input->post('taux_accroissement')
										);
										
				$iddepartement = $this->Param_model->save($table, $departement);				
				$this->session->set_flashdata('succes', 'departement enregistre avec succes!!');
				redirect('param/departements/');

			}
		}else{
			
		}
		// load view
		
		$this->template->layout('sidebar_param', 'param/departementsEdit', $data);
		
	}		
	
	function updatedepartement($code_departement)
	{
		$table = 'departements';
		
		$departement = $this->Param_model->get_departement($code_departement)->row();
		// set empty default form field values
		$this->form_data = new stdclass;
		$this->form_data->code_departement = $departement->code_departement;
		$this->form_data->code_region = $departement->code_region;
		$this->form_data->nom_departement = $departement->libelle_departement;
		$this->form_data->superficie = $departement->superficie;
		$this->form_data->population = $departement->population;
		$this->form_data->taux_accroissement = $departement->taux_d_acroissement_pop;
		
		// set common properties
		$data['title'] = 'Modifier ce departement :';
		//		$data['message'] = '';
		$data['action'] = site_url('param/updatedepartement/'.$code_departement);
		$data['regions'] = $this->Param_model->get_regionlist()->result();
			
		if(isset($_POST['enregistrer'])){
			
			
			// set validation properties
			$this->form_validation->set_rules('nom_departement', 'Nom du departement', 'trim|required');
			$this->form_validation->set_rules('code_region', 'Nom de la region', 'trim|required');
			$this->form_validation->set_rules('superficie', 'Superficie', 'trim|required');
			$this->form_validation->set_rules('population', 'Population', 'trim|required');
			$this->form_validation->set_rules('taux_accroissement', 'taux d\'accroissement', 'trim|required');
			
		//	$this->form_validation->set_message('required', '* Champ obligatoire');
			
				// run validation
			if ($this->form_validation->run() == FALSE)
			{
				
				$data['message'] = 'les champs marques * sont obligatoire veuillez verifier votre formulaire!!';
			}
			else
			{
			//	var_dump($_POST);exit;

				// save data
				$departement = array('code_departement' => $this->input->post('code_departement'),
										'libelle_departement' => $this->input->post('nom_departement'),
										'code_region' => $this->input->post('code_region'),
										'population' => $this->input->post('population'),
										'superficie' => $this->input->post('superficie'),
										'taux_d_acroissement_pop' => $this->input->post('taux_accroissement')
										);
										
													
				$this->Param_model->update('code_departement', $code_departement, $departement, $table);				
				$this->session->set_flashdata('succes', 'departement modifie avec succes!!');
				redirect('param/departements/');

			}
		}else{
			
		}
		// load view
		
		$this->template->layout('sidebar_param', 'param/departementsEdit', $data);
		
	}
	///////////////////////// fin de la  gestion des departements//////////////////////////////////////////////////////////////////////////////////////////////////////////		
	
	/////////////////////////////gestion des arrondissements /////////////////////////////////////////////////////////////////////////////////
	function arrondissements($offset = 0)
	{
		$table = 'arrondissements';
		// offset
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		
		// load data
		$arrondissements = $this->Param_model->get_paged_arrondissements($table, $this->limit, $offset)->result();
		
		// generate pagination
		$this->load->library('pagination');
		$config['base_url'] = site_url('param/arrondissements/');
 		$config['total_rows'] = $this->Param_model->count_all($table);
 		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		// generate table data
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('No', 'Nom de l\'arrondissements', 'Departement', 'Superficie (km²)', 'Population', 'Taux d\'accroissement (%)', 'Actions');
		$i = 0 + $offset;
		foreach ($arrondissements as $arrondissement)
		{		
		$departement_name = $this->Param_model->getdepartementname($arrondissement->code_departement);
			$this->table->add_row(++$i, $arrondissement->libelle_arrondissement, $departement_name, $arrondissement->superficie,  $arrondissement->population,  $arrondissement->taux_d_acroissement_pop, 
				anchor('param/view/'.$arrondissement->code_arrondissement.'/arrondissements/code_arrondissement',' ',array('class'=>'view')).' '.
				anchor('param/updatearrondissement/'.$arrondissement->code_arrondissement,' ',array('class'=>'update')).' '.
				anchor('param/delete/'.$arrondissement->code_arrondissement,' ',array('class'=>'delete','onclick'=>"return confirm('Voulez vous supprimer cet arrondissement?')"))
			);
		}
		$data['table'] = $this->table->generate();
		
		// load view

		$this->template->layout('sidebar_param', 'param/arrondissementsList', $data);

	}	

	function addarrondissement()
	{
		$table = 'arrondissements';
	
		// set empty default form field values
		$this->form_data = new stdclass;
		$this->form_data->code_arrondissement = '';
		$this->form_data->code_departement = '';
		$this->form_data->nom_arrondissement = '';
		$this->form_data->superficie = '';
		$this->form_data->population = '';
		$this->form_data->taux_accroissement = '';
		
		// set common properties
		$data['title'] = 'Ajouter un Arrondissement :';
		//		$data['message'] = '';
		$data['action'] = site_url('param/addarrondissement');
		$data['departements'] = $this->Param_model->get_departementlist()->result();
		
			
		if(isset($_POST['enregistrer'])){
			
			
			// set validation properties
			$this->form_validation->set_rules('nom_arrondissement', 'Nom de l\'arrondissementt', 'trim|required');
			$this->form_validation->set_rules('code_departement', 'Nom du departement', 'trim|required');
			$this->form_validation->set_rules('superficie', 'Superficie', 'trim|required');
			$this->form_validation->set_rules('population', 'Population', 'trim|required');
			$this->form_validation->set_rules('taux_accroissement', 'taux d\'accroissement', 'trim|required');
			
		//	$this->form_validation->set_message('required', '* Champ obligatoire');
			
				// run validation
			if ($this->form_validation->run() == FALSE)
			{
				
				$data['message'] = 'les champs marques * sont obligatoire veuillez verifier votre formulaire!!';
			}
			else
			{
			//	var_dump($_POST);exit;

				// save data                    
				$arrondissement = array('libelle_arrondissement' => $this->input->post('nom_arrondissement'),
										'code_departement' => $this->input->post('code_departement'),
										'population' => $this->input->post('population'),
										'superficie' => $this->input->post('superficie'),
										'taux_d_acroissement_pop' => $this->input->post('taux_accroissement')
										);
										
				$idarrondissement = $this->Param_model->save($table, $arrondissement);				
				$this->session->set_flashdata('succes', 'arrondissement enregistre avec succes!!');
				redirect('param/arrondissements/');

			}
		}else{
			
		}
		// load view
		
		$this->template->layout('sidebar_param', 'param/arrondissementsEdit', $data);
		
	}		
	
	function updatearrondissement($code_arrondissement)
	{
		$table = 'arrondissements';
		
		$arrondissement = $this->Param_model->get_arrondissement($code_arrondissement)->row();
		// set empty default form field values
		$this->form_data = new stdclass;
		$this->form_data->code_arrondissement = $arrondissement->code_arrondissement;
		$this->form_data->code_departement = $arrondissement->code_departement;
		$this->form_data->nom_arrondissement = $arrondissement->libelle_arrondissement;
		$this->form_data->superficie = $arrondissement->superficie;
		$this->form_data->population = $arrondissement->population;
		$this->form_data->taux_accroissement = $arrondissement->taux_d_acroissement_pop;
		
		// set common properties
		$data['title'] = 'Modifier cet  arrondissement :';
		//		$data['message'] = '';
		$data['action'] = site_url('param/updatearrondissement/'.$code_arrondissement);
		$data['departements'] = $this->Param_model->get_departementlist()->result();
			
		if(isset($_POST['enregistrer'])){
			
			
			// set validation properties
			$this->form_validation->set_rules('nom_arrondissement', 'Nom de l\'arrondissementt', 'trim|required');
			$this->form_validation->set_rules('code_departement', 'Nom du departement', 'trim|required');
			$this->form_validation->set_rules('superficie', 'Superficie', 'trim|required');
			$this->form_validation->set_rules('population', 'Population', 'trim|required');
			$this->form_validation->set_rules('taux_accroissement', 'taux d\'accroissement', 'trim|required');
			
		//	$this->form_validation->set_message('required', '* Champ obligatoire');
			
				// run validation
			if ($this->form_validation->run() == FALSE)
			{
				
				$data['message'] = 'les champs marques * sont obligatoire veuillez verifier votre formulaire!!';
			}
			else
			{
			//	var_dump($_POST);exit;

				// save data
				$arrondissement = array('code_arrondissement' => $this->input->post('code_arrondissement'),
										'libelle_arrondissement' => $this->input->post('nom_arrondissement'),
										'code_departement' => $this->input->post('code_departement'),
										'population' => $this->input->post('population'),
										'superficie' => $this->input->post('superficie'),
										'taux_d_acroissement_pop' => $this->input->post('taux_accroissement')
										);
										
													
				$this->Param_model->update('code_arrondissement', $code_arrondissement, $arrondissement, $table);				
				$this->session->set_flashdata('succes', 'arrondissement modifie avec succes!!');
				redirect('param/arrondissements/');

			}
		}else{
			
		}
		// load view
		
		$this->template->layout('sidebar_param', 'param/arrondissementsEdit', $data);
		
	}
	///////////////////////// fin de la  gestion des arrondissements//////////////////////////////////////////////////////////////////////////////////////////////////////////			
	
	/////////////////////////////gestion des localites /////////////////////////////////////////////////////////////////////////////////
	function localites($offset = 0)
	{
		$table = 'localites';
		// offset
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		
		// load data
		$localites = $this->Param_model->get_paged_localites($table, $this->limit, $offset)->result();
		
		// generate pagination
		$this->load->library('pagination');
		$config['base_url'] = site_url('param/localites/');
 		$config['total_rows'] = $this->Param_model->count_all($table);
 		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		// generate table data
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('No', 'Nom de la localite', 'Lieu Dit', 'Arrondissement', 'Departement', 'Region', 'Population recensee', 'Taux d\'accroissement', 'Actions');
		$i = 0 + $offset;
		foreach ($localites as $localite)
		{		
		$arrondissement_name = $this->Param_model->getarrondissementname($localite->code_arrondissement);
		$adminstration = $this->Param_model->get_administrationby_localite($localite->code_arrondissement)->result();
	//	var_dump($adminstration);exit;
			$this->table->add_row(++$i, $localite->nom, $localite->lieudit, $arrondissement_name, $adminstration[0]->nom_dept, $adminstration[0]->nom_region, $localite->population_recensee,  $localite->taux_de_croissance_de_la_populat, 
				anchor('param/view/'.$localite->code_de_la_localite.'/localites/code_de_la_localite',' ',array('class'=>'view')).' '.
				anchor('param/updatelocalite/'.$localite->code_de_la_localite,' ',array('class'=>'update')).' '.
				anchor('param/delete/'.$localite->code_de_la_localite,' ',array('class'=>'delete','onclick'=>"return confirm('Voulez vous supprimer cette localite?')"))
			);
		}
		$data['table'] = $this->table->generate();
		
		// load view

		$this->template->layout('sidebar_param', 'param/localitesList', $data);

	}	

	function addlocalite()
	{
		$table = 'localites';
	
		// set empty default form field values
		$this->form_data = new stdclass;
		$this->form_data->code_de_la_localite = '';
		$this->form_data->nom_localite = '';
		$this->form_data->lieudit = '';
		$this->form_data->code_arrondissement = '';
		$this->form_data->population_recensee = '';
		$this->form_data->date_recensement = '';
		$this->form_data->taux_croissance = '';
		$this->form_data->coordonnees_en_x = '';
		$this->form_data->coordonnees_en_y = '';
		$this->form_data->coordonnees_en_z = '';
		$this->form_data->nbre_de_menages = '';
		$this->form_data->nbre_d_ecole = '1';
		$this->form_data->nbre_de_centre_de_sante = '';
		$this->form_data->nbre_d_hopitaux = '';
		$this->form_data->nbre_de_lieux_de_culte = '';
		
		// set common properties
		$data['title'] = 'Ajouter un localite :';
		//		$data['message'] = '';
		$data['action'] = site_url('param/addlocalite');
		$data['regions'] = $this->Param_model->get_regionlist()->result();
		$data['departements'] = $this->Param_model->get_departementlist()->result();
		$data['arrondissements'] = $this->Param_model->get_arrondissementlist()->result();
		
			
		if(isset($_POST['enregistrer'])){
			
			// set validation properties
			$this->form_validation->set_rules('nom_localite', 'Nom de la localite', 'trim|required');
			$this->form_validation->set_rules('lieudit', 'Lieu dit', 'trim|required');
			$this->form_validation->set_rules('code_arrondissement', 'Nom de l\'arrondissement', 'trim|required');
			$this->form_validation->set_rules('code_region', 'Nom de la region', 'trim|required');
			$this->form_validation->set_rules('code_departement', 'Nom du departement', 'trim|required');
			$this->form_validation->set_rules('population_recensee', 'Population recensee', 'trim|required');
			$this->form_validation->set_rules('date_recensement', 'Date du recensement', 'trim|required');
			$this->form_validation->set_rules('taux_croissance', 'Taux de croissance', 'trim|required');
			$this->form_validation->set_rules('coordonnees_en_x', 'Coordonnee en x', 'trim|required');
			$this->form_validation->set_rules('coordonnees_en_y', 'Coordonnee en y', 'trim|required');
			$this->form_validation->set_rules('coordonnees_en_z', 'Coordonnee en z', 'trim|required');
			$this->form_validation->set_rules('nbre_de_menages', 'Nombre de menages', 'trim|required');
			$this->form_validation->set_rules('nbre_d_ecole', 'Nombre d\'ecole', 'trim|required');
			$this->form_validation->set_rules('nbre_de_centre_de_sante', 'Nombre de centre de sante', 'trim|required');
			$this->form_validation->set_rules('nbre_d_hopitaux', 'Nombre d\'hopitaux', 'trim|required');
			$this->form_validation->set_rules('nbre_de_lieux_de_culte', 'Nombre de lieux de cultes', 'trim|required');

		//	$this->form_validation->set_message('required', '* Champ obligatoire');
			
				// run validation
			if ($this->form_validation->run() == FALSE)
			{
				
				$data['message'] = 'les champs marques * sont obligatoire veuillez verifier votre formulaire!!';
			}
			else
			{
			//	var_dump($_POST);exit;

				// save data                    
				$localite = array('nom' => $this->input->post('nom_localite'),
										'code_arrondissement' => $this->input->post('code_arrondissement'),
										'lieudit' => $this->input->post('lieudit'),
										'population_recensee' => $this->input->post('population_recensee'),
										'annee_recensement_population' => $this->input->post('date_recensement'),
										'taux_de_croissance_de_la_populat' => $this->input->post('taux_croissance'),
										'nbre_de_menages' => $this->input->post('nbre_de_menages'),
										'coordonnees_en_x' => $this->input->post('coordonnees_en_x'),
										'coordonnees_en_y' => $this->input->post('coordonnees_en_y'),
										'coordonnees_en_z' => $this->input->post('coordonnees_en_z'),
										'nbre_d_ecole' => $this->input->post('nbre_d_ecole'),
										'nbre_de_centre_de_sante' => $this->input->post('nbre_de_centre_de_sante'),
										'nbre_d_hopitaux' => $this->input->post('nbre_d_hopitaux'),
										'nbre_de_lieux_de_culte' => $this->input->post('nbre_de_lieux_de_culte')
										);
										
				$idlocalite = $this->Param_model->save($table, $localite);				
				$this->session->set_flashdata('succes', 'localite enregistre avec succes!!');
				redirect('param/localites/');

			}
		}else{
			
		}
		// load view
		
		$this->template->layout('sidebar_param', 'param/localitesEdit', $data);
		
	}		
	
	function updatelocalite($code_localite)
	{
		$table = 'localites';
		
		$localite = $this->Param_model->get_localite($code_localite)->row();
	
		// set empty default form field values
		$this->form_data = new stdclass;
		$this->form_data->code_de_la_localite = $localite->code_de_la_localite;
		$this->form_data->nom_localite = $localite->nom;
		$this->form_data->lieudit = $localite->lieudit;
		$this->form_data->code_arrondissement = $localite->code_arrondissement;
		$this->form_data->population_recensee = $localite->population_recensee;
		$this->form_data->date_recensement = $localite->annee_recensement_population;
		$this->form_data->taux_croissance = $localite->taux_de_croissance_de_la_populat;
		$this->form_data->coordonnees_en_x = $localite->coordonnees_en_x;
		$this->form_data->coordonnees_en_y = $localite->coordonnees_en_y;
		$this->form_data->coordonnees_en_z = $localite->coordonnees_en_z;
		$this->form_data->nbre_de_menages = $localite->nbre_de_menages;
		$this->form_data->nbre_d_ecole = $localite->nbre_d_ecole;
		$this->form_data->nbre_de_centre_de_sante = $localite->nbre_de_centre_de_sante;
		$this->form_data->nbre_d_hopitaux = $localite->nbre_d_hopitaux;
		$this->form_data->nbre_de_lieux_de_culte = $localite->nbre_de_lieux_de_culte;
		
		// set common properties
		$data['title'] = 'Modifier cette localite :';
		//		$data['message'] = '';
		$data['action'] = site_url('param/updatelocalite/'.$code_localite);
		$data['arrondissements'] = $this->Param_model->get_arrondissementlist()->result();
		
			
		if(isset($_POST['enregistrer'])){
			
			
			// set validation properties
			$this->form_validation->set_rules('nom_localite', 'Nom de la localite', 'trim|required');
			$this->form_validation->set_rules('lieudit', 'Lieu dit', 'trim|required');
			$this->form_validation->set_rules('code_arrondissement', 'Nom de l\'arrondissement', 'trim|required');
			$this->form_validation->set_rules('population_recensee', 'Population recensee', 'trim|required');
			$this->form_validation->set_rules('date_recensement', 'Date du recensement', 'trim|required');
			$this->form_validation->set_rules('taux_croissance', 'Taux de croissance', 'trim|required');
			$this->form_validation->set_rules('coordonnees_en_x', 'Coordonnee en x', 'trim|required');
			$this->form_validation->set_rules('coordonnees_en_y', 'Coordonnee en y', 'trim|required');
			$this->form_validation->set_rules('coordonnees_en_z', 'Coordonnee en z', 'trim|required');
			$this->form_validation->set_rules('nbre_de_menages', 'Nombre de menages', 'trim|required');
			$this->form_validation->set_rules('nbre_d_ecole', 'Nombre d\'ecole', 'trim|required');
			$this->form_validation->set_rules('nbre_de_centre_de_sante', 'Nombre de centre de sante', 'trim|required');
			$this->form_validation->set_rules('nbre_d_hopitaux', 'Nombre d\'hopitaux', 'trim|required');
			$this->form_validation->set_rules('nbre_de_lieux_de_culte', 'Nombre de lieux de cultes', 'trim|required');

		//	$this->form_validation->set_message('required', '* Champ obligatoire');
			
				// run validation
			if ($this->form_validation->run() == FALSE)
			{
				
				$data['message'] = 'les champs marques * sont obligatoire veuillez verifier votre formulaire!!';
			}
			else
			{
			//	var_dump($_POST);exit;

				// save data                    
				$localite = array('code_de_la_localite'=>$this->input->post('code_de_la_localite'),
										'nom' => $this->input->post('nom_localite'),
										'code_arrondissement' => $this->input->post('code_arrondissement'),
										'lieudit' => $this->input->post('lieudit'),
										'population_recensee' => $this->input->post('population_recensee'),
										'annee_recensement_population' => $this->input->post('date_recensement'),
										'taux_de_croissance_de_la_populat' => $this->input->post('taux_croissance'),
										'nbre_de_menages' => $this->input->post('nbre_de_menages'),
										'coordonnees_en_x' => $this->input->post('coordonnees_en_x'),
										'coordonnees_en_y' => $this->input->post('coordonnees_en_y'),
										'coordonnees_en_z' => $this->input->post('coordonnees_en_z'),
										'nbre_d_ecole' => $this->input->post('nbre_d_ecole'),
										'nbre_de_centre_de_sante' => $this->input->post('nbre_de_centre_de_sante'),
										'nbre_d_hopitaux' => $this->input->post('nbre_d_hopitaux'),
										'nbre_de_lieux_de_culte' => $this->input->post('nbre_de_lieux_de_culte')
										);
										
				$this->Param_model->update('code_de_la_localite', $code_localite, $localite, $table);					
				$this->session->set_flashdata('succes', 'localite modifie avec succes!!');
				redirect('param/localites/');

			}
		}else{
			
		}
		// load view
		
		$this->template->layout('sidebar_param', 'param/localitesEdit', $data);
		
	}
	///////////////////////// fin de la  gestion des localites//////////////////////////////////////////////////////////////////////////////////////////////////////////		
	
	/////////////////////////////gestion des caracteriski eau /////////////////////////////////////////////////////////////////////////////////
	function caract_eaux($offset = 0)
	{
		$table = 'carateristiques_eau';
		// offset
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		
		// load data
		$caract_eaus = $this->Param_model->get_paged_caract_eaux($table, $this->limit, $offset)->result();
		
		// generate pagination
		$this->load->library('pagination');
		$config['base_url'] = site_url('param/caract_eaux/');
 		$config['total_rows'] = $this->Param_model->count_all($table);
 		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		// generate table data
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('No', 'Ouvrage', 'Date de prelevement', 'Date d\'analyse', 'Saveur', 'Limpidite', 'Temperature', 'Actions');
		$i = 0 + $offset;
		foreach ($caract_eaus as $caract_eau)
		{		

			$this->table->add_row(++$i, $caract_eau->code_de_l_ouvrage, $caract_eau->date_de_prelevement, $caract_eau->date_d_analyse, $caract_eau->saveur, $caract_eau->limpidite, $caract_eau->temperature,
				anchor('param/view/'.$caract_eau->code_caracteristique.'/carateristiques_eau/code_caracteristique','details ',array('class'=>'view')).' '.
				anchor('param/delete/'.$caract_eau->code_caracteristique,' supprimer',array('class'=>'delete','onclick'=>"return confirm('Voulez vous supprimer cette caracteristique?')"))
			);
		}
		$data['table'] = $this->table->generate();
		
		// load view

		$this->template->layout('sidebar_param', 'param/carateristiques_eauList', $data);

	}	

	function addcaract_eaux()
	{
		$table = 'carateristiques_eau';
	
		// set empty default form field values
		$this->form_data = new stdclass;
		$this->form_data->code_caracteristique = '';
		$this->form_data->code_de_l_ouvrage = '';
		$this->form_data->turbidite = '';
		$this->form_data->temperature = '';
		$this->form_data->conductivite = '';
		$this->form_data->matieres_organiques = '';
		$this->form_data->mineralisation = '';
		$this->form_data->ph = '';
		$this->form_data->eau_traitee = '';
		$this->form_data->date_de_prelevement = '';
		$this->form_data->date_d_analyse = '';
		$this->form_data->saveur = '';
		$this->form_data->limpidite = '';
		$this->form_data->k = '';
		$this->form_data->nh4 = '';
		$this->form_data->fe = '';
		$this->form_data->mn = '';
		$this->form_data->co3 = '';
		$this->form_data->so4 = '';
		$this->form_data->f = '';
		$this->form_data->hco3 = '';
		$this->form_data->co2_dissous = '';
		$this->form_data->o2_dissous = '';
		$this->form_data->silice = '';
		
		// set common properties
		$data['title'] = 'Ajouter une catacteristique d\'eau :';
		//		$data['message'] = '';
		$data['action'] = site_url('param/addcaract_eaux');
		$data['regions'] = $this->Param_model->get_regionlist()->result();
		$data['departements'] = $this->Param_model->get_departementlist()->result();
		$data['arrondissements'] = $this->Param_model->get_arrondissementlist()->result();
		$data['arrondissements'] = $this->Param_model->get_arrondissementlist()->result();
		
			
		if(isset($_POST['enregistrer'])){
			
		//	var_dump($_POST);exit;
			// set validation properties
			$this->form_validation->set_rules('code_de_l_ouvrage', 'Code de l\'ouvrage', 'trim|required');
			$this->form_validation->set_rules('turbidite', 'turbidite', 'trim|required');
			$this->form_validation->set_rules('temperature', 'temperature', 'trim|required');
			$this->form_validation->set_rules('conductivite', 'conductivite', 'trim|required');
			$this->form_validation->set_rules('matieres_organiques', 'matieres_organiques', 'trim|required');
			$this->form_validation->set_rules('mineralisation', 'mineralisation', 'trim|required');
			$this->form_validation->set_rules('ph', 'ph', 'trim|required');
			$this->form_validation->set_rules('eau_traitee', 'eau traitee', 'trim|required');
			$this->form_validation->set_rules('date_de_prelevement', 'Date de prelevement', 'trim|required');
			$this->form_validation->set_rules('date_d_analyse', 'Date d\'analyse', 'trim|required');
			$this->form_validation->set_rules('saveur', 'saveur', 'trim|required');
			$this->form_validation->set_rules('limpidite', 'limpidite', 'trim|required');
			$this->form_validation->set_rules('k', 'potassium', 'trim|required');
			$this->form_validation->set_rules('nh4', 'nh4', 'trim|required');
			$this->form_validation->set_rules('fe', 'fer', 'trim|required');
			$this->form_validation->set_rules('mn', 'mn', 'trim|required');
			$this->form_validation->set_rules('co3', 'co3', 'trim|required');
			$this->form_validation->set_rules('so4', 'so4', 'trim|required');
			$this->form_validation->set_rules('f', 'Fluor', 'trim|required');
			$this->form_validation->set_rules('hco3', 'hco3', 'trim|required');
			$this->form_validation->set_rules('co2_dissous', 'co2 dissous', 'trim|required');
			$this->form_validation->set_rules('o2_dissous', 'o2 dissouss', 'trim|required');
			$this->form_validation->set_rules('silice', 'silice', 'trim|required');

		//	$this->form_validation->set_message('required', '* Champ obligatoire');
			
				// run validation
			if ($this->form_validation->run() == FALSE)
			{
				
				$data['message'] = 'les champs marques * sont obligatoire veuillez verifier votre formulaire!!';
			}
			else
			{
			//	var_dump($_POST);exit;

				// save data                    
				$localite = array('code_de_l_ouvrage' => $this->input->post('code_de_l_ouvrage'),
										'turbidite' => $this->input->post('turbidite'),
										'temperature' => $this->input->post('temperature'),
										'conductivite' => $this->input->post('conductivite'),
										'matieres_organiques' => $this->input->post('matieres_organiques'),
										'mineralisation' => $this->input->post('mineralisation'),
										'ph' => $this->input->post('ph'),
										'eau_traitee' => $this->input->post('eau_traitee'),
										'date_de_prelevement' => $this->input->post('date_de_prelevement'),
										'date_d_analyse' => $this->input->post('date_d_analyse'),
										'saveur' => $this->input->post('saveur'),
										'limpidite' => $this->input->post('limpidite'),
										'k' => $this->input->post('k'),
										'nh4' => $this->input->post('nh4'),
										'fe' => $this->input->post('fe'),
										'mn' => $this->input->post('mn'),
										'co3' => $this->input->post('co3'),
										'so4' => $this->input->post('so4'),
										'f' => $this->input->post('f'),
										'hco3' => $this->input->post('hco3'),
										'co2_dissous' => $this->input->post('co2_dissous'),
										'o2_dissous' => $this->input->post('o2_dissous'),
										'silice' => $this->input->post('silice')
										);
										
				$idlocalite = $this->Param_model->save($table, $localite);				
				$this->session->set_flashdata('succes', 'caracteristique eau  enregistre avec succes!!');
				redirect('param/caract_eaux/');

			}
		}else{
			
		}
		// load view
		
		$this->template->layout('sidebar_param', 'param/carateristiques_eauEdit', $data);
		
	}		
	
	function updatecaract_eaux($code_localite)
	{
		$table = 'carateristiques_eau';
		
		$localite = $this->Param_model->get_localite($code_localite)->row();
	
		// set empty default form field values
		$this->form_data = new stdclass;
		$this->form_data->code_de_la_localite = $localite->code_de_la_localite;
		$this->form_data->nom_localite = $localite->nom;
		$this->form_data->lieudit = $localite->lieudit;
		$this->form_data->code_arrondissement = $localite->code_arrondissement;
		$this->form_data->population_recensee = $localite->population_recensee;
		$this->form_data->date_recensement = $localite->annee_recensement_population;
		$this->form_data->taux_croissance = $localite->taux_de_croissance_de_la_populat;
		$this->form_data->coordonnees_en_x = $localite->coordonnees_en_x;
		$this->form_data->coordonnees_en_y = $localite->coordonnees_en_y;
		$this->form_data->coordonnees_en_z = $localite->coordonnees_en_z;
		$this->form_data->nbre_de_menages = $localite->nbre_de_menages;
		$this->form_data->nbre_d_ecole = $localite->nbre_d_ecole;
		$this->form_data->nbre_de_centre_de_sante = $localite->nbre_de_centre_de_sante;
		$this->form_data->nbre_d_hopitaux = $localite->nbre_d_hopitaux;
		$this->form_data->nbre_de_lieux_de_culte = $localite->nbre_de_lieux_de_culte;
		
		// set common properties
		$data['title'] = 'Modifier cette localite :';
		//		$data['message'] = '';
		$data['action'] = site_url('param/updatecaract_eaux/'.$code_localite);
		$data['arrondissements'] = $this->Param_model->get_arrondissementlist()->result();
		
			
		if(isset($_POST['enregistrer'])){
			
			
			// set validation properties
			$this->form_validation->set_rules('nom_localite', 'Nom de la localite', 'trim|required');
			$this->form_validation->set_rules('lieudit', 'Lieu dit', 'trim|required');
			$this->form_validation->set_rules('code_arrondissement', 'Nom de l\'arrondissement', 'trim|required');
			$this->form_validation->set_rules('population_recensee', 'Population recensee', 'trim|required');
			$this->form_validation->set_rules('date_recensement', 'Date du recensement', 'trim|required');
			$this->form_validation->set_rules('taux_croissance', 'Taux de croissance', 'trim|required');
			$this->form_validation->set_rules('coordonnees_en_x', 'Coordonnee en x', 'trim|required');
			$this->form_validation->set_rules('coordonnees_en_y', 'Coordonnee en y', 'trim|required');
			$this->form_validation->set_rules('coordonnees_en_z', 'Coordonnee en z', 'trim|required');
			$this->form_validation->set_rules('nbre_de_menages', 'Nombre de menages', 'trim|required');
			$this->form_validation->set_rules('nbre_d_ecole', 'Nombre d\'ecole', 'trim|required');
			$this->form_validation->set_rules('nbre_de_centre_de_sante', 'Nombre de centre de sante', 'trim|required');
			$this->form_validation->set_rules('nbre_d_hopitaux', 'Nombre d\'hopitaux', 'trim|required');
			$this->form_validation->set_rules('nbre_de_lieux_de_culte', 'Nombre de lieux de cultes', 'trim|required');

		//	$this->form_validation->set_message('required', '* Champ obligatoire');
			
				// run validation
			if ($this->form_validation->run() == FALSE)
			{
				
				$data['message'] = 'les champs marques * sont obligatoire veuillez verifier votre formulaire!!';
			}
			else
			{
			//	var_dump($_POST);exit;

				// save data                    
				$localite = array('code_de_la_localite'=>$this->input->post('code_de_la_localite'),
										'nom' => $this->input->post('nom_localite'),
										'code_arrondissement' => $this->input->post('code_arrondissement'),
										'lieudit' => $this->input->post('lieudit'),
										'population_recensee' => $this->input->post('population_recensee'),
										'annee_recensement_population' => $this->input->post('date_recensement'),
										'taux_de_croissance_de_la_populat' => $this->input->post('taux_croissance'),
										'nbre_de_menages' => $this->input->post('nbre_de_menages'),
										'coordonnees_en_x' => $this->input->post('coordonnees_en_x'),
										'coordonnees_en_y' => $this->input->post('coordonnees_en_y'),
										'coordonnees_en_z' => $this->input->post('coordonnees_en_z'),
										'nbre_d_ecole' => $this->input->post('nbre_d_ecole'),
										'nbre_de_centre_de_sante' => $this->input->post('nbre_de_centre_de_sante'),
										'nbre_d_hopitaux' => $this->input->post('nbre_d_hopitaux'),
										'nbre_de_lieux_de_culte' => $this->input->post('nbre_de_lieux_de_culte')
										);
										
				$this->Param_model->update('code_de_la_localite', $code_localite, $localite, $table);					
				$this->session->set_flashdata('succes', 'localite modifie avec succes!!');
				redirect('param/localites/');

			}
		}else{
			
		}
		// load view
		
		$this->template->layout('sidebar_param', 'param/caract_eauxEdit', $data);
		
	}
	///////////////////////// fin de la  gestion des caract_eaux//////////////////////////////////////////////////////////////////////////////////////////////////////////		

	////////////fonction generique pour tous les autres /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	function view($id, $element, $name_code)
	{
		// set common properties
		$data['title'] = $element.' Details';
		
		// get param details
		$data[$element] = $this->Param_model->get_by_id_element($id, $element, $name_code)->row();
		
		// load view
		
		$this->template->layout('sidebar_param', 'param/'.$element.'View', $data);
	}	
	
	
	function delete($id, $table, $element, $name_code)
	{
		// delete param
		$this->Param_model->delete($id, $name_code, $table);
		$this->session->set_flashdata('succes', $element.' supprime avec succes!!');
		// redirect to param list page
		redirect('param/'.$element.'/','refresh');
	}
	
	function traitedate($date){
		$year = array('JAN'=>1, 'FEB'=>2, 'MAR'=>3, 'APR'=>4, 'MAY'=>5, 'JUN'=>6, 'JUL'=>7, 'AUG'=>8, 'SEP'=>9, 'OCT'=>10, 'NOV'=>11, 'DEC'=>12);
		$a = explode('-',$date);
		foreach($year as $key=>$value){
			if($a[1]==$key){
				$a[1] = $value;
			}
		}
		$f = implode('-',array($a[2], $a[1], $a[0]));
	//	$final = implode(' ', array($f, '23:59:59'));
		return $f;
	}
	
	function traite_fichier($files, $nom){
						
		$file_tmp = $files[$nom]['tmp_name'];
		$file_name = $files[$nom]['name'];					

		move_uploaded_file($file_tmp, 'assets/upload/cours/'.$file_name);
		return $file_name;
	}
	
	function valid_date($str)
	{
		//match the format of the date
		if (preg_match ("/^([0-9]{2})-([0-9]{2})-([0-9]{4})$/", $str, $parts))
		{
			//check weather the date is valid of not
			if(checkdate($parts[2],$parts[1],$parts[3]))
				return true;
			else
				return false;
		}
		else
			return false;
	}
}
?>