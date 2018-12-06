<?php	
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	// loads library and helper for functions
	public function __construct() {
		parent::__construct();
		$this->load->library(array("session", "form_validation"));
		$this->load->helper(array("form", "url"));
	}
	
		public function index() {
		redirect("/user/login");
	}

	public function view($name)	{
		
		$this->load->model('Messages_model');
		$array = $this-> Messages_model -> getMessagesByPoster($name);
		$viewarray = array("results" => $array);
		$this->load->view('ViewMessages', $viewarray);
		// Not sure about the follow button, if this part is removed the login form shows.
		/*if ($this->Users_model->isFollowing($follower,$followed))
			// Currently logged in user 
		{	$follower = $this->session->userdata("username");
			$this->load->model('User_model');
			// button that allows you to follow and links to the follow function
			echo "<button type = 'button' onClick='<?php echo base_url()?>User/follow'>Follow</button>";
		}*/
	}
	
	// login function
	public function login() {
		
		// Loads the login view 
		$this->load->view('Login');
		
	}
	
	public function doLogin() {
	
	
	if($this->input->post("username") && $this->input->post("password")) {
		$username = $this->input->post("username", TRUE);
		$pass = $this->input->post("password", TRUE);
		$this->load->model("Users_model");
		
	// Form validation where username and password are required
	// Array used to provide a further error message
	$this->form_validation->set_rules("user","Username","required");
	$this->form_validation->set_rules("pass", "Password", "required", array("required" => 'You must provide a %s.'));
		
		// If the form validation is false or the login is incorrect then it redirects to the Login page and shows error message
		if ($this->form_validation->run() == FALSE || $this->Users_model->checkLogin($username,$pass)) {
            
			echo 'You have not entered a username or password';
			$this->load->view('Login');

		}	
		    
			else {
				
				// Checks the login
				$this->Users_model->checkLogin($username, $pass);
				
				// creates session variable with username and whether its logged in
				$session = array (
				'username' => $username , 
				'logged_in' => true
				);
				
				// sets session with user data, under variable $session which was used to create the array for login
				$this->session->set_userdata($session);
				redirect('/user/view/' . $username);
			}
	
		}
	}

	// logout function
	public function logout() {
		
		$this->session->sess_destroy();
		redirect("/user/login");
	}


	// follow function
	public function follow($followed) {
		
		if($this->input->post("follower") && $this->input->post("followed")) {
			$this->load->model("Users_model");
			$follower = $this->input->post("follower", TRUE);
			$followee = $this->input->post("followed", TRUE);
			$this->Users_model->follow($follower, $followed);
			redirect("user/view/" . $followed);
		}
	}
	
	
	
	public function feed($name) {
		$this->load->model('Messages_model');
		$array = $this-> Messages_model -> getFollowedMessages($name);
		$viewarray = array("results" => $array);
		$this->load->view('ViewMessages', $viewarray);
	
	}
}
?>
