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
      echo json_encode( $this->animation->getList() );
   }

   public function watchableList()
   {
      echo json_encode( $this->animation->getWatchable() );
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

   public function anime($id = 0)
   {
      if( $id != 0 ){
         echo json_encode( $this->animation->getRow($id) );
      }
   }

   public function buy($act, $id=0)
   {
      if( intval( $id ) != 0 ){
         if( $act == 'up' ){
            $this->animation->buyUp($id);
            echo json_encode( $this->animation->getRow($id) );
         }else{
            $this->animation->buyDown($id);
            echo json_encode( $this->animation->getRow($id) );
         }
      }
   }

   public function add()
   {
      $name = $this->input->post('name', true);
      $sub = $this->input->post('sub', true);
      $link = $this->input->post('link', true);
      if( $name != '' ){
         $id = $this->animation->newAni($name, $sub, $link);
         $data = $this->animation->getRow($id);
         unset( $data['user_id'] );
         echo json_encode( $data );
      }else{
         echo json_encode( array('stat'=>'no input data') );
      }
   }

   public function mod()
   {
      $id = $this->input->post('id', true);
      $name = $this->input->post('name', true);
      $sub = $this->input->post('sub', true);
      $vol = $this->input->post('vol', true);
      $buy = $this->input->post('buy', true);
      $link = $this->input->post('link', true);
      if( $id != false || $id != '' ){
         $result = $this->animation->setAni($id, $name, $sub, $vol, $buy, $link);
         if( $result ){
            $data = $this->animation->getRow($id);
            unset( $data['user_id'] );
            echo json_encode( $data );
         }else{
            echo json_encode( array('stat'=>'update failed') );
         }
      }else{
         echo json_encode( array('stat'=>'no input data') );
      }
   }

   public function finished($aniId = 0)
   {
      if( $aniId != 0 ){
         $this->animation->setFinished($aniId);
         echo json_encode( $this->animation->getRow($aniId) );
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
