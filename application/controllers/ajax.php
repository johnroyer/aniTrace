<?php

class Ajax extends CI_Controller
{
   private $user;

   function __construct( )
   {
      parent::__construct();
      $this->load->helper('url');
      $this->load->spark('ion_auth/2.2.4');
      if( $this->ion_auth->logged_in() == TRUE ){
         $this->user = $this->_getUserInfo();
      }else{
         redirect('');
      }
      $this->load->model('animation');
      $this->animation->setUid( $this->user['id'] );
   }

   public function index()
   {
      $data = array(
         'msg' => 'Hello World'
      );
      echo json_encode($data);
   }

   public function vol($act, $id=0)
   {
      if( intval( $id ) != 0 ){
         if( $act == 'up' ){
            $this->animation->volUp($id);
            echo json_encode( $this->animation->getRow($id) );
         }else{
            $this->animation->volDown($id);
            echo json_encode( $this->animation->getRow($id) );
         }
      }
   }

   private function _getUserInfo($id=NULL)
   {
      $info = $this->ion_auth->user($id)->row();
      if( $info == NULL )
         return NULL;
      $groups = $this->ion_auth->get_users_groups()->result();
      $isAdmin = false;
      foreach ($groups as $group) {
         $list[] = $group->id;
         if( $group->id == 1 )
            $isAdmin = true;
      }
      $user =  array(
         'id' => $info->id ,
         'username' => $info->username,
         'email' => $info->email,
         'groups' => $list,
         'isAdmin' => $isAdmin
      );
      return $user;
   }
}
