<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller {

	// num of records per page
	private $limit = 10;
	
	function __construct()
	{
		parent::__construct();
		
		// load library
		$this->load->library(array('table','form_validation'));
		
		// load helper
		$this->load->helper('url');
		
		if (!$this->ion_auth->logged_in())
		{
			//redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		// load model
		$this->load->model('Search_model','',TRUE);
	}
	
	function index($offset = 0)
	{
	
		$data['title'] = 'Rechercher ouvrages';
		$data['action'] = site_url('search/index/');
		$data['regions'] = $this->Param_model->get_regionlist()->result();
	
	if(isset($_POST['enregistrer'])){
		//var_dump($_POST);exit;
		$ouvrages = $this->Search_model->search_ouvrage($_POST);	
		var_dump($ouvrages);exit;
	}
		$this->template->layout('sidebar_search', 'search/search', $data);

	}
	
	function searchOuvrage(){
	
	
	}
	
}
?>