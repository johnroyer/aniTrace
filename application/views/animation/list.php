<?php
   $this->load->view('header');  
   $this->load->view('navbar'); 
   $this->load->helper('url');  
?>

   <h2>Hello, <?php echo $user['username']; ?></h2>

   <p id="list-control">
      <a class="btn btn-primary" href="#"><i class="icon-plus"></i> 新增</a>
   </p>

   <table class="table" id="ani-list">
      <thead>
         <tr>
            <td>動畫</td>
            <td>字幕組</td>
            <td>集數</td>
            <td>購入集數</td>
            <td></td>
         </tr>
      </thead>

      <tbody>
         <tr id="row-template">
            <td class="col-name">${name}</td>
            <td class="col-sub">${sub}</td>
            <td class="col-vol">
               <div class="vol">${vol}</div>
               <div class="vol-act">
                  <i class="icon-plus"></i>
                  <i class="icon-minus"></i>
               </div>
            </td>
            <td class="col-buy">
               <div class="buy">${buy}</div>
               <div class="buy-act">
                  <i class="icon-plus"></i>
                  <i class="icon-minus"></i>
               </div>
            </td>
            <td class="col-fin"> 
               <i class="icon-ok"></i> 完結！
            </td>
         </tr>

      </tbody>
   </table>

   <div id="dialog-outter" class="hidden">
      <div id="dialog-border">
         <div id="dialog-content">
         </div>
      </div>
   </div>

   <div id="dialog-addAni" class="hidden">
      <h3>新增動畫</h3>

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

         <div class="form-actions">
            <button class="btn btn-primary" type="submit">新增</button>
            <a class="btn" href="<?php echo site_url('ani/addAni'); ?>">取消</a>
         </div>

      </form>
   </div>

<?php $this->load->view('footer');  ?>
