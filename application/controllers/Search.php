<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->helper(array("form", "url"));
	
	public function index() {
		
		$this->load->view('Search');
	}
	
	public function dosearch()	{
		
		this->load->model('Messages_model');
		$msgs = $this->Messages_model->searchMessages($_GET['search']);
		$viewmsgs = array("results" => $msgs);
		$this->load->view('ViewMessages',$viewmsgs);
	}
}

?>