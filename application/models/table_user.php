<?php

class Table_user extends CI_Model {
	
	public function can_log_in() {
		$this->db->where('username', $this->input->post('username'));
		$this->db->where('password', md5($this->input->post('password')));
		$query = $this->db->get('qa_user');
		
		if ($query->num_rows() == 1) {
			return true;
		}
	}
	
	public function get_user_id($username) {
		$query = $this->db->query('SELECT id FROM qa_user WHERE username = \''.$username.'\' LIMIT 1');
		$result = $query->result_array();
		foreach($result as $row)
		{
			$user_id = $row['id'];
		}
		return $user_id;
	}
	
	public function check_username($username) {
		$this->db->where('username', $username);
		$query = $this->db->get('qa_user');
		
		if ($query->num_rows() == 1) {
			return true;
		}
	}
	
	public function check_email($email) {
		$this->db->where('email', $email);
		$query = $this->db->get('qa_user');
		
		if ($query->num_rows() == 1) {
			return true;
		}
	}
	
	public function update_user($status, $user_id) {
		if($status == "update_ask_times") {
			$query = $this->db->query('SELECT ask_times FROM qa_user WHERE id = '.$user_id.' LIMIT 1');
			$result = $query->row_array();
			$result['ask_times']++;
			$this->db->where("id",$user_id);
			$this->db->update("qa_user",$result);
		}
		if($status == "update_reply_times") {
			$query = $this->db->query('SELECT reply_times FROM qa_user WHERE id = '.$user_id.' LIMIT 1');
			$result = $query->row_array();
			$result['reply_times']++;
			$this->db->where("id",$user_id);
			$this->db->update("qa_user",$result);
		}
	}
	
	public function get_user_profile($username) {
		$query = $this->db->query('SELECT id, ask_times, reply_times FROM qa_user WHERE username = \''.$username.'\' LIMIT 1');
		$result = $query->row_array();
		return $result;
	}
	
	public function add_user($username, $password, $email, $phone) {
		$data['username'] = $username;
		$data['password'] = $password;
		$data['email'] = $email;
		$data['phone'] = $phone;
		$this->db->insert("qa_user", $data);
		return true;
	}
}
