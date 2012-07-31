<?php
   $this->load->view('header');  
   $this->load->view('navbar'); 
   $this->load->helper('url');  
?>

   <h2>新增動畫</h2>

   <form class="well form-horizontal" action="<?php echo site_url('ani/addAni'); ?>" method="post">
      <div class="control-group">
         <label class="control-label" for="name">動畫名稱</label>
         <div class="controls">
            <input type="text" name="name" value="">
         </div>
      </div>

      <div class="control-group">
         <label class="control-label" for="sub">字幕組</label>
         <div class="controls">
            <input type="text" name="sub" value="">
         </div>
      </div>

      <div class="control-group">
         <label class="control-label" for="vol">集數</label>
         <div class="controls">
            <input type="text" name="vol" value="">
         </div>
      </div>

      <div class="form-actions">
         <button class="btn btn-primary" type="submit">新增</button>
         <a class="btn" href="<?php echo site_url('ani/addAni'); ?>">取消</a>
      </div>

   </form>

<?php $this->load->view('footer');  ?>
