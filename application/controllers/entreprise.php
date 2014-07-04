<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of entreprise
 *
 * @author romuald
 */
class Entreprise extends CI_Controller  {
    //put your code here
    
    private $limit = 10;

    function __construct() {
        parent::__construct();

        // load library
        $this->load->library(array('table', 'form_validation'));

        // load helper
        $this->load->helper('url');
		$this->form_validation->set_error_delimiters('<p class="msg error" style="min-height: 10px; line-height: 11px; width: 340px;">', '</p>');

        // load model
        $this->load->model('Model_generique', 'model', TRUE);
        $this->load->model('Bailleur_model', 'Bailleur_model', TRUE);
    }
    function index($offset = 0)
	{
		// offset
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		$table = 'entreprise';
		// load data
		$entreprises = $this->model->get_paged_list($table,$this->limit, $offset)->result();
		
//		// generate pagination
		$this->load->library('pagination');
		$config['base_url'] = site_url('entreprise/index/');
 		$config['total_rows'] = $this->model->count_all('entreprise');
 		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		// generate table data
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('No', 'Nom ','Téléphone','Code Postal','Ville','Email','Actions');
		$i = 0 + $offset;
		foreach ($entreprises as $entreprise)
		{
			$this->table->add_row( ++$i, strtoupper($entreprise->nom_de_l_entreprise),
                                $entreprise->tel,$entreprise->code_potal,$entreprise->ville,$entreprise->email,
				anchor('entreprise/view/'.$entreprise->code_entreprise,'View',array('class'=>'view')).' '.
				anchor('entreprise/update/'.$entreprise->code_entreprise,'Update',array('class'=>'update')).' '.
				anchor('entreprise/delete/'.$entreprise->code_entreprise,'Delete',array('class'=>'delete','onclick'=>"return confirm('Are you sure want to delete this enterprise ?')"))
			);
		}
		$data['table'] = $this->table->generate();
		
		// load view
//		$this->load->view('personList', $projets);
//	$this->template->layout('sidebar_default', 'welcome_message', $data);
		$this->template->layout('sidebar_default','entreprise/entrepriseList', $data);

	}	

        function add()
	{
            $table = 'entreprise';
		// set empty default form field values
		$this->form_data = new stdclass;
		$this->form_data->nom_de_l_entreprise 	 = '';
		$this->form_data->tel = '';
		$this->form_data->code_potal = '';
		$this->form_data->ville = '';
		$this->form_data->email = '';
		// set common properties
		$data['title'] = 'Ajouter une entreprise :';
		//		$data['message'] = '';
		$data['action'] = site_url('entreprise/add');
		$data['link_back'] = anchor('entreprise/index/','Back to list of projet',array('class'=>'update'));
		if(isset($_POST['enregistrer'])){
			// set validation properties
			$this->form_validation->set_rules('nom_de_l_entreprise', 'Libelle de l\'entreprise', 'trim|required');
			$this->form_validation->set_rules('tel', 'Téléphone', 'trim|required');
		//	$this->form_validation->set_message('required', '* Champ obligatoire');
				// run validation
			if ($this->form_validation->run() == FALSE)
			{
				$data['message'] = 'les champs marques * sont obligatoire veuillez verifier votre formulaire!!';
			}
			else
			{
				// save data
				$entreprise = array('nom_de_l_entreprise' => $this->input->post('nom_de_l_entreprise'),
                                  'tel'=>$this->input->post('tel'),
                                  'code_potal'=>$this->input->post('code_potal'),
                                  'ville'=>$this->input->post('ville'),
                                  'email'=>$this->input->post('email')
                                        );
				$identreprise = $this->model->save($table, $entreprise);				
				$this->session->set_flashdata('succes', 'Entreprise enregistre avec succes!!');
				redirect('entreprise/');
			}
		}else{
		}
		// load view
		$this->template->layout('sidebar_default', 'entreprise/entrepriseEdit', $data);
        }
         
        function view($id)
	{
            // set common properties
		$data['title'] = ' Details';
		$data['link_back'] = anchor('entreprise/index/','Back to list of projet',array('class'=>'back'));
		$data['link_edit'] = anchor('entreprise/update/'.$id,'Update',array('class'=>'update'));
		// get param details
		$data['entreprise'] = $this->model->get_by_id("entreprise", $id, "code_entreprise")->row();
		
		// load view
		
		$this->template->layout('sidebar_default', 'entreprise/entrepriseView', $data);
        }
        function update($id)
	{
            $table = 'entreprise';
		
		$entreprise = $this->model->get_by_id($table,$id,"code_entreprise")->row();
		// set empty default form field values
		$this->form_data = new stdclass;
		$this->form_data->nom_de_l_entreprise = $entreprise->nom_de_l_entreprise;
		$this->form_data->tel = $entreprise->tel;
		$this->form_data->code_potal = $entreprise->code_potal;
		$this->form_data->ville = $entreprise->ville;
		$this->form_data->email = $entreprise->email;
		
		// set common properties
		$data['title'] = 'Modifier cette entreprise :';
		//		$data['message'] = '';
		$data['action'] = site_url('entreprise/update/'.$id);
		$data['link_back'] = anchor('entreprise/index/','Back to list of projet',array('class'=>'back'));
			
		if(isset($_POST['enregistrer'])){
			
			
			// set validation properties
			$this->form_validation->set_rules('nom_de_l_entreprise', 'Libelle de l\'entreprise', 'trim|required');
			$this->form_validation->set_rules('tel', 'Téléphone', 'trim|required');
			
		//	$this->form_validation->set_message('required', '* Champ obligatoire');
			
				// run validation
			if ($this->form_validation->run() == FALSE)
			{
				
				$data['message'] = 'les champs marques * sont obligatoire veuillez verifier votre formulaire!!';
			}
			else
			{
				// save data
                                $entreprise = array('nom_de_l_entreprise' => $this->input->post('nom_de_l_entreprise'),
                                  'code_entreprise'=>$entreprise->code_entreprise,
                                  'tel'=>$this->input->post('tel'),
                                  'code_potal'=>$this->input->post('code_potal'),
                                  'ville'=>$this->input->post('ville'),
                                  'email'=>$this->input->post('email')
                                        );
													
				$this->model->update($table,'code_entreprise', $id, $entreprise);				
				$this->session->set_flashdata('succes', 'Informations du l\'entreprise modifiées avec succes!!');
				redirect('entreprise/index/');

			}
		}else{
			
		}
		// load view
		
		$this->template->layout('sidebar_default', 'entreprise/entrepriseEdit', $data);
		
        }
         
    function delete($id)
	{
            // delete param
		$this->model->delete("entreprise",'code_entreprise',$id);
		$this->session->set_flashdata('succes', 'projet supprime avec succes!!');
                redirect('entreprise/index','refresh');
        }
    
	function rehabilitement($offset = 0){
			// offset
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		
		// load data
		$rehabilites = $this->Bailleur_model->get_paged_list_rehabilite($this->limit, $offset)->result();
	
		// generate pagination
		$this->load->library('pagination');
		$config['base_url'] = site_url('entreprise/rehabilitement/');
 		$config['total_rows'] = $this->Bailleur_model->count_all_rehabilite();
 		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		// generate table data
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('No', 'Bailleur', 'Type Bailleur', 'Projet', 'Montant Financment', 'Annee rehabilitement',  'Actions');
		$options= array(1=>'Etat', 2=>'Organisme international', 3=>'ONG', 4=>'Particuliers');
		$i = 0 + $offset;
		foreach ($rehabilites as $rehabilite)
		{
			foreach($options as $key=>$value){
				if($rehabilite->type_entreprise == $key){
					$type_entreprise = $value;
				}
			}
			$this->table->add_row(++$i, $rehabilite->nom_entreprise, $type_entreprise, $rehabilite->nom_projet, $rehabilite->montant_rehabilitement, $rehabilite->annee_rehabilitement, 
				anchor('entreprise/view_rehabilite/'.$rehabilite->code_rehabilite,'details',array('class'=>'view')).' '.
				anchor('entreprise/update_rehabilite/'.$rehabilite->code_rehabilite,'modifier',array('class'=>'update')).' '.
				anchor('entreprise/delete_rehabilite/'.$rehabilite->code_rehabilite,'supprimer',array('class'=>'delete','onclick'=>"return confirm('voulez vous supprimer ce rehabilitement?')"))
			);
		}
		$data['table'] = $this->table->generate();
		
		// load view
	
		$this->template->layout('sidebar_projet', 'entreprise/rehabiliteList', $data);

	}
	
	function rehabiliter_ouvrage()
	{
			// set empty default form field values
		$this->form_data = new stdclass;
		$this->form_data->code_entreprise = '';
		$this->form_data->code_projet = '';
		$this->form_data->annee_rehabilitement = '';
		$this->form_data->montant_rehabilitement = '';
		
		// set common properties
		$data['title'] = 'Ajouter un rehabilitement de projet :';
		//		$data['message'] = '';
		$data['action'] = site_url('entreprise/rehabiliter_projet');
		$data['entreprises'] = $this->Bailleur_model->get_entrepriselist()->result();
		$data['projets'] = $this->Bailleur_model->get_projetlist()->result();
		
			
		if(isset($_POST['enregistrer'])){
			
			
			// set validation properties
			$this->form_validation->set_rules('code_entreprise', 'Nom du entreprise', 'trim|required');
			$this->form_validation->set_rules('code_projet', 'Nom du projet', 'trim|required');
			$this->form_validation->set_rules('montant_rehabilitement', 'Montant rehabilitement', 'trim|required');
			
			//	$this->form_validation->set_message('required', '* Champ obligatoire');
			
				// run validation
			if ($this->form_validation->run() == FALSE)
			{
				
				$data['message'] = 'les champs marques * sont obligatoire veuillez verifier votre formulaire!!';
			}else{
			//var_dump($_POST);exit;

				// save data
				$rehabiliter = array('code_entreprise' => $this->input->post('code_entreprise'),
										'code_projet' => $this->input->post('code_projet'),
										'annee_rehabilitement' => $this->input->post('annee_rehabilitement'),
										'montant_rehabilitement' => $this->input->post('montant_rehabilitement')
										);
										
				$idrehabilite = $this->Bailleur_model->save_rehabilite($rehabiliter);				
				$this->session->set_flashdata('succes', 'rehabilitement enregistre avec succes!!');
				redirect('entreprise/rehabilitement/');

			}
		}else{
			
		}
		// load view
		
		$this->template->layout('sidebar_projet', 'entreprise/rehabiliteEdit', $data);
	}
	
	function verify_duplicate_rehabilite($rehabilite){
	
		$entreprise = $rehabilite['code_entreprise'];
		$projet = $rehabilite['code_projet'];
		
		$resultat = $this->Bailleur_model->verify_rehabilite($entreprise, $projet)->result();

		if(count($resultat)>0){
			return true;
		}else{
		
			return false;
		
		}
		
	}
	
	function view_rehabilite($code_rehabilite)
	{
		// set common properties
		$data['title'] = 'Details du rehabilitement ';
		
				// get rehabilite details
		$data['rehabilite'] = $rehabilite = $this->Bailleur_model->get_by_code_rehabilite($code_rehabilite)->row();

		$options = array(1=>'Etat', 2=>'Organisme international', 3=>'ONG', 4=>'Particuliers');
		
			foreach($options as $key=>$value){
				if($rehabilite->type_entreprise == $key){
					$data['rehabilite']->type_entreprise = $value;
				}
			}
		// load view
		
		$this->template->layout('sidebar_projet', 'entreprise/rehabiliteView', $data);
	}
	
	function update_rehabilite($code_rehabilite){
	
		$rehabilite = $this->Bailleur_model->get_by_code_rehabilite($code_rehabilite)->row();
		
				// set empty default form field values
		$this->form_data = new stdclass;
		$this->form_data->code_entreprise = $rehabilite->code_entreprise;
		$this->form_data->code_projet = $rehabilite->code_projet;
		$this->form_data->annee_rehabilitement = $rehabilite->annee_rehabilitement;
		$this->form_data->montant_rehabilitement = $rehabilite->montant_rehabilitement;
		
		// set common properties
		$data['title'] = 'Modifier ce rehabilitement de projet :';
		//		$data['message'] = '';
		$data['action'] = site_url('entreprise/update_rehabilite/'.$code_rehabilite);
		$data['entreprises'] = $this->Bailleur_model->get_entrepriselist()->result();
		$data['projets'] = $this->Bailleur_model->get_projetlist()->result();
		
			
		if(isset($_POST['enregistrer'])){
			
			
			// set validation properties
			$this->form_validation->set_rules('code_entreprise', 'Nom du entreprise', 'trim|required');
			$this->form_validation->set_rules('code_projet', 'Nom du projet', 'trim|required');
			$this->form_validation->set_rules('montant_rehabilitement', 'Montant rehabilitement', 'trim|required');
			
			//	$this->form_validation->set_message('required', '* Champ obligatoire');
			
				// run validation
			if ($this->form_validation->run() == FALSE)
			{
				
				$data['message'] = 'les champs marques * sont obligatoire veuillez verifier votre formulaire!!';
			}else{

				// save data
				$rehabiliter = array('code_entreprise' => $this->input->post('code_entreprise'),
										'code_projet' => $this->input->post('code_projet'),
										'annee_rehabilitement' => $this->input->post('annee_rehabilitement'),
										'montant_rehabilitement' => $this->input->post('montant_rehabilitement')
										);
										
				$this->Bailleur_model->update_rehabilite($code_rehabilite, $rehabiliter);				
				$this->session->set_flashdata('succes', 'rehabilitement modifier avec succes!!');
				redirect('entreprise/rehabilitement/');

			}
		}else{
			
		}
		// load view
		
		$this->template->layout('sidebar_projet', 'entreprise/rehabiliteEdit', $data);

	}
	
	function delete_rehabilite($code_rehabilite){
	
			// delete rehabilitement
		$this->Bailleur_model->delete_rehabilite($code_rehabilite);
		
		// redirect to rehabilitement list page
		redirect('entreprise/rehabilitement/','refresh');
	
	}
}

?>
