<div class="navbar navbar-fixed-top">
   <div class="navbar-inner">
      <div class="container">
      <a class="brand" href="<?php echo site_url(); ?>">aniTrace</a>

<?php if( $loggedin == true ): ?>
            <ul class="nav pull-right" >

            <?php if( $user['isAdmin'] == true): ?>
               <li><a href="<?php echo site_url('admin/'); ?>">使用者管理</a></li>
            <?php endif; ?>

               <li class="dropdown">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="icon-user icon-white"></i>
                  帳號
                  <i class="caret"></i>
                  </a>

                  <ul class="dropdown-menu">
                     <li><a href="<?php echo site_url('user/logout/'); ?>">登出</a></li>
                  </ul>

               </li>
            </ul>

<?php else: ?>
            <ul class="nav pull-right" >
            <li><a href="<?php echo site_url('user/'); ?>">註冊</a></li>
            <li><a href="<?php echo site_url('user/'); ?>">登入</a></li>
            </ul>
<?php endif; ?>
      </div>
   </div>
</div>
