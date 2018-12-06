<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends CI_Controller {
	
		public function __construct() {
		parent::__construct();
		$this->load->library("session");
		$this->load->helper("url");
		$this->load->helper('form');
	}
		
	public function index() {
		
		if($this->session->userdata("username")) {
		
		$this->load->view("Post");
		
		}
		else {
			
		redirect("/user/Login");
		
		}
	
	}
	
	public function doPost() {
		
		if ($this->session->userdata("username")=="") {
			
            $this->load->view("Login");
		}
		
		else {
		$post = $this->input->post("postText", TRUE);
		$poster = $this->session->userdata("uname");
		$this->load->model("Messages_model");
		$this->Messages_model->insertMessage($poster, $post);
		redirect("/user/view/" . $poster);
	}
}

?>