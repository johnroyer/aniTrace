<?php

class Admin extends CI_Controller
{
   
   function __construct( )
   {
      parent::__construct();
      $this->load->helper('url');
      $this->load->spark('ion_auth/2.2.4');
      $user = $this->_getUserInfo();
      if( $this->ion_auth->logged_in() == TRUE ){
         $user = $this->_getUserInfo();
         if( $user['isAdmin'] == FALSE )
            redirect('user/');
      }else{
         redirect('');
      }
   }

   public function index()
   {
      $data['page_title'] = 'User Admin';
      $data['loggedin'] = true;

      $users = $this->ion_auth->users()->result();

      $data['user'] =  $this->_getUserInfo();
      $data['users'] = $users;
      $data['tab_general'] = 'active';
      $data['tab_admin'] = '';
      $this->load->view('admin/home', $data);
   }

   public function superuser()
   {
      $data['page_title'] = 'User Admin';
      $data['loggedin'] = true;

      // List all admins (group id = 1)
      $users = $this->ion_auth->users( array('1') )->result();

      $data['user'] =  $this->_getUserInfo();
      $data['users'] = $users;
      $data['tab_general'] = '';
      $data['tab_admin'] = 'active';
      $this->load->view('admin/home', $data);
   }

   public function deleteUser($id=-1, $confirm='')
   {
      $id = intval($id);

      // Admin can not delete himself
      $user = $this->_getUserInfo();
      if( $user['sn'] == $id ){
         $data['page_title'] = 'User Deletion';
         $data['loggedin'] = true;
         $data['user'] =  $this->_getUserInfo();

         $data['error_title'] = 'Can NOT Delete Yourself';
         $data['error_detail'] = ' ';

         $this->load->view('admin/delete_error', $data);
      }else{

         // Check if user is exist
         if( $id != -1 ){
            $info = $this->_getUserInfo($id);
            if( $info != NULL ){
               if($confirm == 'confirmed'){
                  // Delete User data from animation List
                  $this->db->where('user_id', $id);
                  $this->db->delete('list');

                  // Delete User
                  $this->ion_auth->delete_user($id);
                  redirect('admin/');
               }else{
                  // Show confirm page
                  $data['page_title'] = 'User Delete Confirm';
                  $data['loggedin'] = true;
                  $data['user'] =  $this->_getUserInfo();
                  $target = $this->_getUserInfo( $id );
                  $data['target'] = array(
                        'id' => $target['sn'],
                        'username' => $target['id'],
                        'email' => $target['email']
                        );
                  $this->load->view('admin/delete_confirm', $data);
               }
            }else{
               // User does not exist
               $data['page_title'] = 'User Delete Failed';
               $data['loggedin'] = true;
               $data['user'] =  $this->_getUserInfo();

               $data['error_title'] = 'User does not exist';
               $data['error_detail'] = 'User ID not Found';

               $this->load->view('admin/delete_error', $data);
            }
         }else{
            // Invalid ID
            redirect('admin/');
         }
      }
   }

   public function searchUser($key='')
   {
      $key = trim( urldecode( $key ) );
      $this->db->select('id, username, email');
      if( $key != '' ){
         $this->db->like('username', $key);
         $this->db->or_like('email', $key);
      }
      $query = $this->db->get('users');
      echo json_encode( $query->result_array() );
   }

   public function edit($uid = -1, $comfirm = 0)
   {
      $data['user'] = $this->_getUserInfo();
      $data['page_title'] = 'User Edit';
      $data['loggedin'] = true;
      if( $uid != -1 ){
         // Edit user information
         $u = $this->ion_auth->user($uid)->row();
         $user = array(
            'id' => $u->id,
            'username' => $u->username,
            'email' => $u->email
            );
         $data['info'] = $user;
         $this->load->view('admin/info_edit', $data);
      }else{
         // no input
         $data['alert'] = array(
               'type' => 'error',
               'title' => 'User ID not found',
               'text' => 'Can not find user by this ID.',
               'return' => site_url('admin/')
               );
         $this->load->view('alert', $data);
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
         'sn' => $info->id ,
         'id' => $info->username,
         'email' => $info->email,
         'groups' => $list,
         'isAdmin' => $isAdmin
      );
      return $user;
   }
}
