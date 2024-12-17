<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('slots_model');
        $this->load->model('bookings_model');
		$this->load->model('users_model');
		$this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('session');

        //get all users
        $this->data['users'] = $this->users_model->getAllUsers();
	}

	public function index(){
		$this->load->view('login', $this->data);
	}

	public function register(){
		$this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
		$this->form_validation->set_rules('email', 'Email', 'valid_email|required|is_unique[users.email]'); // Added unique check for email
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[7]|max_length[30]');
        $this->form_validation->set_rules('password_confirm', 'Confirm Password', 'required|matches[password]');
        

		 // Customize error messages
		 $this->form_validation->set_message('is_unique', 'The {field} is already in use. Please choose a different one.');
		 $this->form_validation->set_message('valid_email', 'Please enter a valid email address.');
		 $this->form_validation->set_message('matches', 'The {field} field does not match the password.');
		 
        if ($this->form_validation->run() == FALSE) { 
         	$this->load->view('register', $this->data);
		}
		else{
			//get user inputs
			$username = $this->input->post('username');
			$email = $this->input->post('email');
			$password = $this->input->post('password');

			// Hash the password before saving
			$hashed_password = password_hash($password, PASSWORD_DEFAULT);

			//generate simple random code
			$set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$code = substr(str_shuffle($set), 0, 12);

			//insert user to users table and get id
			
			$user['username'] = $username;
			$user['email'] = $email;
			$user['password'] = $hashed_password;
			$user['code'] = $code;
			$user['active'] = false;
			$id = $this->users_model->insert($user);

			//set up email
			$config = array(
		  		'protocol' => 'smtp',
		  		'smtp_host' => 'smtp.gmail.com',
		  		'smtp_port' => 465,
				'smtp_crypto'=>'ssl',
		  		'smtp_user' => 'cmurwanthi05@gmail.com', // change it to yours
		  		'smtp_pass' => 'luozdqaknfioztwy', // change it to yours
		  		'mailtype' => 'html',
		  		'wordwrap' => TRUE
			);

			$message = 	"
						<html>
						<head>
							<title>Verification Code</title>
						</head>
						<body>
							<h2>Thank you for Registering.</h2>
							<p>Your Account:</p>
							<p>Email: ".$email."</p>
							<p>Password: ".$password."</p>
							<p>Please click the link below to activate your account.</p>
							<h4><a href='".base_url()."user/activate/".$id."/".$code."'>Activate My Account</a></h4>
						</body>
						</html>
						";
	 		
		    $this->load->library('email', $config);
		    $this->email->set_newline("\r\n");
		    $this->email->from($config['smtp_user']);
		    $this->email->to($email);
		    $this->email->subject('Signup Verification Email');
		    $this->email->message($message);

		    //sending email
		    if($this->email->send()){
		    	$this->session->set_flashdata('message','Activation code sent to email');
				
		    }
		    else{
		    	$this->session->set_flashdata('message', $this->email->print_debugger());
	 
		    }

        	redirect('register');
		}

	}

	public function activate(){
		$id =  $this->uri->segment(3);
		$code = $this->uri->segment(4);

		//fetch user details
		$user = $this->users_model->getUser($id);

		//if code matches
		if($user['code'] == $code){
			//update user active status
			$data['active'] = true;
			$query = $this->users_model->activate($data, $id);

			if($query){
				$this->session->set_flashdata('message', 'User activated successfully, login');
				}

			else{
				$this->session->set_flashdata('message', 'Something went wrong in activating account');
			}
		}
		else{
			$this->session->set_flashdata('message', 'Cannot activate account. Code didnt match');
		}

		redirect('register');

	}

	public function login() {
		// Set validation rules
		$this->form_validation->set_rules('username_or_email', 'Username or Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
	
		if ($this->form_validation->run() == FALSE) {
			// If validation fails, reload the login view
			$this->load->view('login');
		} else {
			// Get input from form
			$username_or_email = trim($this->input->post('username_or_email'));
			$password = $this->input->post('password');
	
			// Determine if the input is an email or username
			if (filter_var($username_or_email, FILTER_VALIDATE_EMAIL)) {
				// Fetch the user by email
				$user = $this->users_model->getUserByEmail($username_or_email);
			} else {
				// Fetch the user by username
				$user = $this->users_model->getUserByUsername($username_or_email);
			}
	
			// Verify the password and check if the user exists
			if ($user && password_verify($password, $user['password'])) {
				// Check if the user's account is active
				if ($user['active'] == true) {
					// Set session data if the user is active
					$this->session->set_userdata('id', $user['id']);
					$this->session->set_userdata('username', $user['username']);  // Store the username
					$this->session->set_userdata('email', $user['email']);  // Store the email
					$this->session->set_userdata('role', $user['role']);
					$this->session->set_userdata('logged_in', true);
	
					// Redirect based on the role
					if ($user['role'] === 'admin') {
						redirect('admin/dashboard'); // Redirect admins to the slot management page
					} else {
						redirect('user/dashboard'); // Redirect regular users to their dashboard
					}
				} else {
					// If the user is not active, set a flash message and reload the login page
					$this->session->set_flashdata('message', 'Your account is not active. Please contact support.');
					redirect('user/login');
				}
			} else {
				// Set flash data for invalid credentials
				$this->session->set_flashdata('message', 'Invalid username/email or password');
				redirect('user/login');
			}
		}
	}
	
	
	
	
	
	public function dashboard(){
		if (!$this->session->userdata('logged_in')) {
			redirect('user/login');
		}
	
		// Fetch the username from session
		$data['username'] = $this->session->userdata('username');
	
		// Load the dashboard view with username
		$this->load->view('user/dashboard', $data);
	}

	// View available slots
    public function view_slots() {

		if (!$this->session->userdata('logged_in')) {
			redirect('user/login');
		}

        $data['slots'] = $this->slots_model->get_all_available_slots();
        $this->load->view('user/view_slots', $data);
    }

	

	// Make a booking
    public function make_booking($slot_id) {
        $user_id = $this->session->userdata('id');
		// Load models
		$this->load->model('slots_model');
		$this->load->model('bookings_model');
        
        // Check if the slot is still available
        $slot = $this->slots_model->get_slot_by_id($slot_id);
        if ($slot && $slot['available']) {
            // Create booking
            $booking_data = [
                'user_id' => $user_id,
                'slot_id' => $slot_id,
                'start_time' => $slot['start_time'],
				'created_by' => $slot['created_by'],
				'slot_number' => $slot['slot_number'],
                'end_time' => $slot['end_time'],
				'service' => $this->input->post('service')
            ];
            $this->bookings_model->create_booking($booking_data);

			    // Set the slot's availability to false (update database)
				$this->slots_model->update_slot_availability($slot_id, false);


            // Set flash message and redirect
            $this->session->set_flashdata('message', 'Booking successful!');
        } else {
            $this->session->set_flashdata('message', 'The slot is no longer available.');
        }

        redirect('user/view_slots');
    }

	public function add_details(){
		// Ensure the user is logged in
		if (!$this->session->userdata('logged_in')) {
			redirect('user/login');
		}

		// Get the current user ID from the session
		$user_id = $this->session->userdata('id');

		 // Check if the user's details already exist
		 if ($this->users_model->user_details_exist($user_id)) {
			// Set an error message or redirect to a different page
			$this->session->set_flashdata('message', 'Your details have already been submitted.');
			$message = $this->session->flashdata('message');
			 // Load the view and pass the message to it
			 $this->load->view('user/view_details', ['message' => $message]);
			return;
		}
	
		// Set validation rules
		$this->form_validation->set_rules('full_name', 'Full Name', 'required');
		$this->form_validation->set_rules('dob', 'Date of Birth', 'required');
		$this->form_validation->set_rules('emergency_contact', 'Emergency Contact', 'required');
		$this->form_validation->set_rules('IDno', 'ID Number', 'required');
		$this->form_validation->set_rules('contact_number', 'Contact Number', 'required');
		
	
		if ($this->form_validation->run() == FALSE) {
			// Load the form view if validation fails
			$this->load->view('user/add_details');
		} else {
			// Get user inputs
			$full_name = $this->input->post('full_name');
			$dob = $this->input->post('dob');
			$emergency_contact = $this->input->post('emergency_contact');
			$medical_conditions = $this->input->post('medical_conditions');
			$IDno = $this->input->post('IDno');
			$contact_number = $this->input->post('contact_number');
			$address = $this->input->post('address');
			$nationality = $this->input->post('nationality');
			$occupation = $this->input->post('occupation');
	
			// Get the current user ID from session
			$user_id = $this->session->userdata('id');
	
			// Prepare data for insertion
			$details = array(
				'user_id' => $user_id,
				'full_name' => $full_name,
				'dob' => $dob,
				'emergency_contact' => $emergency_contact,
				'medical_conditions' => $medical_conditions,
				'IDno' => $IDno,
				'contact_number' => $contact_number,
				'address' => $address,
				'nationality' => $nationality,
				'occupation' => $occupation
			);
	
			// Save details to the database (add this function in your users_model)
			$this->users_model->add_personal_details($details);
	
			// Set success message and redirect
			$this->session->set_flashdata('message', 'Personal and medical details saved successfully.');
			redirect('user/view_details');
		}
	}
	public function view_details() {
		// Ensure the user is logged in
		if (!$this->session->userdata('logged_in')) {
			redirect('user/login');
		}
	
		// Get the current user ID from session
		$user_id = $this->session->userdata('id');
	
		// Fetch user details from the database (create this method in your users_model)
		$data['details'] = $this->users_model->get_personal_details($user_id);
	
		// Load the view and pass the details
		if ($data['details']) {
			$this->load->view('user/view_details', $data);
		} else {
			$this->session->set_flashdata('error', 'Details not found.');

			redirect('user/add_details');
		}
	}
	
	


	

	// View user's bookings
    public function view_bookings() {
        $user_id = $this->session->userdata('id');
        $data['bookings'] = $this->bookings_model->get_bookings_by_user($user_id);
        $this->load->view('user/view_bookings', $data);
    }

	public function edit_details(){
		// Ensure the user is logged in
		if (!$this->session->userdata('logged_in')) {
			redirect('user/login');
		}
	
		$user_id = $this->session->userdata('id');
	
		// Load current details
		$data['details'] = $this->users_model->get_personal_details($user_id);
		 // Add a message to $data if details are empty
		 if (empty($data['details'])) {
			
			// Set flash data message
			$this->session->set_flashdata('error', 'No details found for this user.');
			redirect('user/add_details'); // Redirect to a page where the user can add details
			return;
		}
	
		// Set validation rules
		$this->form_validation->set_rules('full_name', 'Full Name', 'required');
		// (Add validation for other fields as needed)
	
		if ($this->form_validation->run() == FALSE) {
			// Load the form view if validation fails or on the first load
			$this->load->view('user/edit_details', $data);
		} else {
			// Get updated inputs
			$updated_data = array(
				'full_name' => $this->input->post('full_name'),
				'dob' => $this->input->post('dob'),
				'emergency_contact' => $this->input->post('emergency_contact'),
				'IDno' => $this->input->post('IDno'),
				'contact_number' => $this->input->post('contact_number'),
				'address' => $this->input->post('address'),
				'nationality' => $this->input->post('nationality'),
				'occupation' => $this->input->post('occupation'),
				'medical_conditions' => $this->input->post('medical_conditions')
			);
	
			// Update user details in the database
			$this->users_model->update_user_details($user_id, $updated_data);
	
			// Set success message and redirect to view details
			$this->session->set_flashdata('message', 'Your details have been updated successfully.');
			redirect('user/view_details');
		}
	}
	


	

	// Logout function
	public function logout(){
		$this->session->unset_userdata('id');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('logged_in');
		$this->session->set_flashdata('message', 'Logged out successfully');
		redirect('user/login');
	}

	

  

}
