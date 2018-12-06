<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
		$this->load->database();
	}
	
	public function checkLogin($username,$pass) {
	// hash passwords before searching
	$hash = sha1($pass);
	$query = $this->db->query("SELECT username FROM Users WHERE username = $username AND password=$hash");
	
	if ($query->num_rows() == 1) {
			return TRUE;
		}
	else {
			return FALSE;
		}
	}
	
	public function isFollowing($follower,$followed) {
		$query = $this->db->query("SELECT * FROM User_Follows WHERE follower_username=".$this->db->escape($follower)." AND followed_username=".$this->db->escape($followed)."");
	
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		else {
			return NULL;
		}
	}
	
	public function follow($follower,$followed) {
	
		$query = $this->db->query("INSERT INTO User_Follows (follower_username, followed_username) VALUES(".$this->db->escape($follower).",".$this->db->escape($followed).")");
			
		if ($query->num_rows() == 1) {
			return $query->result_array();	
		}
		else {
			return NULL;
		}
	}
}
?>