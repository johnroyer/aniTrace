<?php  $this->load->view('header');  ?>
<?php  $this->load->view('navbar');  ?>
<?php  $this->load->helper('url');  ?>

<h2>User Management</h2>
<p style="margin-top: 25px;"> </p>

<div class="tabbable">

   <ul class="nav nav-tabs ">
      <li class="<?php echo $tab_general; ?>"><a href="<?php echo site_url('admin/'); ?>">General</a></li>
      <li class="<?php echo $tab_admin; ?>"><a href="<?php echo site_url('admin/superuser'); ?>">Admin</a></li>
      <li>
         <form class="form-search admin-tabs-search" action="#" method="post" accept-charset="utf-8">
         <i class="icon-search admin-tabs-search-icon"></i>
         <input id="username-key" class="" type="text" name="key" value="">
         </form>
      </li>
   </ul>

   <div class="tab-content">

      <table class="table" id="user-list" style="width: 100%;">
         <thead>
            <tr>
               <td>ID</td>
               <td>Username</td>
               <td>Email</td>
               <td>Action</td>
            </tr>
         </thead>

         <tbody>
            <tr id="row-template">
               <td class="row-id"></td>
               <td class="row-username"></td>
               <td class="row-email"></td>
               <td class="row-action">
                  <a href="<?php echo site_url('admin/deleteUser/'); ?>" class="action-link deleteUser"><i class="icon-trash action-icon"></i>Delete</a>
                  <a href="<?php echo site_url('admin/edit/'); ?>" class="action-link editUser"><i class="icon-pencil action-icon"></i>Edit</a>
               </td>
            </tr>

            <?php foreach($users as $u): ?>
               <tr>
                  <td><?php echo $u->id; ?></td>
                  <td><?php echo $u->username; ?></td>
                  <td><?php echo $u->email; ?></td>
                  <td>
                     <a href="<?php echo site_url('admin/deleteUser/'.$u->id); ?>" class="action-link"><i class="icon-trash action-icon"></i>Delete</a>
                     <a href="<?php echo site_url('admin/edit/'.$u->id); ?>" class="action-link"><i class="icon-pencil action-icon"></i>Edit</a>
                  </td>
               </tr>
            <?php endforeach; ?>

         </tbody>
      </table>

   </div>
</div>

<?php $this->load->view('footer');  ?>
