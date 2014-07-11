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
		
		// load model
		$this->load->model('Search_model','',TRUE);
	}
	
	function index($offset = 0)
	{
		// offset
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		
		// load data
		$searchs = $this->Search_model->get_paged_list($this->limit, $offset)->result();
		
		// generate pagination
		$this->load->library('pagination');
		$config['base_url'] = site_url('search/index/');
 		$config['total_rows'] = $this->Search_model->count_all();
 		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		// generate table data
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('No', 'Name', 'Gender', 'Date of Birth (dd-mm-yyyy)', 'Actions');
		$i = 0 + $offset;
		foreach ($searchs as $search)
		{
			$this->table->add_row(++$i, $search->name, strtoupper($search->gender)=='M'? 'Male':'Female', date('d-m-Y',strtotime($search->dob)), 
				anchor('search/view/'.$search->id,'view',array('class'=>'view')).' '.
				anchor('search/update/'.$search->id,'update',array('class'=>'update')).' '.
				anchor('search/delete/'.$search->id,'delete',array('class'=>'delete','onclick'=>"return confirm('Are you sure want to delete this search?')"))
			);
		}
		$data['table'] = $this->table->generate();
		
		// load view
	//	$this->load->view('searchList', $data);
	
		$this->template->layout('search/searchList', $data);

	}
	
	function add()
	{
		// set empty default form field values
		$this->_set_fields();
		// set validation properties
		$this->_set_rules();
		
		// set common properties
		$data['title'] = 'Add new search';
		$data['message'] = '';
		$data['action'] = site_url('search/addSearch');
		$data['link_back'] = anchor('search/index/','Back to list of searchs',array('class'=>'back'));
	
		// load view
		
		$this->template->layout('search/searchEdit', $data);
		
	}
	
	function addSearch()
	{
		// set common properties
		$data['title'] = 'Add new search';
		$data['action'] = site_url('search/addSearch');
		$data['link_back'] = anchor('search/index/','Back to list of searchs',array('class'=>'back'));
		
		// set empty default form field values
		$this->_set_fields();
		// set validation properties
		$this->_set_rules();
		
		// run validation
		if ($this->form_validation->run() == FALSE)
		{
			$data['message'] = '';
		}
		else
		{
			// save data
			$search = array('name' => $this->input->post('name'),
							'gender' => $this->input->post('gender'),
							'dob' => date('Y-m-d', strtotime($this->input->post('dob'))));
			$id = $this->Search_model->save($search);
			
			// set user message
			$data['message'] = '<div class="success">add new search success</div>';
		}
		
		// load view
		
		$this->template->layout('search/searchEdit', $data);
	}
	
	function view($id)
	{
		// set common properties
		$data['title'] = 'Search Details';
		$data['link_back'] = anchor('search/index/','Back to list of searchs',array('class'=>'back'));
		
		// get search details
		$data['search'] = $this->Search_model->get_by_id($id)->row();
		
		// load view
		
		$this->template->layout('search/searchView', $data);
	}
	
	function update($id)
	{
		// set validation properties
		$this->_set_rules();
		
		// prefill form values
		$search = $this->Search_model->get_by_id($id)->row();
		$this->form_data->id = $id;
		$this->form_data->name = $search->name;
		$this->form_data->gender = strtoupper($search->gender);
		$this->form_data->dob = date('d-m-Y',strtotime($search->dob));
		
		// set common properties
		$data['title'] = 'Update search';
		$data['message'] = '';
		$data['action'] = site_url('search/updateSearch');
		$data['link_back'] = anchor('search/index/','Back to list of searchs',array('class'=>'back'));
	
		// load view
		
		$this->template->layout('search/searchEdit', $data);
		
	}
	
	function updateSearch()
	{
		// set common properties
		$data['title'] = 'Update search';
		$data['action'] = site_url('search/updateSearch');
		$data['link_back'] = anchor('search/index/','Back to list of searchs',array('class'=>'back'));
		
		// set empty default form field values
		$this->_set_fields();
		// set validation properties
		$this->_set_rules();
		
		// run validation
		if ($this->form_validation->run() == FALSE)
		{
			$data['message'] = '';
		}
		else
		{
			// save data
			$id = $this->input->post('id');
			$search = array('name' => $this->input->post('name'),
							'gender' => $this->input->post('gender'),
							'dob' => date('Y-m-d', strtotime($this->input->post('dob'))));
			$this->Search_model->update($id,$search);
			
			// set user message
			$data['message'] = '<div class="success">update search success</div>';
		}
		
		// load view
		
		$this->template->layout('search/searchEdit', $data);
		
	}
	
	function delete($id)
	{
		// delete search
		$this->Search_model->delete($id);
		
		// redirect to search list page
		redirect('search/index/','refresh');
	}
	
	// set empty default form field values
	function _set_fields()
	{
		$this->form_data->id = '';
		$this->form_data->name = '';
		$this->form_data->gender = '';
		$this->form_data->dob = '';
	}
	
	// validation rules
	function _set_rules()
	{
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('gender', 'Gender', 'trim|required');
		$this->form_validation->set_rules('dob', 'DoB', 'trim|required|callback_valid_date');
		
		$this->form_validation->set_message('required', '* required');
		$this->form_validation->set_message('isset', '* required');
		$this->form_validation->set_message('valid_date', 'date format is not valid. dd-mm-yyyy');
		$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
	}
	
	// date_validation callback
	function valid_date($str)
	{
		//match the format of the date
		if (preg_match ("/^([0-9]{2})-([0-9]{2})-([0-9]{4})$/", $str, $parts))
		{
			//check weather the date is valid of not
			if(checkdate($parts[2],$parts[1],$parts[3]))
				return true;
			else
				return false;
		}
		else
			return false;
	}
}
?>