<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

   public function __construct()
   {
      parent::__construct();
      $this->load->spark('ion_auth/2.2.4');
      $this->load->helper('url');
   }

	public function index()
	{
      if( $this->ion_auth->logged_in() == true ){
         redirect('ani/');
      }else{
         $data = array(
            'page_title' => 'Login',
            'loggedin' => false
         );
         $this->load->view('user/home', $data);
      }
	}

   public function login()
   {
      // Check if user has loggedin
      if( $this->ion_auth->logged_in() == true ){
         redirect('ani/');
      }

      $username = $this->input->post('username');
      $password = $this->input->post('password');
      $remember = false;
      if( $this->input->post('remember') == 'yes'){
         $remember = true;
      }

      if( $this->ion_auth->login($username, $password, $remember) == true ){
         // Login success
         $data = array(
            'page_title' => 'Project List',
            'loggedin' => true
         );
         redirect('ani/');
      }else{
         // Login Failed
         $data['page_title'] = 'Login';
         $data['loggedin'] = false;
         $data['alert'] = array(
            'type' => '',
            'title' => 'Login Failed',
            'text' => 'Please check your username, password and retry.',
            'return' => site_url('user/')
         );
         $this->load->view('alert', $data);
      }

   }

   public function logout()
   {
      $this->ion_auth->logout();
      $this->load->helper('url');
      redirect('');
   }

   public function register()
   {
      // Check if user has loggedin
      if( $this->ion_auth->logged_in() == true ){
         redirect('ani/');
      }

      $username = $this->input->post('username');
      $password = $this->input->post('password');
      $password2 = $this->input->post('password2');
      $email = $this->input->post('email');
      $profile = array();

      if( $this->ion_auth->email_check($email) == false ){
         // Email has not been used

         // Check if email is valid
         $this->load->library('form_validation');
         $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
         $valid = $this->form_validation->run();
         if( $valid == true ){
            // Email is valid
            if( $password == $password2 ){
               // Password confirmed
               $result = $this->ion_auth->register($username, $password, $email, $profile, '');
               if( $result == true ){
                  $this->ion_auth->login($username, $password);
                  $data['page_title'] = 'Register';
                  $data['loggedin'] = true;
                  $data['user'] = $this->_getUserInfo();
                  $data['alert'] = array(
                     'type' => 'success',
                     'title' => 'Welcome',
                     'text' => 'Register complete. You can use the service now. Have fun!',
                     'return' => site_url('ani/')
                  );
                  $this->load->view('alert', $data);
               }else{
                  // ion_auth identity check failed
                  $data['page_title'] = 'Register';
                  $data['loggedin'] = false;
                  $data['alert'] = array(
                     'type' => 'warning',
                     'title' => 'Register Failed',
                     'text' => 'Username and email maybe used. Check and try again.',
                     'return' => site_url('user/')
                  );
                  $this->load->view('alert', $data);
               }
            }else{
               // Two password do not match
               $data['page_title'] = 'Register';
               $data['loggedin'] = false;
               $data['alert'] = array(
                  'type' => 'error',
                  'title' => 'Password Not Match',
                  'text' => 'The two password you\'ve entered are not the same. Please check again.',
                  'return' => ''
               );
               $this->load->view('alert', $data);
            }
         }else{
            // Email is not Valid
            $data['page_title'] = 'Register';
            $data['loggedin'] = false;
            $data['alert'] = array(
                  'type' => 'warning',
                  'title' => 'Invalid Email',
                  'text' => 'Email is not valid. Please enter an usable email.',
                  'return' => site_url('user/')
                  );
            $this->load->view('alert', $data);
         }
      }else{
         // Email has been used
         $data['page_title'] = 'Register';
         $data['loggedin'] = false;
         $data['alert'] = array(
               'type' => 'info',
               'title' => 'Email has been used',
               'text' => 'This email has been used. Please use another email to register.',
               'return' => site_url('user/')
               );
         $this->load->view('alert', $data);
      }
   }

   public function checkUsername($username = '')
   {
      $result['found'] = false;
      $query = $this->db->get_where('users', array('username' => urldecode($username) ) );
      if( $query->num_rows() > 0 )
         $result['found'] = true;
      $output = json_encode( $result );
      echo $output;
   }

   public function checkEmail($mail = '')
   {
      $result['found'] = false;
      $query = $this->db->get_where('users', array('email' => urldecode($mail) ) );
      if( $query->num_rows() > 0 )
         $result['found'] = true;
      $output = json_encode( $result );
      echo $output;
   }

   private function _getUserInfo($id=NULL)
   {
      $info = $this->ion_auth->user($id)->row();
      $groups = $this->ion_auth->get_users_groups()->result();
      $isAdmin = false;
      foreach ($groups as $group) {
         $list[] = $group->id;
         if( $group->id == 1 )
            $isAdmin = true;
      }
      $user =  array(
         'sn' => $info->id ,
         'id' => $info->username,
         'email' => $info->email,
         'groups' => $list,
         'isAdmin' => $isAdmin
      );
      return $user;
   }
}
