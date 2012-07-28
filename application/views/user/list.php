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
            <td>Animation Name</td>
            <td>Vol</td>
            <td>Actions</td>
         <tr>

      <tr>
         <td>CLANNAD</td>
         <td style="width: 200px;"> 
            <span style="margin-right: 20px;">4</span>
            <a href="#"><i class="icon-plus"></i></a>
            <a href="#"><i class="icon-minus"></i></a>
         </td>
         <td style=""> 
            <a class="action-link" href="#"><i class="action-icon icon-ok"></i>Finished !!!</a>
         </td>
      </tr>
      </tbody>
   </table>

<?php $this->load->view('footer');  ?>
