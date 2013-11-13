<?php

class Table_answer extends CI_Model {
	
	public function show_answer($id) {
		$query = $this->db->query('SELECT answer_title, answer_content, username, add_time FROM qa_answer LEFT JOIN qa_user ON (qa_answer.user_id = qa_user.id) where qa_answer.question_id = '.$id.' order by qa_answer.id asc');
		return $query->result_array();
		}
		
	public function insert_new_answer($question_id, $category_id, $question_answer, $user_id) {
		$data['answer_content'] = $question_answer;
		$data['user_id'] = $user_id;
		$data['question_id'] = $question_id;
		$data['category_id'] = $category_id;
		$data['is_top'] = 0;
		$this->db->insert("qa_answer", $data);
		$this->load->model('table_question');
		$this->table_question->update_answer_times($question_id);
		return true;
		}
	}

