<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo $title; ?></title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
    <!-- Meta -->
    <!-- Fareez -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<base href="<?=base_url()?>">

	<?php
		if(!empty($meta)) 
			foreach($meta as $name=>$content){
				echo "\n\t\t"; 
				?><meta name="<?php echo $name; ?>" content="<?php echo is_array($content) ? implode(", ", $content) : $content; ?>" /><?php
		 }
	?>
    
    <link rel="icon" href="<?php echo assets_url(); ?>images/favicon.ico" type="image/x-icon">
    <link href="<?php echo assets_url(); ?>css/google_font.css"  rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo assets_url(); ?>components/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo assets_url(); ?>icon/themify-icons/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="<?php echo assets_url(); ?>css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo assets_url(); ?>css/style_master.css">
	<link rel="stylesheet" type="text/css" href="<?php echo assets_url(); ?>components/sweetalert2/css/sweetalert2.css">
    <script  src="<?php echo assets_url(); ?>components/jquery/js/jquery.min.js"></script>

    <?php if (!empty($js)) {echo $js;}?>

    <?php if ($this->session->flashdata('alert-error')) { ?>
		<script type="text/javascript">
			$(document).ready(function() {
				swal({
					html: "<?php echo $this->session->flashdata('alert-error'); ?>",
					type: "error",
					showCancelButton: false,
					confirmButtonText: 'OK',
					allowOutsideClick: false
				});
			})
		</script>
    <?php } ?>
    
</head>

<body id="LoginForm">
    <div class="login-page">
        <!-- <?php if (ENVIRONMENT == 'production') {?> -->
            <div class="theme-loader">
                <div class="loader-track">
                    <div class="loader-bar"></div>
                </div>
            </div>
        <!-- <?php }?> -->
        <?php echo $output;?>
    </div>

    <!-- Required Jquery -->
    <script src="<?php echo assets_url(); ?>components/jquery-ui/js/jquery-ui.min.js"></script>
    <script src="<?php echo assets_url(); ?>components/popper.js/js/popper.min.js"></script>
    <script src="<?php echo assets_url(); ?>components/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo assets_url(); ?>components/jquery.cookie/js/jquery.cookie.js"></script>
    <script src="<?php echo assets_url(); ?>js/script.js"></script>
	<script src="<?php echo assets_url(); ?>components/sweetalert2/js/sweetalert2.min.js"></script>
	<script src="<?php echo assets_url(); ?>components/jquery-slimscroll/js/jquery.slimscroll.js"></script>
	<script src="<?php echo assets_url(); ?>js/jquery.mCustomScrollbar.concat.min.js"></script>

    <!-- Masking js -->
    <script src="<?php echo assets_url(); ?>pages/form-masking/inputmask.js"></script>
    <script src="<?php echo assets_url(); ?>pages/form-masking/jquery.inputmask.js"></script>
    <script src="<?php echo assets_url(); ?>pages/form-masking/autoNumeric.js"></script>

</body>

</html>
