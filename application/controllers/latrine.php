<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of aep
 *
 * @author romuald
 */
class Latrine extends CI_Controller {

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
        $table = 'latrine';
        // load data
        $ouvrages = $this->model->get_paged_list($table, $this->limit, $offset)->result();

//	// generate pagination
        $this->load->library('pagination');
        $config['base_url'] = site_url('latrine/index/');
        $config['total_rows'] = $this->model->count_all('latrine');
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $uri_segment;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        // generate table data
        $this->load->library('table');
        $this->table->set_empty("&nbsp;");
        $this->table->set_heading('No', 'Entreprise ', 'Projet', 'Localité', 'Date Réalisation', 'Actions');
        $i = 0 + $offset;
        foreach ($ouvrages as $source) {
            $projet = $this->model->getEntity('select projet.* from projet,ouvrage where projet.code_projet=ouvrage.code_projet and ouvrage.code_de_l_ouvrage=' . $source->code_de_l_ouvrage)->row();
            $entreprise = $this->model->getEntity('select entreprise.* from entreprise,ouvrage where entreprise.code_entreprise=ouvrage.code_entreprise and ouvrage.code_de_l_ouvrage=' . $source->code_de_l_ouvrage)->row();
            $localite = $this->model->getEntity("SELECT localites.* FROM localites,ouvrage WHERE ouvrage.code_de_la_localite=localites.code_de_la_localite and ouvrage.code_de_l_ouvrage=" . $source->code_de_l_ouvrage . ";")->row();
            $ouvrage = $this->model->getEntity("SELECT * FROM ouvrage WHERE ouvrage.code_de_l_ouvrage=" . $source->code_de_l_ouvrage . ";")->row();
            $this->table->add_row(++$i, anchor('entreprise/view/' . $entreprise->code_entreprise, strtoupper($entreprise->nom_de_l_entreprise), array()), 
                    anchor('projet/view/' . $projet->code_projet, strtoupper($projet->libelle_du_projet), array()), 
                    anchor('localite/view/' . $localite->code_de_la_localite, strtoupper($localite->nom), array()), 
                    $ouvrage->date_de_realisation, anchor('latrine/view/' . $source->code_de_l_ouvrage, 'View', array('class' => 'view')) . ' ' .
                    anchor('latrine/update/' . $source->code_de_l_ouvrage, 'Update', array('class' => 'update')) . ' ' .
                    anchor('latrine/delete/' . $source->code_de_l_ouvrage, 'Delete', array('class' => 'delete', 'onclick' => "return confirm('Are you sure want to delete this ouvrage ?')"))
            );
        }
        $data['table'] = $this->table->generate();


        // load view
//		$this->load->view('personList', $projets);
//	$this->template->layout('sidebar_default', 'welcome_message', $data);
        $this->template->layout('sidebar_default', 'latrine/ouvrageListLatrine', $data);
    }

    /**
     * fontion de mise de l'ouvrage suivant le deuxième scénario
     * @param type $id : l'identifiant de l'ouvrage
     */
    function update($id = 0) {
//
        $table = 'ouvrage';

        $ouvrage = $this->model->get_by_id($table, $id, "code_de_l_ouvrage")->row();
        $this->form_data = new stdclass;
        $this->form_data->code_entreprise = $this->model->getEntity("SELECT * FROM entreprise WHERE code_entreprise=" . $ouvrage->code_entreprise . ";")->row();
        $this->form_data->code_projet = $this->model->getEntity("SELECT * FROM projet WHERE code_projet=" . $ouvrage->code_projet)->row();
        $this->form_data->population_desservie = $ouvrage->population_desservie;
        $this->form_data->date_de_realisation = $ouvrage->date_de_realisation;
        $this->form_data->coordonnees_en_x = $ouvrage->coordonnees_en_x;
        $this->form_data->coordonees_en_y = $ouvrage->coordonees_en_y;
        $this->form_data->etat_de_l_ouvrage = $ouvrage->etat_de_l_ouvrage;
        $this->form_data->type_ouvrage = $ouvrage->type_ouvrage;
        $this->form_data->code_de_la_localite = $this->model->getEntity("SELECT * FROM localites WHERE code_de_la_localite=" . $ouvrage->code_de_la_localite)->row();

        $source = $this->model->get_by_id('latrine', $id, "code_de_l_ouvrage")->row();
        $this->form_data->type_latrine = $source->type_latrine;
        $this->form_data->nombre_de_cabines = $source->nombre_de_cabines;
        $this->form_data->profondeur = $source->profondeur;
        $this->form_data->etat = $source->etat;
        $this->form_data->description = $source->description;
        $this->form_data->nombre_de_fosses = $source->nombre_de_fosses;
        $this->form_data->volume = $source->volume;
        $this->form_data->code_de_l_ouvrage = $source->code_de_l_ouvrage;
        

        $data['projets'] = $this->model->list_all('projet')->result();
        $data['entreprises'] = $this->model->list_all('entreprise')->result();
        $data['localites'] = $this->model->list_all('localites')->result();
        $data['title'] = 'Modifier l\'ouvrage :';
        //		$data['message'] = '';
        $data['action'] = site_url('latrine/update/' . $id);
        $data['link_back'] = anchor('latrine/', 'Back to list of projet', array('class' => 'back'));
        if (isset($_POST['enregistrer'])) {
            // set validation properties
            $this->form_validation->set_rules('code_entreprise', 'code entreprise', 'trim|required');
            $this->form_validation->set_rules('code_projet', 'code projet', 'trim|required');
            $this->form_validation->set_rules('population_desservie', 'population desservie', 'trim|required');
            $this->form_validation->set_rules('date_de_realisation', 'date de realisation', 'trim|required');
            $this->form_validation->set_rules('coordonnees_en_x', 'coordonnees en X', 'trim|required');
            $this->form_validation->set_rules('coordonees_en_y', 'coordonnees en Y', 'trim|required');
            $this->form_validation->set_rules('etat_de_l_ouvrage', 'etat de l\'ouvrage', 'trim|required');
//            $this->form_validation->set_rules('type_ouvrage', 'type de ouvrage', 'trim|required');
            $this->form_validation->set_rules('code_de_la_localite', 'code de la localite', 'trim|required');
//            $this->form_validation->set_message('required', '* Champ obligatoire');
//
            $this->form_validation->set_rules('type_latrine', 'Type latrine', 'trim|required');
            $this->form_validation->set_rules('nombre_de_cabines', 'nombre de cabines', 'trim|required');
            $this->form_validation->set_rules('profondeur', 'profondeur', 'trim|required');
            $this->form_validation->set_rules('etat', 'etat', 'trim|required');
            $this->form_validation->set_rules('description', 'description', 'trim|required');
            $this->form_validation->set_rules('nombre_de_fosses', 'nombre de fosses', 'trim|required');
            $this->form_validation->set_rules('volume', 'volume', 'trim|required');
//            $this->form_validation->set_rules('type_de_porosite', 'type de porosite', 'trim|required');
            
            $this->form_validation->set_message('required', '* Champ obligatoire');
            // run validation
//            if ($this->form_validation->run() == FALSE) {
//                $data['message'] = 'les champs marques * sont obligatoire veuillez verifier votre formulaire!!';
//            } else {
            // save data

            $ouvrage = array(
                'code_de_l_ouvrage' => $id,
//                'code_entreprise' => $this->input->post('code_entreprise'),
//                'code_projet' => $this->input->post('code_projet'),
                'population_desservie' => $this->input->post('population_desservie'),
                'date_de_realisation' => $this->input->post('date_de_realisation'),
                'coordonnees_en_x' => $this->input->post('coordonnees_en_x'),
                'coordonees_en_y' => $this->input->post('coordonees_en_y'),
                'type_ouvrage' => $this->input->post('type_ouvrage'),
//                'code_de_la_localite' => $this->input->post('code_de_la_localite'),
                'etat_de_l_ouvrage' => $this->input->post('etat_de_l_ouvrage'),
                'type_ouvrage' => 2
            );
//            $this->model->update('ouvrage', 'code_de_l_ouvrage', $id, $region);

             $region = array(
                    'code_de_l_ouvrage' => $id,
                    'profondeur' => $this->input->post('profondeur'),
                    'type_latrine' => $this->input->post('type_latrine'),
                    'nombre_de_cabines' => $this->input->post('nombre_de_cabines'),
                    'etat' => $this->input->post('etat'),
                    'description' => $this->input->post('description'),
                    'nombre_de_fosses' => $this->input->post('nombre_de_fosses'),
                    'volume' => $this->input->post('volume')
                );
            $this->model->update('ouvrage', 'code_de_l_ouvrage', $id, $ouvrage);
            $source = $this->model->getEntity("SELECT * FROM latrine WHERE code_de_l_ouvrage=" . $id . ";")->row();
            $this->model->update('latrine', 'code_latrine', $source->code_latrine, $region);

            $this->session->set_flashdata('succes', 'ouvrage modifier avec succes!!');
            redirect('latrine');
        } else {
            
        }
        // load view

        $this->template->layout('sidebar_default', 'latrine/ouvrageUpdateLatrine', $data);
    }

    /**
     * 
     */
    function add() {
        // set empty default form field values
        $table = 'ouvrage';

        $this->form_data = new stdclass;
        $this->form_data->code_entreprise = '';
        $this->form_data->code_projet = '';
        $this->form_data->population_desservie = '';
        $this->form_data->date_de_realisation = '';
        $this->form_data->coordonnees_en_x = '';
        $this->form_data->coordonees_en_y = '';
        $this->form_data->etat_de_l_ouvrage = '';
        $this->form_data->type_ouvrage = '';
        $this->form_data->code_de_la_localite = '';

        $this->form_data->type_latrine = '';
        $this->form_data->nombre_de_cabines = '';
        $this->form_data->profondeur = '';
        $this->form_data->etat = '';
        $this->form_data->description = '';
        $this->form_data->nombre_de_fosses = '';
        $this->form_data->volume = '';
        $this->form_data->code_de_l_ouvrage = '';
        
        $data['regions'] = $this->Param_model->get_regionlist()->result();
        $data['departements'] = $this->Param_model->get_departementlist()->result();
        $data['arrondissements'] = $this->Param_model->get_arrondissementlist()->result();
        $data['projets'] = $this->model->list_all('projet')->result();
        $data['entreprises'] = $this->model->list_all('entreprise')->result();
        $data['localites'] = $this->model->list_all('localites')->result();
        $data['title'] = 'Modifier l\'ouvrage :';
        //		$data['message'] = '';
        $data['action'] = site_url('latrine/add/');
        $data['link_back'] = anchor('latrine/', 'Back to list of projet', array('class' => 'back'));
        if (isset($_POST['enregistrer'])) {
            // set validation properties
            $this->form_validation->set_rules('code_entreprise', 'code entreprise', 'trim|required');
            $this->form_validation->set_rules('code_projet', 'code projet', 'trim|required');
            $this->form_validation->set_rules('population_desservie', 'population desservie', 'trim|required');
            $this->form_validation->set_rules('date_de_realisation', 'date de realisation', 'trim|required');
            $this->form_validation->set_rules('coordonnees_en_x', 'coordonnees en X', 'trim|required');
            $this->form_validation->set_rules('coordonees_en_y', 'coordonnees en Y', 'trim|required');
            $this->form_validation->set_rules('etat_de_l_ouvrage', 'etat de l\'ouvrage', 'trim|required');
            $this->form_validation->set_rules('code_de_la_localite', 'code de la localite', 'trim|required');
            $this->form_validation->set_message('required', '* Champ obligatoire');
//
            $this->form_validation->set_rules('type_latrine', 'Type latrine', 'trim|required');
            $this->form_validation->set_rules('nombre_de_cabines', 'nombre de cabines', 'trim|required');
            $this->form_validation->set_rules('profondeur', 'profondeur', 'trim|required');
            $this->form_validation->set_rules('etat', 'etat', 'trim|required');
            $this->form_validation->set_rules('description', 'description', 'trim|required');
            $this->form_validation->set_rules('nombre_de_fosses', 'nombre de fosses', 'trim|required');
            $this->form_validation->set_rules('volume', 'volume', 'trim|required');
            
            $this->form_validation->set_message('required', '* Champ obligatoire');
            // run validation
            if ($this->form_validation->run() == FALSE) {
                $data['message'] = 'les champs marques * sont obligatoire veuillez verifier votre formulaire!!';
            } else {
                // save data

                $ouvrage = array(
                    'code_entreprise' => $this->input->post('code_entreprise'),
                    'code_projet' => $this->input->post('code_projet'),
                    'population_desservie' => $this->input->post('population_desservie'),
                    'date_de_realisation' => $this->input->post('date_de_realisation'),
                    'coordonnees_en_x' => $this->input->post('coordonnees_en_x'),
                    'coordonees_en_y' => $this->input->post('coordonees_en_y'),
                    'type_ouvrage' => $this->input->post('type_ouvrage'),
                    'code_de_la_localite' => $this->input->post('code_de_la_localite'),
                    'etat_de_l_ouvrage' => $this->input->post('etat_de_l_ouvrage'),
                    'type_ouvrage' => 2
                );
                $idouvrage = $this->model->save('ouvrage', $ouvrage);
				
								$longt = $this->input->post('coordonnees_en_x');
                $lat = $this->input->post('coordonees_en_y');
                $this->model->add_geom_param($table, $longt, $lat, "code_de_l_ouvrage", $idouvrage);

                $region = array(
                    'code_de_l_ouvrage' => $idouvrage,
                    'profondeur' => $this->input->post('profondeur'),
                    'type_latrine' => $this->input->post('type_latrine'),
                    'nombre_de_cabines' => $this->input->post('nombre_de_cabines'),
                    'etat' => $this->input->post('etat'),
                    'description' => $this->input->post('description'),
                    'nombre_de_fosses' => $this->input->post('nombre_de_fosses'),
                    'volume' => $this->input->post('volume')
                );
                $this->model->save('latrine', $region);

                $this->session->set_flashdata('succes', 'ouvrage modifier avec succes!!');
                redirect('latrine');
            }
        } else {
            
        }
        // load view
        // load view

        $this->template->layout('sidebar_default', 'latrine/ouvrageEditLatrine', $data);
    }

    function view($id) {
// set common properties
        $data['title'] = ' Details';
        $data['link_back'] = anchor('latrine/index/', 'Back to list of projet', array('class' => 'back'));
        $data['link_edit'] = anchor('latrine/update/' . $id, 'Update', array('class' => 'update'));
        // get param details
        $source = $this->model->get_by_id('latrine', $id, "code_de_l_ouvrage")->row();
        $projet = $this->model->getEntity('select projet.* from projet,ouvrage where projet.code_projet=ouvrage.code_projet and ouvrage.code_de_l_ouvrage=' . $source->code_de_l_ouvrage)->row();
        $entreprise = $this->model->getEntity('select entreprise.* from entreprise,ouvrage where entreprise.code_entreprise=ouvrage.code_entreprise and ouvrage.code_de_l_ouvrage=' . $source->code_de_l_ouvrage)->row();
        $ouvrage = $this->model->get_by_id('ouvrage', $id, "code_de_l_ouvrage")->row();
        $localite = $this->model->get_by_id('localites', $ouvrage->code_de_la_localite, "code_de_la_localite")->row();
        $data['source'] = $source;
        $data['ouvrage'] = $ouvrage;
        $data['projet'] = $projet;
        $data['entreprise'] = $entreprise;
        $data['localite'] = $localite;

        // load view
        $this->template->layout('sidebar_default', 'latrine/ouvrageViewLatrine', $data);
    }

    function delete($id) {
        $this->model->delete("latrine", 'code_de_l_ouvrage', $id);
        $this->model->delete("ouvrage", 'code_de_l_ouvrage', $id);
        $this->session->set_flashdata('succes', 'ouvrage supprime avec succes!!');
        redirect('aep/index', 'refresh');
    }

}

?>
