<?php  $this->load->view('header');  ?>
<?php  $this->load->view('navbar');  ?>
<?php  $this->load->helper('url');  ?>

<h2>使用者管理</h2>
<p style="margin-top: 25px;"> </p>

<div class="span6 pull-center alert alert-error">
<h3><?php echo $error_title; ?></h3>
<p><?php echo $error_detail; ?></p>
<p><a href="<?php echo site_url('admin/'); ?>">&lt; 上一頁</a></p>
</div>

<?php $this->load->view('footer');  ?>
