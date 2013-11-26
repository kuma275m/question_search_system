<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AnswerController extends CI_Controller {

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
			redirect('/questionController/show_question/'.$question_id.'');
		}
	}
	
}
