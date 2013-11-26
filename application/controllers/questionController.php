<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class QuestionController extends CI_Controller {

	public function index()
	{
	
	}
	
	public function show_question()
	{
		$question_id = $this->uri->segment(3);
		$this->load->model('table_question');
		$result['show_content'] = $this->table_question->show_question_content($question_id);
		foreach($result['show_content'] as $row) {
			$this->load->model('time_class');
			$result['question_id'] = $row['id'];
			$result['question_title'] = $row['question_title'];
			$result['question_content'] = $row['question_content'];
			$result['category_id'] = $row['category_id'];
			$result['add_time'] = $this->time_class->time_trans($row['add_time']);
		}
		$this->load->model('table_category');
		$result['category'] = $this->table_category->list_category();
		$this->load->model('table_answer');
		$result['show_answer'] = $this->table_answer->show_answer($question_id);
		$sum = count($result['show_answer']);
		//foreach($result['show_answer'] as $row)
		for($i=0; $i<$sum; $i++)
		{
			$this->load->model('time_class');
			$result['show_answer'][$i]['add_time'] = $this->time_class->time_trans($result['show_answer'][$i]['add_time']);
		}
		if(count($result['show_answer']) == 0) {
			$result['message'] = "This question has not anwser yet. You are welcome to be the first answer.";
		}
		$this->load->view('show_question_content', $result);
	}
	
	public function ask_question() 
	{
		if(!$this->session->userdata('is_logged_in')) {
			redirect(base_url().'main/register', 'refresh');
		}
		$this->load->model('table_category');
		$result['category'] = $this->table_category->list_category();
		$this->load->view('ask_question', $result);
	}
	
	public function add_question()
	{
		$question_title = $this->input->post('question_title');
		$category = $this->input->post('category');
		$question_content = $this->input->post('question_content');
		$username = $this->session->userdata('username');
		$this->load->model('table_user');
		$user_id = $this->table_user->get_user_id($username);
		if($question_title!="" && $category!="" && $question_content!="" && $user_id!="")
		{
			$this->load->model('table_question');
			if($this->table_question->add_question($question_title, $category, $question_content, $user_id))
			{
				$this->table_user->update_user('update_ask_times', $user_id);
				$id = $this->table_question->get_id($question_title);
				$question_id = $id['id'];
				$data['message'] = "Thank you. Your question has been posted.<br />You can view your question via <a href='".base_url()."questionController/show_question/".$question_id."'>here</a>";
				$this->load->view('message', $data);
			}
		}

	}
	
}
