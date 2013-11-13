<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserController extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
	
	}
	
	public function reply_question() {
		echo $question_id = $this->input->post('question_id');
		echo $category_id = $this->input->post('category_id');
		echo $question_answer = $this->input->post('answer');
		echo $username = $this->input->post('user_id');
		//if($question_id != "" && $question_answer != "" && $username != "")
		//{
			$this->load->model('table_user');
			$user_id = $this->table_user->get_user_id($username);
			$this->load->model('table_answer');
			$this->table_answer->insert_new_answer($question_id, $category_id, $question_answer, $user_id);
			redirect('/questionController/show_question/?id='.$question_id.'');
		//}
	}
	
	public function my_profile() {
		if(!$this->session->userdata('username')) {
			redirect(base_url().'main/register', refresh);
		}
		$this->load->model('table_user');
		$data['profile'] = $this->table_user->get_user_profile($this->session->userdata('username'));
		if($data['profile']['id']!= "") {
			$this->load->model('table_question');
			$data['question_list'] = $this->table_question->list_question($data['profile']['id']);
			$this->load->view('user_profile', $data);
		}
	}
	
	public function check_username() {
		$username = $_GET['username'];
		$this->load->model('table_user');
		if($this->table_user->check_username($username))
		{
			echo $message = "1";
		}
		else {echo $message = "2";}
		return $message;
	}
	
	public function check_email() {
		$email = $_GET['email'];
		$this->load->model('table_user');
		if($this->table_user->check_email($email))
		{
			echo $message = "1";
		}
		else {echo $message = "2";}
		return $message;
	}
	
	public function register_confirm() {
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));
		$email = $this->input->post('email');
		$phone = $this->input->post('phone');
		$this->load->model('table_user');
		if($this->table_user->add_user($username, $password, $email, $phone))
		{
			$data = array (
				'username' => $username,
				'is_logged_in' => 1
			);
			$this->session->set_userdata($data);
			$topic = "Welcom to use Technique Question Search";
			$content = "Dear ".$username.", Thank you very much to register.";
			$this->load->model('email');
			$this->email->send_email($email, $topic, $content);
			redirect('main');
		}
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */