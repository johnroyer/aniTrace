<?php

class Ani extends CI_Controller
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
      $data['user'] = $this->user;
      $data['loggedin'] = true;
      $data['list'] = $this->animation->getList();
      $this->load->view('animation/list', $data);
   }

   public function addAni()
   {
      if( $this->input->post('name') != false ){
         $name = $this->input->post('name');
         $sub = $this->input->post('sub');
         $vol = intval( $this->input->post('vol') );
         if( $vol < 1 )
            $vol = 1;
         $this->animation->newAni($name, $sub, $vol);
         redirect('ani/');
      }else{
         // show form
         $data['loggedin'] = true;
         $data['user'] = $this->user;
         $this->load->view('animation/add', $data);
      }
   }

   public function buy($act, $id=0)
   {
      if( intval( $id ) != 0 ){
         if( $act == 'up' ){
            $this->_buyUp($id);
         }else{
            $this->_buyDown($id);
         }
      }
   }

   public function vol($act, $id=0)
   {
      if( intval( $id ) != 0 ){
         if( $act == 'up' ){
            $this->_volUp($id);
         }else{
            $this->_volDown($id);
         }
      }
   }

   private function _volUp($id = 0)
   {
      if( intval( $id ) != 0 ){
         $this->animation->setVol($id, $this->animation->getVol($id) + 1 );
      }
      redirect('ani/');
   }

   private function _volDown($id = 0)
   {
      if( intval( $id ) != 0 ){
         $vol = $this->animation->getVol($id);
         if( $vol > 1 )
            $vol -= 1;
         else
            $vol = 1;
         $this->animation->setVol($id, $vol);
      }
      redirect('ani/');
   }

   private function _buyUp($id = 0)
   {
      if( intval( $id ) != 0 ){
         $this->animation->setBuy($id, $this->animation->getBuy($id) + 1 );
      }
      redirect('ani/');
   }

   private function _buyDown($id = 0)
   {
      if( intval( $id ) != 0 ){
         $vol = $this->animation->getBuy($id);
         if( $vol > 1 )
            $vol -= 1;
         else
            $vol = 1;
         $this->animation->setBuy($id, $vol);
      }
      redirect('ani/');
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
