<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AnswerController extends CI_Controller {

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
		if($question_id != "" && $question_answer != "" && $username != "")
		{
			$this->load->model('table_user');
			$user_id = $this->table_user->get_user_id($username);
			$this->load->model('table_answer');
			$this->table_answer->insert_new_answer($question_id, $category_id, $question_answer, $user_id);
			$this->load->model('table_user');
			$this->table_user->update_user('update_reply_times', $user_id);
			redirect('/questionController/show_question/?id='.$question_id.'');
		}
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */