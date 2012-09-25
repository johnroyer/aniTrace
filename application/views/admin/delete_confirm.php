<?php  $this->load->view('header');  ?>
<?php  $this->load->view('navbar');  ?>
<?php  $this->load->helper('url');  ?>

<h2>User Management</h2>
<p style="margin-top: 25px;"> </p>

<div class="span6 pull-center alert alert-error">
<h3>刪除確認</h3>
<p>你正準備要刪除一個帳號！</p>
<p>ID: <?php echo $target['id']; ?></p>
<p>帳號： <?php echo $target['username']; ?></p>
<p>Email: <?php echo $target['email']; ?></p>
<p>
   <a class="btn btn-danger" href="<?php echo site_url('admin/deleteUser/'.$target['id'].'/confirmed');?>">刪除</a>
   <a class="btn" href="<?php echo site_url('admin/'); ?>">取消</a>
</p>
</div>

<?php $this->load->view('footer');  ?>
