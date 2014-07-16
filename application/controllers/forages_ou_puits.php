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
class Forages_ou_puits extends CI_Controller {

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
        $table = 'forages_ou_puits';
        // load data
        $ouvrages = $this->model->get_paged_list($table, $this->limit, $offset)->result();

//	// generate pagination
        $this->load->library('pagination');
        $config['base_url'] = site_url('forages_ou_puits/index/');
        $config['total_rows'] = $this->model->count_all('forages_ou_puits');
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
                    $ouvrage->date_de_realisation, 
                    anchor('forages_ou_puits/view/' . $source->code_de_l_ouvrage, 'View', array('class' => 'view')) . ' ' .
                    anchor('forages_ou_puits/update_phaseOne/' . $source->code_de_l_ouvrage, 'Update', array('class' => 'update')) . ' ' .
                    anchor('forages_ou_puits/delete/' . $source->code_de_l_ouvrage, 'Delete', array('class' => 'delete', 'onclick' => "return confirm('Are you sure want to delete this ouvrage ?')"))
            );
        }
        $data['table'] = $this->table->generate();

        $this->template->layout('sidebar_default', 'forages_ou_puits/ouvrageListForages_ou_puits', $data);
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

        $source = $this->model->get_by_id('forages_ou_puits', $id, "code_de_l_ouvrage")->row();
        $this->form_data->profondeur = $source->profondeur;
        $this->form_data->hauteur_d_eau = $source->hauteur_d_eau;
        $this->form_data->niveau_statique_de_l_eau = $source->niveau_statique_de_l_eau;
        $this->form_data->niveau_top_crepine = $source->niveau_top_crepine;
        $this->form_data->transmissivite = $source->transmissivite;
        $this->form_data->coefficient_d_emmagasinement = $source->coefficient_d_emmagasinement;
        $this->form_data->diametre_de_perforation = $source->diametre_de_perforation;
        $this->form_data->debit_d_exploitation_debit_speci = $source->debit_d_exploitation_debit_speci;
        $this->form_data->type_de_nappe = $source->type_de_nappe;
        $this->form_data->type_de_porosite = $source->type_de_porosite;
        $this->form_data->debit = $source->debit;
        $this->form_data->perimetre_de_protection = $source->perimetre_de_protection;

        $data['projets'] = $this->model->list_all('projet')->result();
        $data['entreprises'] = $this->model->list_all('entreprise')->result();
        $data['localites'] = $this->model->list_all('localites')->result();
        $data['title'] = 'Modifier l\'ouvrage :';
        //		$data['message'] = '';
        $data['action'] = site_url('forages_ou_puits/update/' . $id);
        $data['link_back'] = anchor('forages_ou_puits/', 'Back to list of projet', array('class' => 'back'));
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
            $this->form_validation->set_rules('profondeur', 'Profondeur', 'trim|required');
            $this->form_validation->set_rules('hauteur_d_eau', 'hauteur d eau', 'trim|required');
            $this->form_validation->set_rules('niveau_statique_de_l_eau', 'niveau statique de l eau', 'trim|required');
            $this->form_validation->set_rules('niveau_top_crepine', 'niveau top crepine', 'trim|required');
            $this->form_validation->set_rules('transmissivite', 'transmissivite', 'trim|required');
            $this->form_validation->set_rules('coefficient_d_emmagasinement', 'coefficient d emmagasinement', 'trim|required');
            $this->form_validation->set_rules('diametre_de_perforation', 'diametre de perforation', 'trim|required');
            $this->form_validation->set_rules('debit_d_exploitation_debit_speci', 'debit d exploitation debit speci', 'trim|required');
            $this->form_validation->set_rules('type_de_nappe', 'type de nappe', 'trim|required');
            $this->form_validation->set_rules('type_de_porosite', 'type de porosite', 'trim|required');
            $this->form_validation->set_rules('debit', 'debit', 'trim|required');
            $this->form_validation->set_rules('perimetre_de_protection', 'perimetre_de_protection', 'trim|required');
            $this->form_validation->set_message('required', '* Champ obligatoire');
            // run validation
//            if ($this->form_validation->run() == FALSE) {
//                $data['message'] = 'les champs marques * sont obligatoire veuillez verifier votre formulaire!!';
//            } else {
                // save data

                $ouvrage = array(
                    'code_de_l_ouvrage' => $id,
//                    'code_entreprise' => $this->input->post('code_entreprise'),
//                    'code_projet' => $this->input->post('code_projet'),
                    'population_desservie' => $this->input->post('population_desservie'),
                    'date_de_realisation' => $this->input->post('date_de_realisation'),
                    'coordonnees_en_x' => $this->input->post('coordonnees_en_x'),
                    'coordonees_en_y' => $this->input->post('coordonees_en_y'),
                    'type_ouvrage' => $this->input->post('type_ouvrage'),
                    'code_de_la_localite' => $this->input->post('code_de_la_localite'),
//                    'etat_de_l_ouvrage' => $this->input->post('etat_de_l_ouvrage'),
                    'type_ouvrage' => 1
                );

                if($this->input->post('type_de_nappe')==='Autre')
                    $type_nappe =  $this->input->post('type_de_nappe_autre');
                else $type_nappe =  $this->input->post('type_de_nappe');
                if($this->input->post('type_de_porosite')==='Autre')
                    $type_porosite =  $this->input->post('type_de_porosite_autre');
                else $type_porosite =  $this->input->post('type_de_porosite');
                $region = array(
                    'code_de_l_ouvrage' => $id,
                    'profondeur' => $this->input->post('profondeur'),
                    'hauteur_d_eau' => $this->input->post('hauteur_d_eau'),
                    'niveau_statique_de_l_eau' => $this->input->post('niveau_statique_de_l_eau'),
                    'niveau_top_crepine' => $this->input->post('niveau_top_crepine'),
                    'transmissivite' => $this->input->post('transmissivite'),
                    'coefficient_d_emmagasinement' => $this->input->post('coefficient_d_emmagasinement'),
                    'diametre_de_perforation' => $this->input->post('diametre_de_perforation'),
                    'debit_d_exploitation_debit_speci' => $this->input->post('debit_d_exploitation_debit_speci'),
                    'type_de_nappe' => $type_nappe,
                    'type_de_porosite' => $type_porosite,
                    'debit' => $this->input->post('debit'),
                    'perimetre_de_protection' => $this->input->post('perimetre_de_protection')
                );
                $this->model->update('ouvrage', 'code_de_l_ouvrage', $id, $ouvrage);
                $source = $this->model->getEntity("SELECT * FROM forages_ou_puits WHERE code_de_l_ouvrage=" . $id . ";")->row();
                $this->model->update('forages_ou_puits', 'code_forage_puit', $source->code_forage_puit, $region);

                $this->session->set_flashdata('succes', 'ouvrage modifier avec succes!!');
                redirect('forages_ou_puits');
            
        } else {
            
        }
        // load view

        $this->template->layout('sidebar_default', 'forages_ou_puits/ouvrageUpdateForages_ou_puits', $data);
    }
    function add() {
//
        $table = 'ouvrage';

        $this->form_data = new stdclass;
        $this->form_data->code_entreprise =''; 
        $this->form_data->code_projet = '';
        $this->form_data->population_desservie = '';
        $this->form_data->date_de_realisation = '';
        $this->form_data->coordonnees_en_x = '';
        $this->form_data->coordonees_en_y = '';
        $this->form_data->etat_de_l_ouvrage = '';
        $this->form_data->type_ouvrage = '';
        $this->form_data->code_de_la_localite = '';

        
        $this->form_data->profondeur = '';
        $this->form_data->hauteur_d_eau = '';
        $this->form_data->niveau_statique_de_l_eau = '';
        $this->form_data->niveau_top_crepine = '';
        $this->form_data->transmissivite = '';
        $this->form_data->coefficient_d_emmagasinement = '';
        $this->form_data->diametre_de_perforation = '';
        $this->form_data->debit_d_exploitation_debit_speci = '';
        $this->form_data->type_de_nappe = '';
        $this->form_data->type_de_porosite = '';
        $this->form_data->debit = '';
        $this->form_data->perimetre_de_protection = '';

        $data['regions'] = $this->Param_model->get_regionlist()->result();
        $data['departements'] = $this->Param_model->get_departementlist()->result();
        $data['arrondissements'] = $this->Param_model->get_arrondissementlist()->result();
        $data['projets'] = $this->model->list_all('projet')->result();
        $data['entreprises'] = $this->model->list_all('entreprise')->result();
        $data['localites'] = $this->model->list_all('localites')->result();
        $data['title'] = 'Modifier l\'ouvrage :';
        //		$data['message'] = '';
        $data['action'] = site_url('forages_ou_puits/add/');
        $data['link_back'] = anchor('forages_ou_puits/', 'Back to list of projet', array('class' => 'back'));
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
            $this->form_validation->set_message('required', '* Champ obligatoire');
//
            $this->form_validation->set_rules('profondeur', 'Profondeur', 'trim|required');
            $this->form_validation->set_rules('hauteur_d_eau', 'hauteur d eau', 'trim|required');
            $this->form_validation->set_rules('niveau_statique_de_l_eau', 'niveau statique de l eau', 'trim|required');
            $this->form_validation->set_rules('niveau_top_crepine', 'niveau top crepine', 'trim|required');
            $this->form_validation->set_rules('transmissivite', 'transmissivite', 'trim|required');
            $this->form_validation->set_rules('coefficient_d_emmagasinement', 'coefficient d emmagasinement', 'trim|required');
            $this->form_validation->set_rules('diametre_de_perforation', 'diametre de perforation', 'trim|required');
            $this->form_validation->set_rules('debit_d_exploitation_debit_speci', 'debit d exploitation debit speci', 'trim|required');
////            $this->form_validation->set_rules('type_de_nappe', 'type de nappe', 'trim|required');
////            $this->form_validation->set_rules('type_de_porosite', 'type de porosite', 'trim|required');
            $this->form_validation->set_rules('debit', 'debit', 'trim|required');
            $this->form_validation->set_rules('perimetre_de_protection', 'perimetre_de_protection', 'trim|required');
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
                    'type_ouvrage' => 1
                );
                $idouvrage = $this->model->save('ouvrage', $ouvrage);
				
							$longt = $this->input->post('coordonnees_en_x');
                $lat = $this->input->post('coordonees_en_y');
                $this->model->add_geom_param($table, $longt, $lat, "code_de_l_ouvrage", $idouvrage);
				
                if($this->input->post('type_de_nappe')==='Autre')
                    $type_nappe =  $this->input->post('type_de_nappe_autre');
                else $type_nappe =  $this->input->post('type_de_nappe');
                if($this->input->post('type_de_porosite')==='Autre')
                    $type_porosite =  $this->input->post('type_de_porosite_autre');
                else $type_porosite =  $this->input->post('type_de_porosite');
                $region = array(
                    'code_de_l_ouvrage' => $idouvrage,
                    'profondeur' => $this->input->post('profondeur'),
                    'hauteur_d_eau' => $this->input->post('hauteur_d_eau'),
                    'niveau_statique_de_l_eau' => $this->input->post('niveau_statique_de_l_eau'),
                    'niveau_top_crepine' => $this->input->post('niveau_top_crepine'),
                    'transmissivite' => $this->input->post('transmissivite'),
                    'coefficient_d_emmagasinement' => $this->input->post('coefficient_d_emmagasinement'),
                    'diametre_de_perforation' => $this->input->post('diametre_de_perforation'),
                    'debit_d_exploitation_debit_speci' => $this->input->post('debit_d_exploitation_debit_speci'),
                    'type_de_nappe' => $type_nappe,
                    'type_de_porosite' => $type_porosite,
                    'debit' => $this->input->post('debit'),
                    'perimetre_de_protection' => $this->input->post('perimetre_de_protection')
                );
                $this->model->save('forages_ou_puits', $region);
                
                
                $this->session->set_flashdata('succes', 'ouvrage Enregistrer avec succes!!');
                redirect('forages_ou_puits');
            }
        } else {
            
        }
        // load view

        $this->template->layout('sidebar_default', 'forages_ou_puits/ouvrageEditForages_ou_puits', $data);
    }
    /**
     * 
     * @param type $id
     */


    function view($id) {
        // set common properties
        $data['title'] = ' Details';
        $data['link_back'] = anchor('forages_ou_puits/index/', 'Back to list of projet', array('class' => 'back'));
        $data['link_edit'] = anchor('forages_ou_puits/update/' . $id, 'Update', array('class' => 'update'));
        // get param details
        $source = $this->model->get_by_id('forages_ou_puits', $id, "code_de_l_ouvrage")->row();
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
        $this->template->layout('sidebar_default', 'forages_ou_puits/ouvrageViewForages_ou_puits', $data);
    }

    function delete($id) {
        $this->model->delete("forages_ou_puits", 'code_de_l_ouvrage', $id);
        $this->model->delete("ouvrage", 'code_de_l_ouvrage', $id);
        $this->session->set_flashdata('succes', 'ouvrage supprime avec succes!!');
        redirect('forages_ou_puits/index', 'refresh');
    }

}

?>
