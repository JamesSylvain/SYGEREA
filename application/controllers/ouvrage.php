<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ouvrage
 *
 * @author romuald
 */
class Ouvrage extends CI_Controller {

    //put your code here
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

    function index($offset = 0) {
        // offset
        $uri_segment = 3;
        $offset = $this->uri->segment($uri_segment);
        $table = 'ouvrage';
        // load data
        $ouvrages = $this->model->get_paged_list($table, $this->limit, $offset)->result();

//		// generate pagination
        $this->load->library('pagination');
        $config['base_url'] = site_url('ouvrage/index/');
        $config['total_rows'] = $this->model->count_all('ouvrage');
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $uri_segment;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        // generate table data
        $this->load->library('table');
        $this->table->set_empty("&nbsp;");
        $this->table->set_heading('No', 'Entreprise ', 'Projet','Localité', 'Population', 'Date Réalisation');
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
                    $ouvrage->date_de_realisation);
        }
        $data['table'] = $this->table->generate();

        // load view
//		$this->load->view('personList', $projets);
//	$this->template->layout('sidebar_default', 'welcome_message', $data);
        $this->template->layout('sidebar_ouvrage', 'ouvrage/ouvrageList', $data);
    }

    function add() {
        $base_table = $this->session->userdata('table_base');
        if (isset($base_table) && !empty($base_table) && !is_null($base_table)) {
            ;
        }
        else
            redirect('ouvrage_sources_em/create_hydrau');
 
        $table = 'ouvrage';
//            $table_base= $this->session->userdata('table_base');
        // set empty default form field values
        $this->form_data = new stdclass;
//		$this->form_data->code_entreprise = '';
//		$this->form_data->code_projet = '';
        $this->form_data->population_desservie = '';
        $this->form_data->date_de_realisation = '';
        $this->form_data->coordonnees_en_x = '';
        $this->form_data->coordonees_en_y = '';
        $this->form_data->coordonnees_en_z = '';
        $this->form_data->etat_de_l_ouvrage = '';

        $data['projets'] = $this->model->list_all('projet')->result();
        $data['entreprises'] = $this->model->list_all('entreprise')->result();

        // set common properties
        $data['title'] = 'Ajouter une nouvelle source amenagees :';
        //		$data['message'] = '';
        $data['action'] = site_url('ouvrage/add');
        $data['link_back'] = anchor('ouvrage/index/', 'Back to list of projet', array('class' => 'back'));
        if (isset($_POST['enregistrer'])) {
            // set validation properties
            $this->form_validation->set_rules('code_entreprise', 'code entreprise', 'trim|required');
            $this->form_validation->set_rules('code_projet', 'code projet', 'trim|required');
            $this->form_validation->set_rules('population_desservie', 'population desservie', 'trim|required');
            $this->form_validation->set_rules('date_de_realisation', 'date de realisation', 'trim|required');
            $this->form_validation->set_rules('coordonnees_en_x', 'coordonnees en X', 'trim|required');
            $this->form_validation->set_rules('coordonees_en_y', 'coordonnees en Y', 'trim|required');
            $this->form_validation->set_rules('coordonnees_en_z', 'coordonnees en Z', 'trim|required');
            $this->form_validation->set_rules('etat_de_l_ouvrage', 'etat de l\'ouvrage', 'trim|required');

            $this->form_validation->set_message('required', '* Champ obligatoire');
            // run validation
            if ($this->form_validation->run() == FALSE) {
                $data['message'] = 'les champs marques * sont obligatoire veuillez verifier votre formulaire!!';
            } else {
                // save data
                $region = array(
                    'code_entreprise' => $this->input->post('code_entreprise'),
                    'code_projet' => $this->input->post('code_projet'),
                    'population_desservie' => $this->input->post('population_desservie'),
                    'date_de_realisation' => $this->input->post('date_de_realisation'),
                    'coordonnees_en_x' => $this->input->post('coordonnees_en_x'),
                    'coordonees_en_y' => $this->input->post('coordonees_en_y'),
                    'coordonnees_en_z' => $this->input->post('coordonnees_en_z'),
                    'etat_de_l_ouvrage' => $this->input->post('etat_de_l_ouvrage')
                );

                $this->session->set_userdata('ouvrage', $region);
                $this->session->set_flashdata('succes', 'Ouvrage enregistre avec succes!!');
                redirect('hydraulique/add');
            }
        } else {
            
        }
        // load view
        $this->template->layout('sidebar_default', 'ouvrage/ouvrageEdit', $data);
    }

    function view($id) {
        // set common properties
        $data['title'] = ' Details';
        $data['link_back'] = anchor('ouvrage/index/', 'Back to list of ouvrage', array('class' => 'back'));
        $data['link_edit'] = anchor('ouvrage/update/' . $id, 'Update', array('class' => 'update'));
        // get param details
        $ouvrage = $this->model->get_by_id("ouvrage", $id, "code_de_l_ouvrage")->row();
        $data['ouvrage'] = $ouvrage;
        $data['projet'] = $this->model->getEntity("SELECT * FROM projet WHERE code_projet=" . $ouvrage->code_projet)->row();
        $data['entreprise'] = $this->model->getEntity("SELECT * FROM entreprise WHERE code_entreprise=" . $ouvrage->code_entreprise . ";")->row();
        // load view

        $this->template->layout('sidebar_default', 'ouvrage/ouvrageView', $data);
    }

    function update($id = 0) {
        if ($id == 0) {
            $table_base = $this->session->userdata('ouvrage');
            $id = $table_base->code_ouvrage;
        }
        $table = 'ouvrage';

        $ouvrage = $this->model->get_by_id($table, $id, "code_de_l_ouvrage")->row();
        $projet = $this->model->list_all('projet')->result();
        $entreprise = $this->model->list_all('entreprise')->result();
        $data['projets'] = $projet;
        $data['entreprises'] = $entreprise;
// set empty default form field values
        $this->form_data = new stdclass;
        $this->form_data->code_entreprise = $this->model->getEntity("SELECT * FROM entreprise WHERE code_entreprise=" . $ouvrage->code_entreprise . ";")->row();
        
        $this->form_data->code_projet = $this->model->getEntity("SELECT * FROM projet WHERE code_projet=" . $ouvrage->code_projet)->row();
        $this->form_data->population_desservie = $ouvrage->population_desservie;
        $this->form_data->date_de_realisation = $ouvrage->date_de_realisation;
        $this->form_data->coordonnees_en_x = $ouvrage->coordonnees_en_x;
        $this->form_data->coordonees_en_y = $ouvrage->coordonees_en_y;
        $this->form_data->coordonnees_en_z = $ouvrage->coordonnees_en_z;
        $this->form_data->etat_de_l_ouvrage = $ouvrage->etat_de_l_ouvrage;


        // set common properties
        // set common properties
        $data['title'] = 'Modifier l\'ouvrage :';
        //		$data['message'] = '';
        $data['action'] = site_url('ouvrage/update/' . $ouvrage->code_de_l_ouvrage);
        $data['link_back'] = anchor('ouvrage/index/', 'Back to list of projet', array('class' => 'back'));
        if (isset($_POST['enregistrer'])) {
            // set validation properties
            $this->form_validation->set_rules('code_entreprise', 'code entreprise', 'trim|required');
            $this->form_validation->set_rules('code_projet', 'code projet', 'trim|required');
            $this->form_validation->set_rules('population_desservie', 'population desservie', 'trim|required');
            $this->form_validation->set_rules('date_de_realisation', 'date de realisation', 'trim|required');
            $this->form_validation->set_rules('coordonnees_en_x', 'coordonnees en X', 'trim|required');
            $this->form_validation->set_rules('coordonees_en_y', 'coordonnees en Y', 'trim|required');
            $this->form_validation->set_rules('coordonnees_en_z', 'coordonnees en Z', 'trim|required');
            $this->form_validation->set_rules('etat_de_l_ouvrage', 'etat de l\'ouvrage', 'trim|required');

            // run validation
            if ($this->form_validation->run() == FALSE) {

                $data['message'] = 'les champs marques * sont obligatoire veuillez verifier votre formulaire!!';
            } else {
                // save data
                $region = array(
                    'code_de_l_ouvrage' => $ouvrage->code_de_l_ouvrage,
                    'code_entreprise' => $this->input->post('code_entreprise'),
                    'code_projet' => $this->input->post('code_projet'),
                    'population_desservie' => $this->input->post('population_desservie'),
                    'date_de_realisation' => $this->input->post('date_de_realisation'),
                    'coordonnees_en_x' => $this->input->post('coordonnees_en_x'),
                    'coordonees_en_y' => $this->input->post('coordonees_en_y'),
                    'coordonnees_en_z' => $this->input->post('coordonnees_en_z'),
                    'etat_de_l_ouvrage' => $this->input->post('etat_de_l_ouvrage')
                );

                $this->model->update($table, 'code_de_l_ouvrage', $id, $region);
                $this->session->set_flashdata('succes', 'ouvrage modifier avec succes!!');
                redirect('ouvrage/index/');
            }
        } else {
            
        }
        // load view

        $this->template->layout('sidebar_default', 'ouvrage/ouvrageEdit', $data);
    }

    function delete($id) {
        // delete param
        $this->model->delete("ouvrage", 'code_de_l_ouvrage', $id);
        $this->session->set_flashdata('succes', 'ouvrage supprime avec succes!!');
        redirect('ouvrage/index', 'refresh');
    }

}

?>
