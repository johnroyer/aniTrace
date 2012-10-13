<?php  $this->load->view('header');  ?>
<?php  $this->load->view('navbar');  ?>
<?php  $this->load->helper('url');  ?>

<div class="row">

   <div class="span6">
      <h2>登入</h2>
      <form class="well login" action="<?php echo site_url('user/login/'); ?>" method="post" accept-charset="utf-8">
         <label for="username">帳號：</label>
         <input class="span3 " type="text" name="username" placeholder="longin id" autofocus>
         
         <label for="password">密碼：</label>
         <input class="span3" type="password" name="password" placeholder="your password">

         <label class="checkbox">
            <input type="checkbox" name="remember" value="yes"> 記住本次登入
         </label>

         <br />

         <p><button class="btn" type="submit">登入</button>
         <a href="" id="forget-password">忘記密碼？</a></p>
      </form>
   </div>


   <div class="span6">
      <h2>註冊</h2>
      <form class="well register" action="<?php echo site_url('user/register/'); ?>" method="post" accept-charset="utf-8">
         <div class="control-group" id="username-group">
            <label for="username" class="control-label">帳號：</label>
            <div id="" class="controls">
               <input type="text" name="username" value="" id="username">
               <span class="help-inline hide" id="username-hint"></span>
            </div>
         </div>

         <div id="email-group" class="control-group">
            <label for="email" class="control-label">Email</label>
            <div id="" class="controls">
               <input class="input-smail" type="text" name="email" value="" id="email">
               <span class="help-inline hide" id="email-hint"></span>
            </div>
         </div>

         <label for="password">密碼：</label>
         <input type="password" name="password" value="" id="password">

         <div id="pwd-group" class="control-group">
            <label for="password2" class="control-label">確認密碼：</label>
            <div id="" class="controls">
               <input type="password" name="password2" value="" id="password2">
               <span id="pwd-help" class="help-inline hide">二次密碼不相符</span>
            </div>
         </div>
      
      <p><button class="btn" type=submit">註冊</button></p>
      </form>
   </div>

</div>

<?php $this->load->view('footer');  ?>
