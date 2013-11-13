<?php

class Table_category extends CI_Model {
	
	public function list_category() {
		$query = $this->db->query('SELECT category_name, id FROM qa_category order by id asc');
		return $query->result_array();
		}
	}

