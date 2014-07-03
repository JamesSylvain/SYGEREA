<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Panne extends CI_Controller {

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
		
		// load model
		$this->load->model('Panne_model','',TRUE);
	}
	
	function index($offset = 0)
	{
		// offset
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		
		// load data
		$persons = $this->Panne_model->get_paged_list($this->limit, $offset)->result();
		
		// generate pagination
		$this->load->library('pagination');
		$config['base_url'] = site_url('panne/index/');
 		$config['total_rows'] = $this->Panne_model->count_all();
 		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		// generate table data
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('No', 'Code Ouvrage', 'Localite', 'Description de la panne', 'Date mise hors usage',  'Actions');
		$i = 0 + $offset;
		foreach ($persons as $panne)
		{
			$this->table->add_row(++$i, $panne->code_de_l_ouvrage,  $panne->localite,  $panne->libelle_panne,  $panne->date_mise_hors_usage, 
				anchor('panne/view/'.$panne->id,'view',array('class'=>'view')).' '.
				anchor('panne/update/'.$panne->id,'update',array('class'=>'update')).' '.
				anchor('panne/delete/'.$panne->id,'delete',array('class'=>'delete','onclick'=>"return confirm('voulez vous supprimer cette panne?')"))
			);
		}
		$data['table'] = $this->table->generate();
		
		// load view
	//	$this->load->view('personList', $data);
	
		$this->template->layout('sidebar_param', 'panne/panneList', $data);

	}
	
	function addpanne()
	{
		// set empty default form field values
		$this->form_data = new stdclass;
		$this->form_data->code_panne = '';
		$this->form_data->code_region = '';
		$this->form_data->code_departement = '';
		$this->form_data->code_arrondissement= '';
		$this->form_data->code_localite= '';
		$this->form_data->code_ouvrage= '';
		$this->form_data->libelle_panne = '';
		$this->form_data->date_mise_hors_usage = '';
		
		// set common properties
		$data['title'] = 'Enregistrer une Panne :';
		//		$data['message'] = '';
		$data['action'] = site_url('panne/addpanne');
		$data['regions'] = $this->Param_model->get_regionlist()->result();
		$data['departements'] = $this->Param_model->get_departementlist()->result();
		$data['arrondissements'] = $this->Param_model->get_arrondissementlist()->result();
		$data['localites'] = $this->Param_model->get_localitelist()->result();
		$data['ouvrages'] = $this->Param_model->get_ouvragelist()->result();
		
			
		if(isset($_POST['enregistrer'])){
			
			// set validation properties
			$this->form_validation->set_rules('code_region', 'Nom de la region', 'trim|required');
			$this->form_validation->set_rules('code_departement', 'Nom du departement', 'trim|required');
			$this->form_validation->set_rules('code_arrondissement', 'Nom de l\'arrondissement', 'trim|required');
			$this->form_validation->set_rules('code_localite', 'Nom de la localite', 'trim|required');
			$this->form_validation->set_rules('code_ouvrage', 'Ouvrage en panne', 'trim|required');
			$this->form_validation->set_rules('libelle_panne', 'Description de la panne', 'trim|required');
			$this->form_validation->set_rules('date_mise_hors_usage', 'Date mise hors usage', 'trim|required');
			
		//	$this->form_validation->set_message('required', '* Champ obligatoire');
			
				// run validation
			if ($this->form_validation->run() == FALSE)
			{
				
				$data['message'] = 'les champs marques * sont obligatoire veuillez verifier votre formulaire!!';
			}
			else
			{

				// save data
				$panne = array('code_de_l_ouvrage' => $this->input->post('code_ouvrage'),
										'libelle_panne' => $this->input->post('libelle_panne'),
										'date_mise_hors_usage' => $this->input->post('date_mise_hors_usage')
										);
										
				$idpanne = $this->Panne_model->save($panne);				
				$this->session->set_flashdata('succes', 'panne enregistre avec succes!!');
				redirect('panne/');

			}
		}else{
			
		}
		// load view
		
		$this->template->layout('sidebar_param', 'panne/panneEdit', $data);
		
	}
	
	
	function view($id)
	{
		// set common properties
		$data['title'] = 'Details de la Panne ';
		
		// get panne details
		$data['panne'] = $this->Panne_model->get_by_id($id)->row();
		
		// load view
		
		$this->template->layout('sidebar_param', 'panne/panneView', $data);
	}
	
	function updatepanne($code_panne)
	{
	
		$data['panne'] = $this->Panne_model->get_by_id($code_panne)->row();
		// set common properties
		$data['title'] = 'modifier cette panne';
		$data['action'] = site_url('panne/updatepanne/'.$code_panne);
		
		
		$this->form_data = new stdclass;
		$this->form_data->code_panne = '';
		$this->form_data->code_region = '';
		$this->form_data->code_departement = '';
		$this->form_data->code_arrondissement= '';
		$this->form_data->code_localite= '';
		$this->form_data->code_ouvrage= '';
		$this->form_data->libelle_panne = '';
		$this->form_data->date_mise_hors_usage = '';
		
					// set validation properties
			$this->form_validation->set_rules('code_region', 'Nom de la region', 'trim|required');
			$this->form_validation->set_rules('code_departement', 'Nom du departement', 'trim|required');
			$this->form_validation->set_rules('code_arrondissement', 'Nom de l\'arrondissement', 'trim|required');
			$this->form_validation->set_rules('code_localite', 'Nom de la localite', 'trim|required');
			$this->form_validation->set_rules('code_ouvrage', 'Ouvrage en panne', 'trim|required');
			$this->form_validation->set_rules('libelle_panne', 'Description de la panne', 'trim|required');
			$this->form_validation->set_rules('date_mise_hors_usage', 'Date mise hors usage', 'trim|required');
			
		// run validation
		if ($this->form_validation->run() == FALSE)
		{
			$data['message'] = 'les champs marques * sont obligatoire veuillez verifier votre formulaire!!';
		}
		else
		{
			// save data
				$panne = array('code_de_l_ouvrage' => $this->input->post('code_ouvrage'),
										'libelle_panne' => $this->input->post('libelle_panne'),
										'date_mise_hors_usage' => $this->input->post('date_mise_hors_usage')
										);
			$this->Panne_model->update($code_panne,$panne);
			
			// set user message
				$this->session->set_flashdata('succes', 'panne modifier avec succes!!');
				redirect('panne/');
		}
		
		// load view
		
		$this->template->layout('sidebar_param', 'panne/panneEdit', $data);
		
	}
	
	function delete($id)
	{
		// delete panne
		$this->Panne_model->delete($id);
		
		// redirect to panne list page
		redirect('panne/index/','refresh');
	}
	
	// set empty default form field values
	function _set_fields()
	{
		$this->form_data->id = '';
		$this->form_data->name = '';
		$this->form_data->gender = '';
		$this->form_data->dob = '';
	}
	
	// validation rules
	function _set_rules()
	{
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('gender', 'Gender', 'trim|required');
		$this->form_validation->set_rules('dob', 'DoB', 'trim|required|callback_valid_date');
		
		$this->form_validation->set_message('required', '* required');
		$this->form_validation->set_message('isset', '* required');
		$this->form_validation->set_message('valid_date', 'date format is not valid. dd-mm-yyyy');
		$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
	}
	
	public function selectdept(){
	
		$code_region = $_POST['code_region'];
		$departements = $this->Param_model->get_departement_by_region($code_region)->result();
		
		if(count($departements)>0){
				echo '<select type="text"  name="code_departement" class="input-text">';
				echo '<option value="" >-- Choisir un departement --</option>';
				
				foreach($departements as $departement){
								
					echo '<option value="'.$departement->code_departement.'">'.$departement->libelle_departement.'</option>';
						
				}
				echo "</select>";
		}else{
		
			echo 'pas de sous departement pour cette region';
		}
	}	
	public function selectarrondiss(){
	
		$code_departement = $_POST['code_departement'];
		$arrondissements = $this->Param_model->get_arrondissement_by_dept($code_departement)->result();
		
		if(count($arrondissements)>0){
				echo '<select type="text"  name="code_arrondissement" class="input-text">';
				echo '<option value="" >-- Choisir un arrondissement --</option>';
				foreach($arrondissements as $arrondissement){
								
					echo '<option value="'.$arrondissement->code_arrondissement.'">'.$arrondissement->libelle_arrondissement.'</option>';
						
				}
				echo "</select>";
		}else{
		
			echo 'pas de sous departement pour cette region';
		}
	}
	
	// date_validation callback
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