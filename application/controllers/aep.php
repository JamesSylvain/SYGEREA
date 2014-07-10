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
class Aep extends CI_Controller {

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
        $table = 'aep';
        // load data
        $ouvrages = $this->model->get_paged_list($table, $this->limit, $offset)->result();

//	// generate pagination
        $this->load->library('pagination');
        $config['base_url'] = site_url('aep/index/');
        $config['total_rows'] = $this->model->count_all('aep');
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $uri_segment;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        // generate table data
        $this->load->library('table');
        $this->table->set_empty("&nbsp;");
        $this->table->set_heading('No', 'Entreprise ', 'Projet', 'Population', 'Date Réalisation', 'Actions');
        $i = 0 + $offset;
        foreach ($ouvrages as $ouvrage) {
            $projet = $this->model->getEntity('select projet.* from projet,ouvrage where projet.code_projet=ouvrage.code_projet and ouvrage.code_de_l_ouvrage=' . $ouvrage->code_de_l_ouvrage)->row();
            $entreprise = $this->model->getEntity('select entreprise.* from entreprise,ouvrage where entreprise.code_entreprise=ouvrage.code_entreprise and ouvrage.code_de_l_ouvrage=' . $ouvrage->code_de_l_ouvrage)->row();
            $this->table->add_row(++$i, anchor('entreprise/view/' . $entreprise->code_entreprise, strtoupper($entreprise->nom_de_l_entreprise), array()), anchor('projet/view/' . $projet->code_projet, strtoupper($projet->libelle_du_projet), array()), $ouvrage->population_desservie, $ouvrage->date_de_realisation, anchor('aep/view/' . $ouvrage->code_de_l_ouvrage, 'View', array('class' => 'view')) . ' ' .
                    anchor('aep/update/' . $ouvrage->code_de_l_ouvrage, 'Update', array('class' => 'update')) . ' ' .
                    anchor('aep/delete/' . $ouvrage->code_de_l_ouvrage, 'Delete', array('class' => 'delete', 'onclick' => "return confirm('Are you sure want to delete this ouvrage ?')"))
            );
        }
        $data['table'] = $this->table->generate();

        // load view
//		$this->load->view('personList', $projets);
//	$this->template->layout('sidebar_default', 'welcome_message', $data);
        $this->template->layout('sidebar_default', 'aep/ouvrageList', $data);
    }

    /**
     * fontion de mise de l'ouvrage suivant le deuxième scénario
     * @param type $id : l'identifiant de l'ouvrage
     */
    function update($id = 0) {

        $ouvrage = $this->model->get_by_id('aep', $id, "code_de_l_ouvrage")->row();
        $projet = $this->model->getEntity('select projet.* from projet,ouvrage where projet.code_projet=ouvrage.code_projet and ouvrage.code_de_l_ouvrage=' . $ouvrage->code_de_l_ouvrage)->row();
        $entreprise = $this->model->getEntity('select entreprise.* from entreprise,ouvrage where entreprise.code_entreprise=ouvrage.code_entreprise and ouvrage.code_de_l_ouvrage=' . $ouvrage->code_de_l_ouvrage)->row();
        // set empty default form field values
        $this->form_data = new stdclass;
        $this->form_data->code_entreprise = $entreprise;
        $this->form_data->code_projet = $projet;
        $this->form_data->profondeur = $ouvrage->profondeur;
        $this->form_data->hauteur_d_eau = $ouvrage->hauteur_d_eau;
        $this->form_data->niveau_statique_de_l_eau = $ouvrage->niveau_statique_de_l_eau;
        $this->form_data->niveau_top_crepine = $ouvrage->niveau_top_crepine;
        $this->form_data->transmissivite = $ouvrage->transmissivite;
        $this->form_data->coefficient_d_emmagasinement = $ouvrage->coefficient_d_emmagasinement;
        $this->form_data->diametre_de_perforation = $ouvrage->diametre;
        $this->form_data->debit_d_exploitation_debit_speci = $ouvrage->debit_d_exploitation_debit_speci;
        $this->form_data->debit = $ouvrage->debit;
        $this->form_data->perimetre_de_protection = $ouvrage->perimetre_de_protection;
        $this->form_data->type_d_aep = $ouvrage->type_d_aep;
        $this->form_data->population_desservie = $ouvrage->population_desservie;
        $this->form_data->date_de_realisation = $ouvrage->date_de_realisation;
        $this->form_data->coordonnees_en_x = $ouvrage->coordonnees_en_x;
        $this->form_data->coordonees_en_y = $ouvrage->coordonees_en_y;
        $this->form_data->coordonnees_en_z = $ouvrage->coordonnees_en_z;
        $this->form_data->etat_de_l_ouvrage = $ouvrage->etat_de_l_ouvrage;

        $data['projets'] = $this->model->list_all('projet')->result();
        $data['entreprises'] = $this->model->list_all('entreprise')->result();
        $data['title'] = 'Modifier l\'ouvrage :';
        //		$data['message'] = '';
        $data['action'] = site_url('aep/update/' . $ouvrage->code_de_l_ouvrage);
        $data['link_back'] = anchor('aep/index/', 'Back to list of projet', array('class' => 'back'));
        if (isset($_POST['enregistrer'])) {
            // set validation properties
            $this->form_validation->set_rules('code_entreprise', 'code entreprise', 'trim|required');
            $this->form_validation->set_rules('code_projet', 'code projet', 'trim|required');
            $this->form_validation->set_rules('profondeur', 'Profondeur', 'trim|required');
            $this->form_validation->set_rules('hauteur_d_eau', 'hauteur d_\'eau', 'trim|required');
            $this->form_validation->set_rules('niveau_statique_de_l_eau', 'niveau statique de l\'eau', 'trim|required');
            $this->form_validation->set_rules('niveau_top_crepine', 'niveau top crepine', 'trim|required');
            $this->form_validation->set_rules('transmissivite', 'transmissivite', 'trim|required');
            $this->form_validation->set_rules('coefficient_d_emmagasinement', 'coefficient d\'emmagasinement', 'trim|required');
            $this->form_validation->set_rules('diametre_de_perforation', 'diametre de perforation', 'trim|required');
            $this->form_validation->set_rules('debit_d_exploitation_debit_speci', 'debit d\'exploitation debit speci', 'trim|required');

            $this->form_validation->set_rules('debit', 'debit', 'trim|required');
            $this->form_validation->set_rules('perimetre_de_protection', 'perimetre de protection', 'trim|required');
            $this->form_validation->set_rules('type_d_aep', 'type d\'_aep', 'trim|required');

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
                    'code_de_l_ouvrage' => $ouvrage->code_de_l_ouvrage,
//                    'code_entreprise' => $this->input->post('code_entreprise'),
//                    'code_projet' => $this->input->post('code_projet'),
                    'profondeur' => $this->input->post('profondeur'),
                    'hauteur_d_eau' => $this->input->post('hauteur_d_eau'),
                    'niveau_statique_de_l_eau' => $this->input->post('niveau_statique_de_l_eau'),
                    'niveau_top_crepine' => $this->input->post('niveau_top_crepine'),
                    'transmissivite' => $this->input->post('transmissivite'),
                    'coefficient_d_emmagasinement' => $this->input->post('coefficient_d_emmagasinement'),
                    'diametre' => $this->input->post('diametre_de_perforation'),
                    'debit_d_exploitation_debit_speci' => $this->input->post('debit_d_exploitation_debit_speci'),
                    'debit' => $this->input->post('debit'),
                    'perimetre_de_protection' => $this->input->post('perimetre_de_protection'),
                    'type_d_aep' => $this->input->post('type_d_aep'),
                    'population_desservie' => $this->input->post('population_desservie'),
                    'date_de_realisation' => $this->input->post('date_de_realisation'),
                    'coordonnees_en_x' => $this->input->post('coordonnees_en_x'),
                    'coordonees_en_y' => $this->input->post('coordonees_en_y'),
                    'coordonnees_en_z' => $this->input->post('coordonnees_en_z'),
                    'etat_de_l_ouvrage' => $this->input->post('etat_de_l_ouvrage')
                );
                $this->model->update('aep', 'code_de_l_ouvrage', $id, $region);

                $ouvrage = array(
                    'code_entreprise' => $this->input->post('code_entreprise'),
                    'code_projet' => $this->input->post('code_projet'),
                    'population_desservie' => $this->input->post('population_desservie'),
                    'date_de_realisation' => $this->input->post('date_de_realisation'),
                    'coordonnees_en_x' => $this->input->post('coordonnees_en_x'),
                    'coordonees_en_y' => $this->input->post('coordonees_en_y'),
                    'coordonnees_en_z' => $this->input->post('coordonnees_en_z'),
                    'etat_de_l_ouvrage' => $this->input->post('etat_de_l_ouvrage')
                );
                $this->model->update('ouvrage', 'code_de_l_ouvrage', $ouvrage->code_de_l_ouvrage, $ouvrage);

                $hydraulique = array(
                    'debit' => $this->input->post('debit'),
                    'perimetre_de_protection' => $this->input->post('perimetre_de_protection')
                );
                $this->model->update('hydraulique', 'code_de_l_ouvrage', $ouvrage->code_de_l_ouvrage, $hydraulique);

                $this->session->set_flashdata('succes', 'ouvrage modifier avec succes!!');
                redirect('aep/index/');
            }
        } else {
            
        }
        // load view

        $this->template->layout('sidebar_default', 'aep/ouvrageUpdate', $data);
    }

    /**
     * 
     */
    function add() {
        // set empty default form field values
        $this->form_data = new stdclass;
        $this->form_data->code_entreprise = "";
        $this->form_data->code_projet = "";
        $this->form_data->profondeur = "";
        $this->form_data->hauteur_d_eau = "";
        $this->form_data->niveau_statique_de_l_eau = "";
        $this->form_data->niveau_top_crepine = "";
        $this->form_data->transmissivite = "";
        $this->form_data->coefficient_d_emmagasinement = "";
        $this->form_data->diametre_de_perforation = "";
        $this->form_data->debit_d_exploitation_debit_speci = "";
        $this->form_data->debit = "";
        $this->form_data->perimetre_de_protection = "";
        $this->form_data->type_d_aep = "";
        $this->form_data->population_desservie = "";
        $this->form_data->date_de_realisation = "";
        $this->form_data->coordonnees_en_x = "";
        $this->form_data->coordonees_en_y = "";
        $this->form_data->coordonnees_en_z = "";
        $this->form_data->etat_de_l_ouvrage = "";

        $data['projets'] = $this->model->list_all('projet')->result();
        $data['entreprises'] = $this->model->list_all('entreprise')->result();
        $data['title'] = 'Modifier l\'ouvrage :';
        //		$data['message'] = '';
        $data['action'] = site_url('aep/add/');
        $data['link_back'] = anchor('aep/index/', 'Back to list of projet', array('class' => 'back'));
        if (isset($_POST['enregistrer'])) {
            // set validation properties
            $this->form_validation->set_rules('code_entreprise', 'code entreprise', 'trim|required');
            $this->form_validation->set_rules('code_projet', 'code projet', 'trim|required');
            $this->form_validation->set_rules('profondeur', 'Profondeur', 'trim|required');
            $this->form_validation->set_rules('hauteur_d_eau', 'hauteur d_\'eau', 'trim|required');
            $this->form_validation->set_rules('niveau_statique_de_l_eau', 'niveau statique de l\'eau', 'trim|required');
            $this->form_validation->set_rules('niveau_top_crepine', 'niveau top crepine', 'trim|required');
            $this->form_validation->set_rules('transmissivite', 'transmissivite', 'trim|required');
            $this->form_validation->set_rules('coefficient_d_emmagasinement', 'coefficient d\'emmagasinement', 'trim|required');
            $this->form_validation->set_rules('diametre_de_perforation', 'diametre de perforation', 'trim|required');
            $this->form_validation->set_rules('debit_d_exploitation_debit_speci', 'debit d\'exploitation debit speci', 'trim|required');

            $this->form_validation->set_rules('debit', 'debit', 'trim|required');
            $this->form_validation->set_rules('perimetre_de_protection', 'perimetre de protection', 'trim|required');
            $this->form_validation->set_rules('type_d_aep', 'type d\'aep', 'trim|required');

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

                $ouvrage = array(
                    'code_entreprise' => $this->input->post('code_entreprise'),
                    'code_projet' => $this->input->post('code_projet'),
                    'population_desservie' => $this->input->post('population_desservie'),
                    'date_de_realisation' => $this->input->post('date_de_realisation'),
                    'coordonnees_en_x' => $this->input->post('coordonnees_en_x'),
                    'coordonees_en_y' => $this->input->post('coordonees_en_y'),
                    'coordonnees_en_z' => $this->input->post('coordonnees_en_z'),
                    'etat_de_l_ouvrage' => $this->input->post('etat_de_l_ouvrage')
                );
                $idouvrage = $this->model->save('ouvrage', $ouvrage);

                $hydraulique = array(
                    'code_de_l_ouvrage' => $idouvrage,
                    'debit' => $this->input->post('debit'),
                    'perimetre_de_protection' => $this->input->post('perimetre_de_protection'),
                    'population_desservie' => $this->input->post('population_desservie'),
                    'date_de_realisation' => $this->input->post('date_de_realisation'),
                    'coordonnees_en_x' => $this->input->post('coordonnees_en_x'),
                    'coordonees_en_y' => $this->input->post('coordonees_en_y'),
                    'coordonnees_en_z' => $this->input->post('coordonnees_en_z'),
                    'etat_de_l_ouvrage' => $this->input->post('etat_de_l_ouvrage')
                );
                $this->model->save('hydraulique', $hydraulique);

                $region = array(
                    'code_de_l_ouvrage' => $idouvrage,
//                    'code_entreprise' => $this->input->post('code_entreprise'),
//                    'code_projet' => $this->input->post('code_projet'),
                    'profondeur' => $this->input->post('profondeur'),
                    'hauteur_d_eau' => $this->input->post('hauteur_d_eau'),
                    'niveau_statique_de_l_eau' => $this->input->post('niveau_statique_de_l_eau'),
                    'niveau_top_crepine' => $this->input->post('niveau_top_crepine'),
                    'transmissivite' => $this->input->post('transmissivite'),
                    'coefficient_d_emmagasinement' => $this->input->post('coefficient_d_emmagasinement'),
                    'diametre' => $this->input->post('diametre_de_perforation'),
                    'debit_d_exploitation_debit_speci' => $this->input->post('debit_d_exploitation_debit_speci'),
                    'type_d_aep' => $this->input->post('type_d_aep'),                     
                    'debit' => $this->input->post('debit'),
                    'perimetre_de_protection' => $this->input->post('perimetre_de_protection'),
                    'population_desservie' => $this->input->post('population_desservie'),
                    'date_de_realisation' => $this->input->post('date_de_realisation'),
                    'coordonnees_en_x' => $this->input->post('coordonnees_en_x'),
                    'coordonees_en_y' => $this->input->post('coordonees_en_y'),
                    'coordonnees_en_z' => $this->input->post('coordonnees_en_z'),
                    'etat_de_l_ouvrage' => $this->input->post('etat_de_l_ouvrage')
                );
                $this->model->save('aep',$region);


                $this->session->set_flashdata('succes', 'ouvrage modifier avec succes!!');
                redirect('aep/index/');
            }
        } else {
            
        }
        // load view

        $this->template->layout('sidebar_default', 'aep/ouvrageUpdate', $data);
    }


    function view($id) {
        // set common properties
        $data['title'] = ' Details';
        $data['link_back'] = anchor('aep/index/', 'Back to list of projet', array('class' => 'back'));
        $data['link_edit'] = anchor('aep/update/' . $id, 'Update', array('class' => 'update'));
        // get param details
        $ouvrage = $this->model->get_by_id('aep', $id, "code_de_l_ouvrage")->row();
        $projet = $this->model->getEntity('select projet.* from projet,ouvrage where projet.code_projet=ouvrage.code_projet and ouvrage.code_de_l_ouvrage=' . $ouvrage->code_de_l_ouvrage)->row();
        $entreprise = $this->model->getEntity('select entreprise.* from entreprise,ouvrage where entreprise.code_entreprise=ouvrage.code_entreprise and ouvrage.code_de_l_ouvrage=' . $ouvrage->code_de_l_ouvrage)->row();
        $data['ouvrage'] = $ouvrage;
        $data['projet'] = $projet;
        $data['entreprise'] = $entreprise;

        // load view
        $this->template->layout('sidebar_default', 'aep/ouvrageView', $data);
    }

    function delete($id) {
        $this->model->delete("aep", 'code_de_l_ouvrage', $id);
        $this->model->delete("hydraulique", 'code_de_l_ouvrage', $id);
        $this->model->delete("ouvrage", 'code_de_l_ouvrage', $id);
        $this->session->set_flashdata('succes', 'ouvrage supprime avec succes!!');
        redirect('aep/index', 'refresh');
    }

}

?>
