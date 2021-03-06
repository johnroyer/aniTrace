<?php
   $this->load->view('header');  
   $this->load->view('navbar'); 
   $this->load->helper('url');  
?>
   <p id="list-control">
      <a id="act-add" class="btn btn-primary" href="#dialog-addAni" data-toggle="form-modal"><i class="icon-plus"></i> 新增</a>
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
            <td class="col-name">
               <div class="name">${name}</div>
               <div class="link hide"><a href="${link}" target="_blank"><i class="icon-link"></i></a></div>
            </td>
            <td class="col-sub">${sub}</td>
            <td class="col-vol unselectable">
               <div class="vol">${vol}</div>
               <div class="vol-act">
                  <i class="icon-plus"></i>
                  <i class="icon-minus"></i>
               </div>
            </td>
            <td class="col-buy unselectable">
               <div class="buy">${buy}</div>
               <div class="buy-act">
                  <i class="icon-plus"></i>
                  <i class="icon-minus"></i>
               </div>
            </td>
            <td class="col-act unselectable"> 
               <i class="act-edit act-icon icon-edit" title="修改" data-toggle="form-modal" data-target="#dialog-edit" data-id=""></i>
               <i class="act-icon icon-ok" title="標示為「完結」，閱畢後自動隱藏"></i>
            </td>
         </tr>

      </tbody>
   </table>

   <div id="dialog-addAni" class="modal hide fade">
      <h3>新增動畫</h3>

      <form class="well form-horizontal" action="#" method="post">
         <div class="control-group">
            <label class="control-label" for="name">動畫名稱</label>
            <div class="controls">
               <input type="text" name="name" value="">
            </div>
         </div>

         <div class="control-group">
            <label class="control-label" for="sub">相關網址</label>
            <div class="controls">
               <input type="text" name="link" value="" placeholder="http://">
            </div>
         </div>

         <div class="control-group">
            <label class="control-label" for="sub">字幕組</label>
            <div class="controls">
               <input type="text" name="sub" value="">
            </div>
         </div>

         <div class="form-actions">
            <a class="btn btn-primary" href="#" id="submit-new-animation">新增</a>
            <a class="btn" href="#" data-dismiss="modal" aria-hidden="true">取消</a>
         </div>

      </form>
   </div>

   <div id="dialog-edit" class="modal hide fade">
      <h3>修改</h3>

      <form class="well form-horizontal" action="#" method="post">
         <div class="control-group">
            <label class="control-label" for="name">動畫名稱</label>
            <div class="controls">
               <input type="text" id="ani-name" name="name" value="">
            </div>
         </div>

         <div class="control-group">
            <label class="control-label" for="sub">相關網址</label>
            <div class="controls">
               <input type="text" id="ani-link" name="link" value="" placeholder="http://">
            </div>
         </div>

         <div class="control-group">
            <label class="control-label" for="sub">字幕組</label>
            <div class="controls">
               <input type="text" id="ani-sub" name="sub" value="">
            </div>
         </div>

         <div class="control-group">
            <label class="control-label" for="sub">集數</label>
            <div class="controls">
               <input type="text" id="ani-vol" name="vol" value="">
            </div>
         </div>

         <div class="control-group">
            <label class="control-label" for="sub">購入集數</label>
            <div class="controls">
               <input type="text" id="ani-buy" name="buy" value="">
            </div>
         </div>

         <div class="form-actions">
            <a class="btn btn-primary" id="submit-animation-change" href="#">修改</a>
            <a class="btn" href="#" data-dismiss="modal" aria-hidden="true">取消</a>
         </div>
      </form>
   </div>

<?php $this->load->view('footer');  ?>
