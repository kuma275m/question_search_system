<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function index()
	{
		$this->search_engine();
	}
  
	public function search_engine()
	{
		$this->load->model('table_category');
		$data['category'] = $this->table_category->list_category();
		$this->load->view('search_engine', $data);
	}
	
	public function search()
	{
		$str = $this->input->post('keywords');
		$category = $this->input->post('category');
		$this->load->model('table_question');
		$result['list'] = $this->table_question->list_search_result($str, $category);
		$result['sum'] = count($result['list']);
		$this->load->model('table_category');
		$result['category'] = $this->table_category->list_category();
		$this->load->view('search_result', $result);
	}
	public function list_keyword()
	{
		
	}
	public function register()
	{
		if(!$this->session->userdata('is_logged_in')) {
			$this->load->view('user_register');
		}
		else {
			redirect('/', 'refresh');
		}
		
	}
	/* Login */	
	public function login_validation()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required|callback_validate_credentials');
		$this->form_validation->set_rules('password', 'Password', 'required|md5');
		
		if($this->form_validation->run()) {
			$data = array (
				'username' => $this->input->post('username'),
				'is_logged_in' => 1
			);
			$this->session->set_userdata($data);
			redirect('main');
		}
		else {
			//$this->load->view('search_engine');
			$data['message'] = "We are sorry, the username or password is incorrect.";
			$this->load->view('message', $data);
		}
	}
	
	public function validate_credentials()
	{
		$this->load->model('table_user');
		if ($this->table_user->can_log_in()) {
			return true;
		}
		else {
			$this->form_validation->set_message('validate_credentials', 'Incorret username or password!');
			return false;
		}
	}
		
	public function logout() 
	{
		$this->session->sess_destroy();
		redirect('/', 'refresh');
	}
}
