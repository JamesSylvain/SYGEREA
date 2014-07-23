<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Projet extends CI_Controller {

    private $limit = 10;

    function __construct() {
        parent::__construct();

        // load library
        $this->load->library(array('table', 'form_validation'));

        // load helper
        $this->load->helper('url');

        // load model
        $this->load->model('Model_generique', 'model', TRUE);
        if (!$this->ion_auth->logged_in())
        {
                //redirect them to the login page
                redirect('auth/login', 'refresh');
        }
    }
    
    function index($offset = 0)
	{
		// offset
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		
		// load data
		$projets = $this->model->get_paged_list('projet',$this->limit, $offset)->result();
		
//		// generate pagination
		$this->load->library('pagination');
		$config['base_url'] = site_url('projet/index/');
 		$config['total_rows'] = $this->model->count_all('projet');
 		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		// generate table data
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('No', 'Libellé','Actions');
		$i = 0 + $offset;
		foreach ($projets as $projet)
		{
			$this->table->add_row( ++$i, strtoupper($projet->libelle_du_projet), 
				anchor('projet/view/'.$projet->code_projet,'view',array('class'=>'view')).' '.
				anchor('projet/update/'.$projet->code_projet,'update',array('class'=>'update')).' '.
				anchor('projet/delete/'.$projet->code_projet,'delete',array('class'=>'delete','onclick'=>"return confirm('Are you sure want to delete this project ?')"))
			);
		}
		$data['table'] = $this->table->generate();
		
		// load view
//		$this->load->view('personList', $projets);
//	$this->template->layout('sidebar_default', 'welcome_message', $data);
		$this->template->layout('sidebar_projet','projet/projetList', $data);

	}	

        function add()
	{
            $table = 'projet';
		// set empty default form field values
		$this->form_data = new stdclass;
		$this->form_data->libelle_du_projet = '';
		// set common properties
		$data['title'] = 'Ajouter un Projet :';
		//		$data['message'] = '';
		$data['action'] = site_url('projet/add');
		$data['link_back'] = anchor('projet/index/','Back to list of projet',array('class'=>'back'));
		if(isset($_POST['enregistrer'])){
			// set validation properties
			$this->form_validation->set_rules('libelle_du_projet', 'Libelle du projet', 'trim|required');
			$this->form_validation->set_message('required', '* Champ obligatoire');
				// run validation
			if ($this->form_validation->run() == FALSE)
			{
				$data['message'] = 'les champs marques * sont obligatoire veuillez verifier votre formulaire!!';
			}
			else
			{
				// save data
				$region = array('libelle_du_projet' => $this->input->post('libelle_du_projet'));
				$idprojet = $this->model->save($table, $region);				
				$this->session->set_flashdata('succes', 'Projet enregistre avec succes!!');
				redirect('projet/');
			}
		}else{
		}
		// load view
		$this->template->layout('sidebar_projet', 'projet/projetEdit', $data);
        }
         
        function view($id)
	{
            // set common properties
		$data['title'] = ' Details';
		$data['link_back'] = anchor('projet/index/','Back to list of projet',array('class'=>'back'));
		$data['link_edit'] = anchor('projet/update/'.$id,'Update',array('class'=>'update'));
		// get param details
		$data['projet'] = $this->model->get_by_id("projet", $id, "code_projet")->row();
		
		// load view
		
		$this->template->layout('sidebar_projet', 'projet/projetView', $data);
        }
        function update($id)
	{
            $table = 'projet';
		
		$projet = $this->model->get_by_id($table,$id,"code_projet")->row();
		// set empty default form field values
		$this->form_data = new stdclass;
		$this->form_data->code_projet = $projet->code_projet;
		$this->form_data->libelle_du_projet = $projet->libelle_du_projet ;
		
		// set common properties
		$data['title'] = 'Modifier cette Region :';
		//		$data['message'] = '';
		$data['action'] = site_url('projet/update/'.$id);
		$data['link_back'] = anchor('projet/index/','Back to list of projet',array('class'=>'back'));
			
		if(isset($_POST['enregistrer'])){
			
			
			// set validation properties
			$this->form_validation->set_rules('libelle_du_projet', 'Libelle du projet', 'trim|required');
			
			
			$this->form_validation->set_message('required', '* Champ obligatoire');
			
				// run validation
			if ($this->form_validation->run() == FALSE)
			{
				
				$data['message'] = 'les champs marques * sont obligatoire veuillez verifier votre formulaire!!';
			}
			else
			{
				// save data
				$projet = array('code_projet' => $projet->code_projet,
						'libelle_du_projet' => $this->input->post('libelle_du_projet'));
													
				$this->model->update($table,'code_projet', $id, $projet);				
				$this->session->set_flashdata('succes', 'projet modifier avec succes!!');
				redirect('projet/index/');

			}
		}else{
			
		}
		// load view
		
		$this->template->layout('sidebar_projet', 'projet/projetEdit', $data);
		
        }
         
        function delete($id)
	{
            // delete param
		$this->model->delete("projet",'code_projet',$id);
		$this->session->set_flashdata('succes', 'projet supprime avec succes!!');
                redirect('projet/index','refresh');
        }
        
}

?>
