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
class Ouvrage extends CI_Controller   {
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
    function index($offset = 0)
	{
		// offset
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		$table = 'ouvrage';
		// load data
		$entreprises = $this->model->get_paged_list($table,$this->limit, $offset)->result();
		
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
		$this->table->set_heading('No', 'Entreprise ','Projet','Population','Date Réalisation','Coord-X','Coord-Y','Coord-Z','Actions');
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

}

?>
