<?php
$this->load->view('header');  
$this->load->view('navbar'); 
$this->load->helper('url');  
?>

   <h2>Hello, <?php echo $user['id']; ?></h2>

   <p style="margin-top: 25px;"></p>

   <table class="table">
      <tbody>
         <tr>
            <td>動畫</td>
            <td>字幕組</td>
            <td>集數</td>
            <td></td>
         </tr>

         <tr id="list-template">
            <td></td>
            <td></td>
            <td class="volume"></td>
            </td>
            <td style=""> 
               <a href="#"><i class="action-icon icon-plus"></i></a>
               <a href="#"><i class="action-icon icon-minus"></i></a>
               <a class="action-link" href="#"><i class="action-icon icon-ok"></i>完結！</a>
            </td>
         </tr>
      </tbody>
   </table>

<?php $this->load->view('footer');  ?>
