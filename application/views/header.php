<?php  $this->load->helper('url'); ?>
<!doctype html>
<html>
   <head>
      <meta http-equiv="content-type" content="text/html; charset=utf-8" />

      <!-- Refresh every 1 hour -->
      <?php if( $loggedin == true ): ?>
         <meta http-equiv="refresh" content="3600" />
      <?php endif; ?>

      <title>aniTrace</title>
      <link rel="stylesheet" href="<?php echo base_url(); ?>/css/bootstrap.min.css" type="text/css" charset="utf-8">
      <link rel="stylesheet" href="<?php echo base_url(); ?>/css/font-awesome.css" type="text/css" charset="utf-8">
      <link rel="stylesheet" href="<?php echo base_url(); ?>/css/style.css" type="text/css" charset="utf-8">
   </head>
   <body>

   <div  class="container">
