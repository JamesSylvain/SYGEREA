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
        
}

?>
