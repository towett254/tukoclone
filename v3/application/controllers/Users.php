<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * User Management class created by CodexWorld
 */
class Users extends CI_Controller {
    
    function __construct() {
        parent::__construct();
		$this->load->library('public_init_elements');
        $this->public_init_elements->init_elements();
		$this->load->library('form_validation');
        $this->load->model('user');
		$this->load->helper('user_email');
		
		// Check whether user ID is available in cookie or session
		$this->load->helper('cookie');
		$rememberUserId = get_cookie('rememberUserId');
		if(!empty($rememberUserId)){
			$this->session->set_userdata('isUserLoggedIn', TRUE);
			$this->session->set_userdata('userId', $rememberUserId);
			$this->userID = $rememberUserId;
		}elseif($this->session->userdata('isUserLoggedIn')){
            $this->userID = $this->session->userdata('userId');
        }else{
            $this->userID = '';
        }
		
		// Default controller name
		$this->controller = 'users';
		
		// Default layout
		$this->layout = 'layout';
		
		// File upload path
		$this->uploadPath = 'uploads/profile_picture/';
    }
    
    public function index(){
		// Load dashboard for logged-in user, login page for other user
        if($this->userID){
            $this->dashboard();
        }else{
            $this->login();
        }
    }




    

public function details(){
// Check user login status
//$this->public_init_elements->is_user_loggedin();
$this->db->hostname;
$this->db->username;
$this->db->password;
$this->db->database;
$conn = new mysqli($this->db->hostname,
$this->db->username, $this->db->password, $this->db->database);$data = array();
$con = array('id' => $this->userID);
$data['user'] = $this->user->getRows($con);
$data['conn'] = $conn;

$this->data['maincontent'] = $this->load->view($this->controller.'/details', $data, true);
$this->load->view($this->layout, $this->data);
}



    
    /*
     * User account information dashboard
     */
    public function dashboard(){
		// Check user login status
        $this->public_init_elements->is_user_loggedin();
		
		$data = array();
		
		// Fetch user data
		$con = array('id' => $this->userID);
        $data['user'] = $this->user->getRows($con);
		
		// Load dashboard view
        $this->data['maincontent'] = $this->load->view($this->controller.'/dashboard', $data, true);
        $this->load->view($this->layout, $this->data);
    }
    
    /*
     * User account information update
     */
    public function profileUpdate(){
		// Check user login status
        $this->public_init_elements->is_user_loggedin();
		
        $data = array();
		
		// Fetch user data
		$con = array('id' => $this->userID);
        $userData = $this->user->getRows($con);
		$prevPicture = $userData['picture'];
		
		// If update request is submitted
        if($this->input->post('updateProfile')){
			// Form field validation rules
            $this->form_validation->set_rules('first_name', 'First Name', 'required');
            $this->form_validation->set_rules('last_name', 'Last Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check[' . $this->userID . ']');
			$this->form_validation->set_rules('file', '', 'callback_file_check');
			
			// Prepare user data 
            $userData = array(
                'first_name' => strip_tags($this->input->post('first_name')),
                'last_name' => strip_tags($this->input->post('last_name')),
                'email' => strip_tags($this->input->post('email')),
                'phone' => strip_tags($this->input->post('phone')),
				'address' => strip_tags($this->input->post('address'))
            );
			
			// Validate submitted form data
            if($this->form_validation->run() == true){
				$uploadError = '';
				
                // Profile picture upload
                if(isset($_FILES['picture']['name']) && $_FILES['picture']['name']!=""){

					// Upload configuration
					$config['upload_path']   = $this->uploadPath;
					$config['allowed_types'] = 'gif|jpg|png|pdf';
					$this->load->library('upload', $config);
					
					if($this->upload->do_upload('picture')){
						// Load upload helper
						$this->load->helper('upload');
						
						// Uploaded file info
						$uploadData = $this->upload->data();
						$uploadedFile = $uploadData['file_name'];
						
						// Create thumb
						$sourceImage = $this->uploadPath.$uploadedFile;
						$thumbPath = $this->uploadPath."thumb/";
						create_thumb($sourceImage, $uploadedFile, $thumbPath, 128, 128);
						
						// Add uploaded picture file to db data 
						$userData['picture'] = $uploadedFile;
						
						// Delete previous profile picture
						@unlink($this->uploadPath.$prevPicture);
						@unlink($this->uploadPath.'thumb/'.$prevPicture);
					}else{
						$uploadError = '<br/>'.$this->upload->display_errors();
					}
                }
				
				// Update user account data
                $update = $this->user->update($userData, $this->userID);
				
				// Store status message
                if($update){
                    $data['success_msg'] = 'Your profile information has been updated successfully.'.$uploadError;
                }else{
                    $data['error_msg'] = 'Some problems occured, please try again.'.$uploadError;
                }
            }
        }
		
		// User account data
        $userData['picture'] = !empty($userData['picture'])?$userData['picture']:$prevPicture;
        $data['user'] = $userData;
		
		// Load update form view
        $this->data['maincontent'] = $this->load->view($this->controller.'/profile-edit', $data, true);
        $this->load->view($this->layout, $this->data);
    }
	
	/*
     * User account password update
     */
    public function profileSettings(){
		// Check user login status
        $this->public_init_elements->is_user_loggedin();
		
        $data = array();
		
		// Fetch user data
		$con = array('id' => $this->userID);
        $userData = $this->user->getRows($con);
		
		// If update request is submitted
        if($this->input->post('updatePassword')){
			// Form field validation rules
            $this->form_validation->set_rules('old_password', 'old password', 'required|callback_oldpass_check[' . $this->userID . ']');
            $this->form_validation->set_rules('password', 'password', 'required');
            $this->form_validation->set_rules('conf_password', 'confirm password', 'required|matches[password]');
			
			// Validate submitted form data
			if($this->form_validation->run() == true){
				// Prepare user data 
                $password = $this->input->post('password');
				$passwordHash = password_hash($password, PASSWORD_DEFAULT);
				$userDataUp = array('password' => $passwordHash);
				
				// Update user account password
                $update = $this->user->update($userDataUp, $this->userID);
				
				// Store status message
				if($update){ 
					$data['success_msg'] = 'Your account password has been updated successfully.';
				}else{
					$data['error_msg'] = 'Some problem occurred, please try again.';
				}
			}
        }
		
		// User account data
        $data['user'] = $userData;
		
		// Load update form view
        $this->data['maincontent'] = $this->load->view($this->controller.'/password-update', $data, true);
        $this->load->view($this->layout, $this->data);
    }
    
    /*
     * User login
     */
    public function login(){
		// Redirect logged-in user to dashboard
		if($this->userID){
            redirect('dashboard');
        }
		
        $data = array();
		
		// Get messages from the session
        if($this->session->userdata('success_msg')){
            $data['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata('success_msg');
        }
        if($this->session->userdata('error_msg')){
            $data['error_msg'] = $this->session->userdata('error_msg');
            $this->session->unset_userdata('error_msg');
        }
		
		// If login request is submitted
        if($this->input->post('loginSubmit')){
			// Form field validation rules
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'password', 'required');
			
			// Validate submitted form data
            if($this->form_validation->run() == true){
				$email = $this->input->post('email');
				$password = $this->input->post('password');
				
				// Check whether user exists in the database
                $con['returnType'] = 'single';
                $con['where'] = array(
                    'email' => $email,
                    'status' => '1'
                );
                $userData = $this->user->getRows($con);
				$userPass = !empty($userData['password'])?$userData['password']:'';
				
				if(!empty($userData) && password_verify($password, $userPass)){
					// Set user data and status based on login credentials
					if($userData['activated'] == '0'){
						$data['error_msg'] = 'Your account activation is pending, please check your email to verify and activate your account.';
					}else{
						// If remember me is checked
						if ($this->input->post('rememberMe') == 1) {
							$remeberCookie = array(
								'name' => 'rememberUserId',
								'value' => $userData['id'],
								'expire' => time() + 86400,
							);
							$this->input->set_cookie($remeberCookie);
						}
						
						// Set variables in session
						$this->session->set_userdata('isUserLoggedIn', TRUE);
						$this->session->set_userdata('userId', $userData['id']);
						
						// Redirect to dashboard
						redirect('dashboard');
					}
				}else{
					$data['error_msg'] = 'Wrong email or password, please try again.';
				}
				
            }
        }
		
        // Load the login view
        $this->data['maincontent'] = $this->load->view($this->controller.'/login', $data, true);
        $this->load->view($this->layout, $this->data);
    }
    
    /*
     * User registration
     */
    public function registration(){
		// Redirect logged-in user to dashboard
		if($this->userID){
            redirect('dashboard');
        }
		
        $data = array();
        $userData = array();
		
		// If signup request is submitted
        if($this->input->post('regisSubmit')){
			// Form field validation rules
            $this->form_validation->set_rules('first_name', 'First Name', 'required');
            $this->form_validation->set_rules('last_name', 'Last Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check');
            $this->form_validation->set_rules('password', 'password', 'required');
            $this->form_validation->set_rules('conf_password', 'confirm password', 'required|matches[password]');
			
			// Prepare user data
			$password = $this->input->post('password');
            $userData = array(
                'first_name' => strip_tags($this->input->post('first_name')),
                'last_name' => strip_tags($this->input->post('last_name')),
                'email' => strip_tags($this->input->post('email')),
                'password' => password_hash($password, PASSWORD_DEFAULT),
				'phone' => strip_tags($this->input->post('phone')),
				'address' => strip_tags($this->input->post('address'))
            );
			
			// Validate submitted form data
            if($this->form_validation->run() == true){
				// Email verification code
				$uniqidStr = md5(uniqid(mt_rand()));
                $userData['activation_code'] = $uniqidStr;
				
				// Insert user data to the database
                $insert = $this->user->insert($userData);
				
				// Check the insertion status
                if($insert){
					// Send account verification email
					@emailVerification($insert);
					
					// Store the status message
                    $this->session->set_userdata('success_msg', 'Your registration was successfully. Please check your email to verify and activate your account.');
					
					// Redirect to login page
                    redirect('login');
                }else{
                    $data['error_msg'] = 'Some problems occured, please try again.';
                }
            }
        }
		
		// Get user account data
        $data['user'] = $userData;
		
        // Load the registration view
        $this->data['maincontent'] = $this->load->view($this->controller.'/registration', $data, true);
        $this->load->view($this->layout, $this->data);
    }
    
    /*
     * User forgot password
     */
    public function forgotPassword(){
		// Redirect logged in user to dashboard
		if($this->userID){
            redirect('dashboard');
        }
		
        $data = array();
        $userData = array();
        $frmDis = 1;
		
		// If forgot password request is submitted
        if($this->input->post('forgotSubmit')){
			// Form field validation rules
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_forgot_email_check');
			
			// Prepare user data
            $email = strip_tags($this->input->post('email'));
            $userData = array(
                'email' => $email
            );
			
			// Validate submitted form data
            if($this->form_validation->run() == true){
				// Unique forgot password identity code
                $uniqidStr = md5(uniqid(mt_rand()));
                $forgotData = array('forgot_pass_identity' => $uniqidStr);
				
				// Insert unique code
                $update = $this->user->update($forgotData, array('email' => $email));
				
				// Check unique code update status
                if($update){
					// Send reset password email
                    @forgotPassEmail($email);
					
					// Store the status message
                    $data['success_msg'] = 'Please check your e-mail, we\'ve sent a password reset link to your registered email.';
                }else{
                    $data['error_msg'] = 'Some problems occured, please try again.';
                }
                $frmDis = 0;
            }
        }
        $data['frmDis'] = $frmDis;
        $data['user'] = $userData;
		
        // Load the forgot password view
        $this->data['maincontent'] = $this->load->view($this->controller.'/forgot-password', $data, true);
        $this->load->view($this->layout, $this->data);
    }
    
    /*
     * User reset password
     */
    public function resetPassword($fp_code){
		// Redirect logged-in user to dashboard
		if($this->userID){
            redirect('dashboard');
        }
		
		$data = array();
		
		// If unique forgot password identity code is available
        if(!empty($fp_code)){
			// If reset password request is submitted
            if($this->input->post('resetSubmit')){
				// Form field validation rules
                $this->form_validation->set_rules('password', 'password', 'required');
                $this->form_validation->set_rules('conf_password', 'confirm password', 'required|matches[password]');
                
				// Validate submitted form data
                if($this->form_validation->run() == true){
					// Check whether the unique code exists in the database
                    $con['returnType'] = 'count';
                    $con['where'] = array(
                        'forgot_pass_identity' => $fp_code
                    );
                    $checkUser = $this->user->getRows($con);
					
					// If forgot password identity code is matched
                    if($checkUser > 0){
						// Update new password
						$password = $this->input->post('password');
                        $resetData = array('password' => password_hash($password, PASSWORD_DEFAULT));
                        $update = $this->user->update($resetData, array('forgot_pass_identity' => $fp_code));
						
						// Check password update status
                        if($update){
							// Store the status message
                            $this->session->set_userdata('success_msg', 'Your account password has been reset successfully. Please login with your new password.');
							
							// Redirect to login page
                            redirect('login');
                        }else{
                            $data['error_msg'] = 'Some problems occured, please try again.';
                        }
                        
                    }else{
                        $this->session->set_userdata('error_msg', 'You does not authorized to reset new password of this account.');
                        redirect('login');
                    }
                }
            }

            // Load the reset password view
            $this->data['maincontent'] = $this->load->view($this->controller.'/reset-password', $data, true);
            $this->load->view($this->layout, $this->data);
        }else{
			// Redirect to login page
            redirect('login');
        }
    }
	
	/*
     * User email verification
     */
    public function verifyEmail($activation_code){
		// Redirect logged in user to dashboard
		if($this->userID){
            redirect('dashboard');
        }
		
		$data = array();
		
		// If the activation code is available
        if(!empty($activation_code)){
			// Check whether the activation code exists in the database
			$con['where'] = array(
				'activation_code' => $activation_code
			);
			$con['returnType'] = 'single';
			$checkUser = $this->user->getRows($con);
			
			// If activation code is matched
			if(!empty($checkUser)){
				// Activate user for login
				$actData = array('activated' => '1');
                $update = $this->user->update($actData, array('activation_code' => $activation_code));
				
				// Send user registration email
				@userRegistrationEmail($checkUser['id'], '*****');
				
				// Store status message
				$this->session->set_userdata('success_msg', 'Email verification for your account was successful. Please login to your account.');
				
				// Redirect to login page
                redirect('login');
			}else{
				$this->session->set_userdata('error_msg', 'You have clicked on the wrong verification link, please check your email and try again.');
                redirect('login');
			}
        }else{
			// Redirect to login page
            redirect('login');
        }
    }
    
    /*
     * User logout
     */
    public function logout(){
		// Remove cookie data
		delete_cookie('rememberUserId');
		//Remove session data
        $this->session->unset_userdata('isUserLoggedIn');
        $this->session->unset_userdata('userId');
        $this->session->sess_destroy();
		//Redirect to login page
        redirect('login');
    }
    
    /*
     * Existing email check during validation
     */
    public function email_check($str, $id = ''){
        $con['returnType'] = 'count';
        if ($id != '') {
            $con['where'] = array('email' => $str, 'id != ' => $id);
        } else {
            $con['where'] = array('email' => $str);
        }
        $checkEmail = $this->user->getRows($con);
        if($checkEmail > 0){
            $this->form_validation->set_message('email_check', 'The given email already exists.');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    /*
     * Existing email check during forgot password validation
     */
    public function forgot_email_check($str){
        $con['returnType'] = 'count';
        $con['where'] = array('email' => $str);
        $checkEmail = $this->user->getRows($con);
        if($checkEmail > 0){
            return TRUE;
        } else {
            $this->form_validation->set_message('forgot_email_check', 'Given email is not associated with any account.');
            return FALSE;
        }
    }
    
    /*
     * Old password check during validation
     */
    public function oldpass_check($str, $id){
		// Fetch user data
        $userData = $this->user->getRows(array('id' => $id));
		
		// Verify old password
        if(!empty($userData) && password_verify($str, $userData['password'])){
            return TRUE;
        } else {
            $this->form_validation->set_message('oldpass_check', 'The given old password does not match with your account password.');
            return FALSE;
        }
    }
	
	/*
     * file value and type check during validation
     */
    public function file_check($str){
        $allowed_mime_type_arr = array('image/gif','image/jpeg','image/pjpeg','image/png','image/x-png');
        $mime = get_mime_by_extension($_FILES['picture']['name']);
        if(isset($_FILES['picture']['name']) && $_FILES['picture']['name']!=""){
            if(in_array($mime, $allowed_mime_type_arr)){
                return true;
            }else{
                $this->form_validation->set_message('file_check', 'Please select only gif/jpg/png file.');
                return false;
            }
        }else{
            return true;
        }
    }
}