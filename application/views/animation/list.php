<?php
   $this->load->view('header');  
   $this->load->view('navbar'); 
   $this->load->helper('url');  
?>

   <h2>Hello, <?php echo $user['username']; ?></h2>

   <p id="list-control">
      <i class="icon-plus-sign"></i><a href="<?php echo site_url('ani/addAni'); ?>">Add</a>
   </p>

   <table class="table">
      <tbody>
         <tr>
            <td>動畫</td>
            <td>字幕組</td>
            <td>集數</td>
            <td>購入集數</td>
            <td></td>
         </tr>

         <tr class="row-template">
            <td></td>
            <td></td>
            <td class="volume">
               <i class="action-icon icon-plus"></i>
               <i class="action-icon icon-minus"></i>
            </td>
            <td class="buy">
               <i class="action-icon icon-plus"></i>
               <i class="action-icon icon-minus"></i>
            </td>
            <td style=""> 
               <i class="action-icon icon-ok"></i>完結！
            </td>
         </tr>

      </tbody>
   </table>

<?php $this->load->view('footer');  ?>
