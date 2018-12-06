<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Messages_model extends CI_Model {
	
// loads the database for the functions to work
public function __construct() {
        $this->load->database();
    }

// Returns all messages posted by user with specified username
public function getMessagesByPoster($name){ 	
	
	// SQL - Selects all fields from 'Messages' table where username = ? (so string characters are escaped) in descending order
	// load sql query into $query variable with specified username
	$query = $this->db->query("SELECT * FROM Messages WHERE user_username = ".$this->db->escape($name)." ORDER BY posted_at DESC");
	//if there is an entry in the table, then it will return the result of the sql query
	if ($query->num_rows() > 0) {
		
	return $query->result_array();
	
	}
	// returns null when there aren't any entries in the table
	else {
		
		return NULL;
		
	}
}

// Returns all messages containing the specified search string
public function searchMessages($string) { 	

	// Selects messages and posted time from 'Messages' table where the 'message'  contains the specified string($string) in descending order
	// load sql query into $query variable with specified string
	$query = $this->db->query("SELECT text, posted_at FROM Messages WHERE text LIKE '%$string%' ORDER BY posted_at DESC");
	// if there is an entry in the table, then it will return the result of the sql query
	if ($query->num_rows() > 0) {
		
	return $query->result_array();
	
	}
	// returns null when there aren't any entries in the table
	else {
		
		return NULL;
			
	}
}


public function insertMessage($poster,$string){
	// Inserts values of poster and string into Messages
	$query = $this->db->query("INSERT INTO Messages (user_username, text, posted_at) VALUES(".$this->db->escape($poster).",".$this->db->escape($string).",NOW())");	
	}

public function getFollowedMessages($name) {

	$query = $this->db->query("SELECT * FROM Messages INNER JOIN User_Follows ON user_username = followed_name WHERE follower_username = $name ORDER BY posted_at DESC");
	
	if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
	else {
			return NULL;
		}
	}

}
?>
