<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {

	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function getAllUsers(){
		$query = $this->db->get('users');
		return $query->result(); 
	}

	public function insert($user){
		$this->db->insert('users', $user);
		return $this->db->insert_id(); 
	}

	public function getUser($id){
		$query = $this->db->get_where('users',array('id'=>$id));
		return $query->row_array();
	}

	public function activate($data, $id){
		$this->db->where('users.id', $id);
		return $this->db->update('users', $data);
	}

	public function getUserByEmail($email) {
		$this->db->where('email', $email);
		$query = $this->db->get('users');
		return $query->row_array();
	}
	public function getUserByUsername($username) {
		$this->db->where('username', $username);
		$query = $this->db->get('users');
		return $query->row_array(); // Fetch a single row as an associative array
	}
	
	public function add_personal_details($details) {
		return $this->db->insert('user_details', $details);
	}

	public function get_personal_details($user_id) {
		$query = $this->db->get_where('user_details', array('user_id' => $user_id));
		return $query->row_array(); // Returns a single row as an associative array
	}

	public function user_details_exist($user_id) {
		$this->db->where('user_id', $user_id);
		$query = $this->db->get('user_details'); // Assume 'user_details' is the table name
	
		return $query->num_rows() > 0; // Returns true if a record exists
	}
	public function update_user_details($user_id, $data) {
		$this->db->where('user_id', $user_id);
		return $this->db->update('user_details', $data);
	}
	
	
	


	

}
