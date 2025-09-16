<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo isset($page_title)?$page_title . " | ":"";?><?php echo $company->name; ?></title>

  <base href="<?php echo base_url();?>">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url("assets/AdminLTE-3.2.0/");?>/plugins/fontawesome-free/css/all.min.css">
  <?php if(!empty($stylesheets)) foreach($stylesheets as $s):?>
  <!-- Additional StyleSheets -->
  <link rel="stylesheet" href="<?php echo $s;?>" />
  <!-- End of Additional StyleSheets -->
  <?php endforeach;?>

  <!-- Favicon -->
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url('assets/favicon/apple-touch-icon.png');?>">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url('assets/favicon/favicon-32x32.png');?>">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('assets/favicon/favicon-16x16.png');?>">
  <link rel="manifest" href="<?php echo base_url('assets/favicon/site.webmanifest');?>">

  <script>
    var base_url = "<?php echo base_url();?>";
  </script>
</head>
<body>
      <?php if( (isset($content)) && (!empty($content)) ){
        if(is_array($content)){
          foreach($content as $idx => $block){
            echo "\r\n<!-- BLOCK CONTENT ".($idx+1)." STARTS HERE -->\r\n";
            echo $block;
            echo "\r\n<!-- END OF BLOCK CONTENT ".($idx+1)." -->\r\n";
          }
        }else{
          echo $content;
        }
      }?>
<!-- jQuery -->
<script src="<?php echo base_url("assets/AdminLTE-3.2.0/");?>/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url('assets/js/pages/orders_receipt.js')."?".date("YmdHis"); ?>"></script>
</body>
</html>
