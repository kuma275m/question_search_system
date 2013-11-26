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
	public function test()
	{
		//$this->load->model('time_class');
		echo $time = date("Y-m-d H:i:s",time()+2*60*60);
		//echo $time = strtotime("2013-11-26 12:17:20");
		echo "<br />";	
		//echo $show_time = strtotime('2013-11-13 15:18:20');
		//echo "<br />";
		//echo $show_time - $time;
		//echo $this->time_class->time_trans($time);
		echo $now_time = strtotime(date("Y-m-d H:i:s",time()+8*60*60));
		echo "<br />";
		echo $show_time = strtotime('2013-11-13 15:18:20');
		echo "<br />";
		echo $dur = $now_time-$show_time;
		echo "<br />";
		if($dur < 60){
			echo $dur.' seconds before';
		}
		else if($dur < 3600){
			echo floor($dur/60).' minutes before';
		}
		else if($dur < 86400){
			echo floor($dur/3600).' hours before';
		}
		else if($dur < 259200){//3天内
			echo floor($dur/86400).' days before';
		}
		else {
      		echo date("Y-m-d H:i:s", $show_time);
		}
	}
	
	public function search()
	{
		$str = $this->input->post('keywords');
		$category = $this->input->post('category');
		$this->load->model('table_question');
		$result['list'] = $this->table_question->list_search_result($str, $category);
		//$list = $this->table_question->list_search_result($str, $category);
		/*foreach ($result['list'] as $row)
		{
			$this->load->model('time');
			$row['add_time'] = 	$this->time->time_trans($row['add_time']);
		}*/
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
