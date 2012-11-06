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
         redirect('auth/');
      }
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
