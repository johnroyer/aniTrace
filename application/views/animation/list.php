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
               <a href="#"><i class="action-icon icon-plus"></i></a>
               <a href="#"><i class="action-icon icon-minus"></i></a>
            </td>
            <td class="buy">
               <a href="#"><i class="action-icon icon-plus"></i></a>
               <a href="#"><i class="action-icon icon-minus"></i></a>
            </td>
            <td style=""> 
               <a class="action-link" href="#"><i class="action-icon icon-ok"></i>完結！</a>
            </td>
         </tr>

         <?php 

         if( count( $list ) > 0 ):
         
            foreach( $list as $row ):

         ?>

         <tr class="">
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['sub']; ?></td>
            <td class="volume"><?php echo $row['vol']; ?>
               <a href="<?php echo site_url('ani/vol/up/'.$row['sn']); ?>"><i class="action-icon icon-plus"></i></a>
               <a href="<?php echo site_url('ani/vol/down/'.$row['sn']); ?>"><i class="action-icon icon-minus"></i></a>
            </td>
            <td class="buy"><?php echo $row['buy']; ?>
               <a href="<?php echo site_url('ani/buy/up/'.$row['sn']); ?>"><i class="action-icon icon-plus"></i></a>
               <a href="<?php echo site_url('ani/buy/down/'.$row['sn']); ?>"><i class="action-icon icon-minus"></i></a>
            </td>
            <td style=""> 
               <a class="action-link" href="#"><i class="action-icon icon-ok"></i>完結！</a>
            </td>
         </tr>
      
         <?php 
               endforeach;

            else:
         ?>

         <tr>
            <td colspan="4" style="text-align: center;">尚無資料</td>
         </tr>

         <?php  endif;  ?>


      </tbody>
   </table>

<?php $this->load->view('footer');  ?>
