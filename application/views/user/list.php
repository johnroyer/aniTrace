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

         <tr>
            <td>宇宙超級無敵媒人能比的非常多字的動畫名稱</td>
            <td>liuming</td>
            <td class="volume">8</td>
            </td>
            <td style=""> 
               <a href="#"><i class="action-icon icon-plus"></i></a>
               <a href="#"><i class="action-icon icon-minus"></i></a>
               <a class="action-link" href="#"><i class="action-icon icon-ok"></i>看完了！</a>
            </td>
         </tr>

         <tr>
            <td>CLANNAD</td>
            <td>DHR</td>
            <td class="volume">18</td>
            <td style=""> 
               <a href="#"><i class="action-icon icon-plus"></i></a>
               <a href="#"><i class="action-icon icon-minus"></i></a>
               <a class="action-link" href="#"><i class="action-icon icon-ok"></i>看完了！</a>
            </td>
         </tr>

         <tr>
            <td>海賊王</td>
            <td>N/A</td>
            <td class="volume">511</td>
            </td>
            <td style=""> 
               <a href="#"><i class="action-icon icon-plus"></i></a>
               <a href="#"><i class="action-icon icon-minus"></i></a>
               <a class="action-link" href="#"><i class="action-icon icon-ok"></i>看完了！</a>
            </td>
         </tr>
      </tbody>
   </table>

<?php $this->load->view('footer');  ?>
