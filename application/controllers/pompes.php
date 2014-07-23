<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pompe
 *
 * @author romuald
 */
class Pompes extends CI_Controller {

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
        $table = 'pompes';
        // load data
        $pompes = $this->model->get_paged_list($table, $this->limit, $offset)->result();

//	// generate pagination
        $this->load->library('pagination');
        $config['base_url'] = site_url('pompes/index/');
        $config['total_rows'] = $this->model->count_all('pompes');
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $uri_segment;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        // generate table data
        $this->load->library('table');
        $this->table->set_empty("&nbsp;");
        $this->table->set_heading('No', 'Type de Pompe ', 'Date d\'installation', 'Etat', 'Actions');
        $i = 0 + $offset;
        foreach ($pompes as $pompe) {
            $this->table->add_row(++$i, $pompe->type_de_pompe, $pompe->date_d_installation, $pompe->etat_de_la_pompe, anchor('pompes/view/' . $pompe->code_pompe, 'View', array('class' => 'view')) . ' ' .
                    anchor('pompes/update/' . $pompe->code_pompe, 'Update', array('class' => 'update')) . ' ' .
                    anchor('pompes/delete/' . $pompe->code_pompe, 'Delete', array('class' => 'delete', 'onclick' => "return confirm('Are you sure want to delete this pompe ?')"))
            );
        }
        $data['table'] = $this->table->generate();

        // load view
//		$this->load->view('personList', $projets);
//	$this->template->layout('sidebar_default', 'welcome_message', $data);
        $this->template->layout('sidebar_default', 'pompes/pompeList', $data);
    }

    /**
     * fontion de mise de l'pompe suivant le deuxième scénario
     * @param type $id : l'identifiant de l'pompe
     */
    function update($id = 0) {

        $pompe = $this->model->get_by_id('pompes', $id, "code_pompe")->row();
        $ouvrage = $this->model->getEntity('select ouvrage.* from ouvrage,forages_ou_puits 
            where ouvrage.code_de_l_ouvrage=forages_ou_puits.code_de_l_ouvrage and 
            forages_ou_puits.code_forage_puit = ' . $pompe->code_forage_puit)->row();

        // set empty default form field values
        $this->form_data = new stdclass;
        $this->form_data->code_de_l_ouvrage = $ouvrage;
        $this->form_data->marque_de_la_pompe = $pompe->marque_de_la_pompe;
        $this->form_data->type_de_pompe = $pompe->type_de_pompe;
        $this->form_data->diametre = $pompe->diametre;
        $this->form_data->profondeur = $pompe->profondeur;
        $this->form_data->date_d_installation = $pompe->date_d_installation;
        $this->form_data->debit_nominal_de_la_pompe = $pompe->debit_nominal_de_la_pompe;
        $this->form_data->debit_maximal_de_la_pompe = $pompe->debit_maximal_de_la_pompe;
        $this->form_data->puissance_de_la_pompe = $pompe->puissance_de_la_pompe;
        $this->form_data->consommation_de_la_pompe = $pompe->consommation_de_la_pompe;
        $this->form_data->etat_de_la_pompe = $pompe->etat_de_la_pompe;


        $data['projets'] = $this->model->list_all('projet')->result();
        $data['ouvrages'] = $data['ouvrages'] = $this->model->getEntities('select ouvrage.* from forages_ou_puits,ouvrage where forages_ou_puits.code_de_l_ouvrage=ouvrage.code_de_l_ouvrage')->result();
        $data['title'] = 'Modifier la pompe';
        //		$data['message'] = '';
        $data['action'] = site_url('pompes/update/' . $pompe->code_pompe);
        $data['link_back'] = anchor('pompes/index/', 'Back to list of projet', array('class' => 'back'));
        if (isset($_POST['enregistrer'])) {
            // set validation properties
            $this->form_validation->set_rules('code_de_l_ouvrage', 'Ouvrage', 'trim|required');
            $this->form_validation->set_rules('marque_de_la_pompe', 'marque de la pompe', 'trim|required');
            $this->form_validation->set_rules('type_de_pompe', 'type de pompe', 'trim|required');
            $this->form_validation->set_rules('diametre', 'diametre', 'trim|required');
            $this->form_validation->set_rules('profondeur', 'Profondeur', 'trim|required');
            $this->form_validation->set_rules('date_d_installation', 'date d\'installation', 'trim|required');
            $this->form_validation->set_rules('debit_nominal_de_la_pompe', 'debit nominal de la pompe', 'trim|required');
            $this->form_validation->set_rules('debit_maximal_de_la_pompe', 'debit maximal de la pompe', 'trim|required');
            $this->form_validation->set_rules('puissance_de_la_pompe', 'puissance de la pompe', 'trim|required');
            $this->form_validation->set_rules('consommation_de_la_pompe', 'consommation de la pompe', 'trim|required');
            $this->form_validation->set_rules('etat_de_la_pompe', 'etat_de_la_pompe', 'trim|required');
            $this->form_validation->set_message('required', '* Champ obligatoire');
            // run validation
            if ($this->form_validation->run() == FALSE) {

                $data['message'] = 'les champs marques * sont obligatoire veuillez verifier votre formulaire!!';
            } else {
                // save data
                $source = $this->model->getEntity("SELECT * FROM forages_ou_puits WHERE code_de_l_ouvrage=" . $this->input->post('code_de_l_ouvrage') . ";")->row();
                $region = array(
                    'code_pompe' => $id,
                    'code_forage_puit' => $source->code_forage_puit,
                    'marque_de_la_pompe' => $this->input->post('marque_de_la_pompe'),
                    'type_de_pompe' => $this->input->post('type_de_pompe'),
                    'diametre' => $this->input->post('diametre'),
                    'profondeur' => $this->input->post('profondeur'),
                    'date_d_installation' => $this->input->post('date_d_installation'),
                    'debit_nominal_de_la_pompe' => $this->input->post('debit_nominal_de_la_pompe'),
                    'debit_maximal_de_la_pompe' => $this->input->post('debit_maximal_de_la_pompe'),
                    'puissance_de_la_pompe' => $this->input->post('puissance_de_la_pompe'),
                    'consommation_de_la_pompe' => $this->input->post('consommation_de_la_pompe'),
                    'etat_de_la_pompe' => $this->input->post('etat_de_la_pompe')
                );
                $this->model->update('pompes', 'code_pompe', $id, $region);
                $this->session->set_flashdata('succes', 'pompe modifier avec succes!!');
                redirect('pompes/index/');
            }
        } else {
            
        }
        // load view
        $this->template->layout('sidebar_default', 'pompes/pompeEdit', $data);
    }

    /**
     * 
     */
    function add() {
        // set empty default form field values
        $this->form_data = new stdclass;
        $this->form_data->code_de_l_ouvrage = "";
        $this->form_data->marque_de_la_pompe = "";
        $this->form_data->type_de_pompe = "";
        $this->form_data->diametre = "";
        $this->form_data->profondeur = "";
        $this->form_data->date_d_installation = "";
        $this->form_data->debit_nominal_de_la_pompe = "";
        $this->form_data->debit_maximal_de_la_pompe = "";
        $this->form_data->puissance_de_la_pompe = "";
        $this->form_data->consommation_de_la_pompe = "";
        $this->form_data->etat_de_la_pompe = "";

        $data['ouvrages'] = $this->model->getEntities('select ouvrage.* from forages_ou_puits,ouvrage where forages_ou_puits.code_de_l_ouvrage=ouvrage.code_de_l_ouvrage')->result();
        $data['title'] = 'Nouvelle Pompe ';
        //		$data['message'] = '';
        $data['action'] = site_url('pompes/add/');
        $data['link_back'] = anchor('pompes/index/', 'Back to list of projet', array('class' => 'back'));
        if (isset($_POST['enregistrer'])) {
            // set validation properties
            $this->form_validation->set_rules('code_de_l_ouvrage', 'Ouvrage', 'trim|required');
            $this->form_validation->set_rules('marque_de_la_pompe', 'marque de la pompe', 'trim|required');
            $this->form_validation->set_rules('type_de_pompe', 'type de pompe', 'trim|required');
            $this->form_validation->set_rules('diametre', 'diametre', 'trim|required');
            $this->form_validation->set_rules('profondeur', 'Profondeur', 'trim|required');
            $this->form_validation->set_rules('date_d_installation', 'date d\'installation', 'trim|required');
            $this->form_validation->set_rules('debit_nominal_de_la_pompe', 'debit nominal de la pompe', 'trim|required');
            $this->form_validation->set_rules('debit_maximal_de_la_pompe', 'debit maximal de la pompe', 'trim|required');
            $this->form_validation->set_rules('puissance_de_la_pompe', 'puissance_de_la_pompe', 'trim|required');
            $this->form_validation->set_rules('consommation_de_la_pompe', 'consommation de la pompe', 'trim|required');
            $this->form_validation->set_rules('etat_de_la_pompe', 'etat_de_la_pompe', 'trim|required');

            $this->form_validation->set_message('required', '* Champ obligatoire');
            // run validation
            if ($this->form_validation->run() == FALSE) {
                $data['message'] = 'les champs marques * sont obligatoire veuillez verifier votre formulaire!!';
            } else {
                // save data
                $source = $this->model->getEntity("SELECT * FROM forages_ou_puits WHERE code_de_l_ouvrage=" . $this->input->post('code_de_l_ouvrage') . ";")->row();
                $pompe = array(
                    'code_forage_puit' => $source->code_forage_puit,
                    'marque_de_la_pompe' => $this->input->post('marque_de_la_pompe'),
                    'type_de_pompe' => $this->input->post('type_de_pompe'),
                    'diametre' => $this->input->post('diametre'),
                    'profondeur' => $this->input->post('profondeur'),
                    'date_d_installation' => $this->input->post('date_d_installation'),
                    'debit_nominal_de_la_pompe' => $this->input->post('debit_nominal_de_la_pompe'),
                    'debit_maximal_de_la_pompe' => $this->input->post('debit_maximal_de_la_pompe'),
                    'puissance_de_la_pompe' => $this->input->post('puissance_de_la_pompe'),
                    'consommation_de_la_pompe' => $this->input->post('consommation_de_la_pompe'),
                    'etat_de_la_pompe' => $this->input->post('etat_de_la_pompe')
                );
                $idpompe = $this->model->save('pompes', $pompe);

                $this->session->set_flashdata('succes', 'pompe modifier avec succes!!');
                redirect('pompes/index/');
            }
        } else {
            
        }
        // load view

        $this->template->layout('sidebar_default', 'pompes/pompeEdit', $data);
    }

    function view($id) {
        // set common properties
        $data['title'] = ' Details Pompe';
        $data['link_back'] = anchor('pompes/index/', 'Back to list of projet', array('class' => 'back'));
        $data['link_edit'] = anchor('pompes/update/' . $id, 'Update', array('class' => 'update'));
        // get param details
        $pompe = $this->model->get_by_id('pompes', $id, "code_pompe")->row();
        $projet = $this->model->getEntity('select projet.* from projet,ouvrage,forages_ou_puits 
            where (projet.code_projet=ouvrage.code_projet and 
            ouvrage.code_de_l_ouvrage=forages_ou_puits.code_de_l_ouvrage and 
            forages_ou_puits.code_forage_puit = ' . $pompe->code_forage_puit . ')')->row();
        $ouvrage = $this->model->getEntity('select ouvrage.* from ouvrage,forages_ou_puits 
            where ouvrage.code_de_l_ouvrage=forages_ou_puits.code_de_l_ouvrage and 
            forages_ou_puits.code_forage_puit = ' . $pompe->code_forage_puit)->row();

        $data['pompe'] = $pompe;
        $data['projet'] = $projet;
        $data['ouvrage'] = $ouvrage;

        // load view
        $this->template->layout('sidebar_default', 'pompes/pompeView', $data);
    }

    function delete($id) {
        $this->model->delete("pompes", 'code_pompe', $id);
        $this->session->set_flashdata('succes', 'pompe supprime avec succes!!');
        redirect('pompes/index', 'refresh');
    }

}

?>
