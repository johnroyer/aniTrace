<?php
   $this->load->view('header');  
   $this->load->view('navbar'); 
   $this->load->helper('url');  
?>

   <h2>Hello, <?php echo $user['username']; ?></h2>

   <p id="list-control">
      <i class="icon-plus-sign"></i><a href="<?php echo site_url('ani/addAni'); ?>">Add</a>
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

<?php $this->load->view('footer');  ?>
