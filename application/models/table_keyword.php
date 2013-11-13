<?php

class Table_keyword extends CI_Model {
	
	public function list_search_result() {
		$this->db->where('username', $this->input->post('username'));
		
		$query = $this->db->get('qa_user');
		
		if ($query->num_rows() == 1) {
			return true;
		}
	}
}
