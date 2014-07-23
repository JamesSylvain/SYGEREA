<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bailleur extends CI_Controller {

    // num of records per page
    private $limit = 10;

    function __construct() {
        parent::__construct();

        // load library
        $this->load->library(array('table', 'form_validation'));
        $this->form_validation->set_error_delimiters('<p class="msg error" style="min-height: 10px; line-height: 11px; width: 340px;">', '</p>');
        // load helper
        $this->load->helper('url');

        // load model
        $this->load->model('Bailleur_model', '', TRUE);

        if (!$this->ion_auth->logged_in()) {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
    }

    function index($offset = 0) {
        $data['$id_bailleur'] = 'submenu-active';
        // offset
        $uri_segment = 3;
        $offset = $this->uri->segment($uri_segment);

        // load data
        $bailleurs = $this->Bailleur_model->get_paged_list($this->limit, $offset)->result();

        // generate pagination
        $this->load->library('pagination');
        $config['base_url'] = site_url('bailleur/index/');
        $config['total_rows'] = $this->Bailleur_model->count_all();
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $uri_segment;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        // generate table data
        $this->load->library('table');
        $this->table->set_empty("&nbsp;");
        $this->table->set_heading('No', 'Denomination', 'Type Bailleur', 'Actions');
        $options = array(1 => 'Etat', 2 => 'Organisme international', 3 => 'ONG', 4 => 'Particuliers');
        $i = 0 + $offset;
        foreach ($bailleurs as $bailleur) {
            foreach ($options as $key => $value) {
                if ($bailleur->type_bailleur == $key) {
                    $type_bailleur = $value;
                }
            }
            $this->table->add_row(++$i, $bailleur->denomination, $type_bailleur, anchor('bailleur/view/' . $bailleur->code_bailleur, 'details', array('class' => 'view')) . ' ' .
                    anchor('bailleur/updatebailleur/' . $bailleur->code_bailleur, 'modifier', array('class' => 'update')) . ' ' .
                    anchor('bailleur/delete/' . $bailleur->code_bailleur, 'supprimer', array('class' => 'delete', 'onclick' => "return confirm('voulez vous supprimer ce bailleur?')"))
            );
        }
        $data['table'] = $this->table->generate();

        // load view
        //	$this->load->view('personList', $data);

        $this->template->layout('sidebar_projet', 'bailleur/bailleurList', $data);
    }

    function addbailleur() {
        $data['$id_bailleur'] = 'submenu-active';
        // set empty default form field values
        $this->form_data = new stdclass;
        $this->form_data->code_bailleur = '';
        $this->form_data->denomination = '';
        $this->form_data->type_bailleur = '';

        // set common properties
        $data['title'] = 'Ajouter un Bailleur :';
        $data['options'] = array(1 => 'Etat', 2 => 'Organisme international', 3 => 'ONG', 4 => 'Particuliers');
        //		$data['message'] = '';
        $data['action'] = site_url('bailleur/addbailleur');


        if (isset($_POST['enregistrer'])) {

            // set validation properties
            $this->form_validation->set_rules('denomination', 'Denomination', 'trim|required');

            //	$this->form_validation->set_message('required', '* Champ obligatoire');
            // run validation
            if ($this->form_validation->run() == FALSE) {

                $data['message'] = 'les champs marques * sont obligatoire veuillez verifier votre formulaire!!';
            } else {

                // save data
                $bailleur = array('type_bailleur' => $this->input->post('type_bailleur'),
                    'denomination' => $this->input->post('denomination'));

                $idbailleur = $this->Bailleur_model->save($bailleur);
                $this->session->set_flashdata('succes', 'bailleur enregistre avec succes!!');
                redirect('bailleur/');
            }
        } else {
            
        }
        // load view

        $this->template->layout('sidebar_projet', 'bailleur/bailleurEdit', $data);
    }

    function view($id) {
        $data['$id_bailleur'] = 'submenu-active';
        // set common properties
        $data['title'] = 'Details du Bailleur ';
        $data['options'] = array(1 => 'Etat', 2 => 'Organisme international', 3 => 'ONG', 4 => 'Particuliers');

        // get bailleur details
        $data['bailleur'] = $this->Bailleur_model->get_by_code_bailleur($id)->row();

        // load view

        $this->template->layout('sidebar_projet', 'bailleur/bailleurView', $data);
    }

    function updatebailleur($code_bailleur) {
        $data['$id_bailleur'] = 'submenu-active';
        $data['bailleur'] = $bailleur = $this->Bailleur_model->get_by_code_bailleur($code_bailleur)->row();
        // set common properties
        $data['title'] = 'modifier ce bailleur';
        $data['action'] = site_url('bailleur/updatebailleur/' . $code_bailleur);
        $data['options'] = array(1 => 'Etat', 2 => 'Organisme international', 3 => 'ONG', 4 => 'Particuliers');

        $this->form_data = new stdclass;
        $this->form_data->code_bailleur = $bailleur->code_bailleur;
        $this->form_data->denomination = $bailleur->denomination;
        $this->form_data->type_bailleur = $bailleur->type_bailleur;

        if (isset($_POST['enregistrer'])) {

            // set validation properties
            $this->form_validation->set_rules('denomination', 'Denomination du bailleur', 'trim|required');

            // run validation
            if ($this->form_validation->run() == FALSE) {
                $data['message'] = 'les champs marques * sont obligatoire veuillez verifier votre formulaire!!';
            } else {
                // save data
                $bailleur = array('type_bailleur' => $this->input->post('type_bailleur'),
                    'denomination' => $this->input->post('denomination'));
                $this->Bailleur_model->update($code_bailleur, $bailleur);

                // set user message
                $this->session->set_flashdata('succes', 'bailleur modifier avec succes!!');
                redirect('bailleur/');
            }
        }
        // load view

        $this->template->layout('sidebar_projet', 'bailleur/bailleurEdit', $data);
    }

    function delete($id) {
        $data['$id_bailleur'] = 'submenu-active';
        // delete bailleur
        $this->Bailleur_model->delete($id);

        // redirect to bailleur list page
        redirect('bailleur/index/', 'refresh');
    }

    function financement($offset = 0) {
        // offset
        $data['$id_fin_projet'] = 'submenu-active';
        $uri_segment = 3;
        $offset = $this->uri->segment($uri_segment);

        // load data
        $finances = $this->Bailleur_model->get_paged_list_finance($this->limit, $offset)->result();

        // generate pagination
        $this->load->library('pagination');
        $config['base_url'] = site_url('bailleur/financement/');
        $config['total_rows'] = $this->Bailleur_model->count_all_finance();
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $uri_segment;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        // generate table data
        $this->load->library('table');
        $this->table->set_empty("&nbsp;");
        $this->table->set_heading('No', 'Bailleur', 'Type Bailleur', 'Projet', 'Montant Financment', 'Annee Financement', 'Actions');
        $options = array(1 => 'Etat', 2 => 'Organisme international', 3 => 'ONG', 4 => 'Particuliers');
        $i = 0 + $offset;
        foreach ($finances as $finance) {
            foreach ($options as $key => $value) {
                if ($finance->type_bailleur == $key) {
                    $type_bailleur = $value;
                }
            }
            $this->table->add_row(++$i, $finance->nom_bailleur, $type_bailleur, $finance->nom_projet, $finance->montant_financement, $finance->annee_financement, anchor('bailleur/view_finance/' . $finance->code_finance, 'details', array('class' => 'view')) . ' ' .
                    anchor('bailleur/update_finance/' . $finance->code_finance, 'modifier', array('class' => 'update')) . ' ' .
                    anchor('bailleur/delete_finance/' . $finance->code_finance, 'supprimer', array('class' => 'delete', 'onclick' => "return confirm('voulez vous supprimer ce financement?')"))
            );
        }
        $data['table'] = $this->table->generate();

        // load view

        $this->template->layout('sidebar_projet', 'bailleur/financeList', $data);
    }

    function financer_projet() {
        $data['$id_fin_projet'] = 'submenu-active';
        // set empty default form field values
        $this->form_data = new stdclass;
        $this->form_data->code_bailleur = '';
        $this->form_data->code_projet = '';
        $this->form_data->annee_financement = '';
        $this->form_data->montant_financement = '';

        // set common properties
        $data['title'] = 'Ajouter un Financement de projet :';
        //		$data['message'] = '';
        $data['action'] = site_url('bailleur/financer_projet');
        $data['bailleurs'] = $this->Bailleur_model->get_bailleurlist()->result();
        $data['projets'] = $this->Bailleur_model->get_projetlist()->result();


        if (isset($_POST['enregistrer'])) {


            // set validation properties
            $this->form_validation->set_rules('code_bailleur', 'Nom du bailleur', 'trim|required');
            $this->form_validation->set_rules('code_projet', 'Nom du projet', 'trim|required');
            $this->form_validation->set_rules('montant_financement', 'Montant financement', 'trim|required');

            //	$this->form_validation->set_message('required', '* Champ obligatoire');
            // run validation
            if ($this->form_validation->run() == FALSE) {

                $data['message'] = 'les champs marques * sont obligatoire veuillez verifier votre formulaire!!';
            } elseif ($this->verify_duplicate_finance($_POST)) {
                echo 'on entre';
                $this->session->set_flashdata('warning', 'ce financement existe deja !!');
                redirect('bailleur/financer_projet/');
            } else {
                //var_dump($_POST);exit;
                // save data
                $financer = array('code_bailleur' => $this->input->post('code_bailleur'),
                    'code_projet' => $this->input->post('code_projet'),
                    'annee_financement' => $this->input->post('annee_financement'),
                    'montant_financement' => $this->input->post('montant_financement')
                );

                $idfinance = $this->Bailleur_model->save_finance($financer);
                $this->session->set_flashdata('succes', 'financement enregistre avec succes!!');
                redirect('bailleur/financement/');
            }
        } else {
            
        }
        // load view

        $this->template->layout('sidebar_projet', 'bailleur/financeEdit', $data);
    }

    function verify_duplicate_finance($finance) {
        $data['$id_fin_projet'] = 'submenu-active';
        $bailleur = $finance['code_bailleur'];
        $projet = $finance['code_projet'];

        $resultat = $this->Bailleur_model->verify_finance($bailleur, $projet)->result();

        if (count($resultat) > 0) {
            return true;
        } else {

            return false;
        }
    }

    function view_finance($code_finance) {
        $data['$id_fin_projet'] = 'submenu-active';
        // set common properties
        $data['title'] = 'Details du Financement ';

        // get finance details
        $data['finance'] = $finance = $this->Bailleur_model->get_by_code_finance($code_finance)->row();

        $options = array(1 => 'Etat', 2 => 'Organisme international', 3 => 'ONG', 4 => 'Particuliers');

        foreach ($options as $key => $value) {
            if ($finance->type_bailleur == $key) {
                $data['finance']->type_bailleur = $value;
            }
        }
        // load view

        $this->template->layout('sidebar_projet', 'bailleur/financeView', $data);
    }

    function update_finance($code_finance) {
        $data['$id_fin_projet'] = 'submenu-active';
        $finance = $this->Bailleur_model->get_by_code_finance($code_finance)->row();

        // set empty default form field values
        $this->form_data = new stdclass;
        $this->form_data->code_bailleur = $finance->code_bailleur;
        $this->form_data->code_projet = $finance->code_projet;
        $this->form_data->annee_financement = $finance->annee_financement;
        $this->form_data->montant_financement = $finance->montant_financement;

        // set common properties
        $data['title'] = 'Modifier ce Financement de projet :';
        //		$data['message'] = '';
        $data['action'] = site_url('bailleur/update_finance/' . $code_finance);
        $data['bailleurs'] = $this->Bailleur_model->get_bailleurlist()->result();
        $data['projets'] = $this->Bailleur_model->get_projetlist()->result();


        if (isset($_POST['enregistrer'])) {


            // set validation properties
            $this->form_validation->set_rules('code_bailleur', 'Nom du bailleur', 'trim|required');
            $this->form_validation->set_rules('code_projet', 'Nom du projet', 'trim|required');
            $this->form_validation->set_rules('montant_financement', 'Montant financement', 'trim|required');

            //	$this->form_validation->set_message('required', '* Champ obligatoire');
            // run validation
            if ($this->form_validation->run() == FALSE) {

                $data['message'] = 'les champs marques * sont obligatoire veuillez verifier votre formulaire!!';
            } else {

                // save data
                $financer = array('code_bailleur' => $this->input->post('code_bailleur'),
                    'code_projet' => $this->input->post('code_projet'),
                    'annee_financement' => $this->input->post('annee_financement'),
                    'montant_financement' => $this->input->post('montant_financement')
                );

                $this->Bailleur_model->update_finance($code_finance, $financer);
                $this->session->set_flashdata('succes', 'financement modifier avec succes!!');
                redirect('bailleur/financement/');
            }
        } else {
            
        }
        // load view

        $this->template->layout('sidebar_projet', 'bailleur/financeEdit', $data);
    }

    function delete_finance($code_finance) {

        // delete financement
        $this->Bailleur_model->delete_finance($code_finance);

        // redirect to financement list page
        redirect('bailleur/financement/', 'refresh');
    }

}

?>