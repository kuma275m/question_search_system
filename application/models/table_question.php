<?php

class Table_question extends CI_Model {
	
	public function list_search_result($str, $category) {
		$key = "";
		$keyword_list = explode(' ', $str);
		if($category!="") {
			$key.="qa_question.category_id = ".$category." and ";
		}
		$key.="question_title like '%".$keyword_list[0]."%' ";
		$key.="or question_content like '%".$keyword_list[0]."%' ";
		foreach($keyword_list as $row)
		{
			$key.="or question_title like '%".$row."%' ";
			$key.="or question_content like '%".$row."%' ";
		}
		$query = $this->db->query('SELECT DISTINCT qa_question.id, question_title,question_content,question_browse FROM qa_question LEFT JOIN (qa_answer) ON qa_question.id = qa_answer.question_id where '.$key.'');
		//return $query->result_array();
		$result = $query->result_array();
		//foreach($result as $row) {
		//	$query1 = $this->db->query('SELECT count(id) FROM qa_answer WHERE question_id = '.$row['id'].'');
		//	$result['sum'] = $query1->result_array();
		//}
		return $result;
	}
	
	public function show_question_content($id) {
		$query = $this->db->query('SELECT a.id, a.category_id, a.question_title, a.question_content, a.add_time, u.username FROM qa_question as a LEFT JOIN qa_user as u ON (u.id = a.user_id) where a.id = '.$id.' LIMIT 1');
		return $query->result_array();
	}
	
	public function get_id($question_title) {
		$query = $this->db->query('SELECT id FROM qa_question where question_title = \''.$question_title.'\' LIMIT 1');
		return $query->row_array();
	}
	public function update_answer_times($question_id) {
		$query = $this->db->query('SELECT question_browse FROM qa_question where id = \''.$question_id.'\' LIMIT 1');
		$times = $query->row_array();
		$times['question_browse']++;
		$this->db->where("id",$question_id);
		$this->db->update("qa_question",$times);
		return true;
		
	}
	public function list_question($id) {
		$query = $this->db->query('SELECT id, question_title, add_time FROM qa_question where user_id = '.$id.' ORDER BY id DESC');
		return $query->result_array();
	}
	public function add_question($question_title, $category, $question_content, $user_id) {
		$data['question_title'] = $question_title;
		$data['user_id'] = $user_id;
		$data['question_content'] = $question_content;
		$data['category_id'] = $category;
		$data['is_top'] = 0;
		$data['is_hot'] = 0;
		$this->db->insert("qa_question", $data);
		return true;
	}
}
