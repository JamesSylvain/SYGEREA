<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of hydrolique
 *
 * @author romuald
 */
class Hydraulique extends CI_Controller {

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
    }

    function index($offset = 0) {
        // offset
        $uri_segment = 3;
        $offset = $this->uri->segment($uri_segment);
        $table = 'hydraulique';
        // load data
        $ouvrages = $this->model->get_paged_list($table, $this->limit, $offset)->result();

//		// generate pagination
        $this->load->library('pagination');
        $config['base_url'] = site_url('hydraulique/index/');
        $config['total_rows'] = $this->model->count_all('hydraulique');
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $uri_segment;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        // generate table data
        $this->load->library('table');
        $this->table->set_empty("&nbsp;");
        $this->table->set_heading('No', 'Entreprise ', 'Projet', 'Débit', 'Perimetre de protection', 'Actions');
        $i = 0 + $offset;
        foreach ($ouvrages as $ouvrage) {
            $projet = $this->model->getEntity("SELECT * FROM projet WHERE code_projet=" . $ouvrage->code_projet)->row();
            $entreprise = $this->model->getEntity("SELECT entreprise.* FROM entreprise,ouvrage WHERE entreprise.code_entreprise=ouvrage.code_entreprise and  ouvrage.code_entreprise=" . $ouvrage->code_entreprise . ";")->row();
            $this->table->add_row(++$i, anchor('entreprise/view/' . $entreprise->code_entreprise, $entreprise->nom_de_l_entreprise, array('class' => 'view')), anchor('projet/view/' . $projet->code_projet, $projet->code_projet, array('class' => 'view')), $ouvrage->population_desservie, $ouvrage->date_de_realisation,
//                    anchor('hydraulique/view/' . $ouvrage->code_de_l_ouvrage, 'View', array('class' => 'view')) . ' ' .
                    anchor('hydraulique/update/' . $ouvrage->code_de_l_ouvrage, 'Update', array('class' => 'update')) . ' ' .
                    anchor('hydraulique/delete/' . $ouvrage->code_de_l_ouvrage, 'Delete', array('class' => 'delete', 'onclick' => "return confirm('Are you sure want to delete this ouvrage ?')"))
            );
        }
        $data['table'] = $this->table->generate();

        // load view
//		$this->load->view('personList', $projets);
//	$this->template->layout('sidebar_default', 'welcome_message', $data);
        $this->template->layout('sidebar_default', 'ouvrage_hydro/ouvrageList', $data);
    }

    function add() {
        $ouvrage = $this->session->userdata('ouvrage');
        $base_table = $this->session->userdata('table_base');
        if (!empty($base_table) && !is_null($base_table)) {
            if (empty($ouvrage) || is_null($ouvrage))
                redirect('ouvrage/add');
        }
        else
            redirect('ouvrage_sources_em/create_hydrau');

        $table = 'hydraulique';
        $table_base = $this->session->userdata('table_base');
        // set empty default form field values
        $this->form_data = new stdclass;

        $this->form_data->debit = '';
        $this->form_data->perimetre_de_protection = '';

        // set common properties
        $data['title'] = 'Ajouter une nouvelle Hydrolique :';
        //		$data['message'] = '';
        $data['action'] = site_url('hydraulique/add');
        $data['link_back'] = anchor('hydraulique/index/', 'Back to list of projet', array('class' => 'back'));
        if (isset($_POST['enregistrer'])) {
            // set validation properties
            $this->form_validation->set_rules('debit', 'debit', 'trim|required');
            $this->form_validation->set_rules('perimetre_de_protection', 'perimetre de protection', 'trim|required');

            $this->form_validation->set_message('required', '* Champ obligatoire');
            // run validation
            if ($this->form_validation->run() == FALSE) {
                $data['message'] = 'les champs marques * sont obligatoire veuillez verifier votre formulaire!!';
            } else {
                // save data
                $region = array(
                    'debit' => $this->input->post('debit'),
                    'perimetre_de_protection' => $this->input->post('perimetre_de_protection')
                );

                $this->session->set_userdata('hydraulique', $region);
                $this->session->set_flashdata('succes', 'Hydraulique enregistre avec succes!!');
                redirect($table_base.'/add');
            }
        } else {
            
        }
        // load view
        $this->template->layout('sidebar_default', 'ouvrage_hydro/ouvrageEdit', $data);
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

  

}

?>
