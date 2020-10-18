<!DOCTYPE html>
<html lang="en">

<head>
	<title><?php echo $title; ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui,user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<base href="<?= base_url() ?>">

	<?php
	if (!empty($meta))
		foreach ($meta as $name => $content) {
			echo "\n\t\t";
	?>
		<meta name="<?php echo $name; ?>" content="<?php echo is_array($content) ? implode(", ", $content) : $content; ?>" /><?php
																															}
																																?>

	<!-- Favicon icon -->
	<link rel="icon" href="<?php echo assets_url(); ?>images/favicon.ico" type="image/x-icon">
	<!-- Google font-->
	<link href="<?php echo assets_url(); ?>css/google_font.css" rel="stylesheet">
	<!-- Required Fremwork -->
	<link rel="stylesheet" type="text/css" href="<?php echo assets_url(); ?>components/bootstrap/css/bootstrap.min.css">
	<!-- themify icon -->
	<link rel="stylesheet" type="text/css" href="<?php echo assets_url(); ?>icon/themify-icons/themify-icons.css">
	<!-- ico font -->
	<link rel="stylesheet" type="text/css" href="<?php echo assets_url(); ?>icon/icofont/css/icofont.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" type="text/css" href="<?php echo assets_url(); ?>icon/font-awesome/css/font-awesome.min.css">
	<!-- scrollbar.css -->
	<link rel="stylesheet" type="text/css" href="<?php echo assets_url(); ?>css/jquery.mCustomScrollbar.css">

	<!-- jquery file upload Frame work -->
	<link rel="stylesheet" type="text/css" href="<?php echo assets_url(); ?>components/jquery.filer/css/jquery.filer.css">

	<!-- Style.css -->
	<link rel="stylesheet" type="text/css" href="<?php echo assets_url(); ?>css/style.css">
	<!-- JTS Styling .css -->
	<link rel="stylesheet" type="text/css" href="<?php echo assets_url(); ?>css/style_jts.css">

	<!-- sweet alert framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo assets_url(); ?>components/sweetalert2/css/sweetalert2.css">

	<!-- Data Table Css -->
	<link rel="stylesheet" type="text/css" href="<?php echo assets_url(); ?>components/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo assets_url(); ?>components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo assets_url(); ?>components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo assets_url(); ?>components/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">

	<link rel="stylesheet" type="text/css" href="<?php echo assets_url(); ?>pages/data-table/css/buttons.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo assets_url(); ?>pages/data-table/extensions/buttons/css/buttons.dataTables.min.css">

	<!-- Style.css -->
	<script src="<?php echo assets_url(); ?>components/jquery/js/jquery.min.js "></script>

	<!-- jquery file upload js -->
	<script src="<?php echo assets_url(); ?>components/jquery.filer/js/jquery.filer.min.js"></script>
	<!-- <script src="<?php echo assets_url(); ?>components/filer/custom-filer.js" ></script> -->
	<script src="<?php echo assets_url(); ?>components/filer/jquery.fileuploads.init.js"></script>

	<!-- Required Jquery -->
	<script src="<?php echo assets_url(); ?>components/jquery-ui/js/jquery-ui.min.js"></script>
	<script src="<?php echo assets_url(); ?>js/umd/popper.min.js"></script>
	<script src="<?php echo assets_url(); ?>components/bootstrap/js/bootstrap.min.js"></script>

	<!-- modernizr js -->
	<script src="<?php echo assets_url(); ?>components/modernizr/js/modernizr.js "></script>
	<!-- slimscroll js -->
	<script src="<?php echo assets_url(); ?>js/SmoothScroll.js"></script>
	<!-- menu js -->
	<script src="<?php echo assets_url(); ?>js/vertical/vertical-layout.min.js "></script>
	<!-- custom js -->
	<script src="<?php echo assets_url(); ?>components/bootstrap/js/bootstrap.js "></script>
	<!-- Select 2 css -->
	<link rel="stylesheet" href="<?php echo assets_url(); ?>components/select2/css/select2.min.css" />
	<!--forms-wizard css-->
	<link rel="stylesheet" type="text/css" href="<?php echo assets_url(); ?>components/jquery.steps/css/jquery.steps.css">

	<!-- Treeview css -->
	<link rel="stylesheet" type="text/css" href="<?php echo assets_url(); ?>components/jstree/css/style.min.css">

	<?php

	foreach ($css as $file) {
		echo "\n\t\t";
	?>
		<link rel="stylesheet" href="<?php echo $file; ?>" type="text/css" /><?php
																			}
																			echo "\n\t";
																				?>



	<?php echo $this->load->get_section('js_header'); ?>

	<?php if ($this->session->flashdata('alert-success')) { ?>
		<script type="text/javascript">
			$(document).ready(function() {
				swal({
					html: "<?php echo $this->session->flashdata('alert-success'); ?>",
					type: "success",
					showCancelButton: false,
					confirmButtonText: 'OK',
					allowOutsideClick: false
				});
			})
		</script>
	<?php } ?>

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

<body>






	<!-- Pre-loader start -->
<!--	--><?php //if (ENVIRONMENT == 'production') { ?>
		<div class="theme-loader">
			<div class="loader-track">
				<div class="loader-bar"></div>
			</div>
		</div>
<!--	--><?php //} ?>
	<!-- Pre-loader end -->
	<div id="pcoded" class="pcoded">
		<div class="pcoded-overlay-box"></div>
		<div class="pcoded-container navbar-wrapper">
			<nav class="navbar header-navbar pcoded-header">
				<div class="navbar-wrapper">
					<div class="navbar-logo">
						<a class="mobile-menu" id="mobile-collapse" href="javascript:void(0);">
							<i class="ti-menu"></i>
						</a>
						<a href="javascript:void(0);">
							<img class="img-fluid" src="<?php echo assets_url(); ?>images/general/logo_header.png" alt="Logo" />
						</a>
						<a class="mobile-options">
							<i class="ti-more"></i>
						</a>
					</div>

					<div class="navbar-container container-fluid">
						<ul class="nav-left">
							<li>
								<div class="sidebar_toggle"><a href="javascript:void(0);"><i class="ti-menu"></i></a>
								</div>
							</li>

							<li>
								<a href="javascript:void(0);" onclick="javascript:toggleFullScreen()">
									<i class="ti-fullscreen"></i>
								</a>
							</li>


							<li>
								<div style="top: calc(50% - 8px);font-size: 14px; height: 56px;">
									<p style="color: #FFF;"><?php echo $this->session->ptj_nama	?><?php echo !empty(get_konf_unit(get_session('unit_id'))) ? ' - Unit ' .get_konf_unit(get_session('unit_id')) : '' ?> </p>
								</div>
							</li>
							<li>
								<div style="top: calc(50% - 8px);font-size: 14px; height: 56px;">
									<p style="color: #FFF;">[ <?php echo strtoupper($this->session->role_name)	?> ] </p>
								</div>
							</li>
						</ul>
						<ul class="nav-right">
							<li class="user-profile header-notification">

								<?php
								$CI = &get_instance();
								$CI->load->model('sistem_model');
								$profile =  $CI->sistem_model->pengguna_get_profile(get_session('user_id'));
								?>

								<a href="javascript:void(0);">
									<img src="<?php echo (!empty($profile->profile_img) ? $profile->profile_img : assets_url().'images/general/avatar-blank.png'); ?>" class="img-radius gambar" alt="User-Profile-Image">
									<span><?php echo $this->session->username; ?></span>
									<i class="ti-angle-down"></i>
								</a>
								<ul class="show-notification profile-notification">
									<?php
									$CI = &get_instance();
									$CI->load->model('sistem_model');
									$ptj = $CI->sistem_model->get_ptj_by_profile(get_session('user_id'));

									?>
									<?php if (count($ptj) > 1) { ?>
										<li>
											<a href="javascript:void(0)" data-toggle="modal" data-target="#tukarptjModal">
												<i class="ti-control-shuffle"></i> Pusat Tanggungjawab
											</a>
										</li>
									<?php } ?>

									<li>
										<a href="<?php echo base_url('profil/set_user_profile') ?>">
											<i class="ti-user"></i> Profil Saya
										</a>
									</li>
									<li>
										<a href="<?php echo base_url(); ?>auth/logout">
											<i class="ti-layout-sidebar-left"></i> Log Keluar
										</a>
									</li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</nav>
			<!-- Sidebar inner chat end-->
			<div class="pcoded-main-container">
				<div class="pcoded-wrapper">
					<!-- Side menu start -->
					<?php $this->view('themes/v1/sidemenu'); ?>
					<!-- Side menu end -->


					<div class="pcoded-content">
						<div class="pcoded-inner-content">
							<div class="main-body">
								<div class="page-wrapper">
								<?php echo $this->breadcrumbs->generate($lastnewcrumb); ?>
									<div class="page-body">
										<?php echo $output; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="footer2">
			<?php echo $meta['copyright'] ?>
		</div>
	</div>

	<!-- modal section start -->
	<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog" style="z-index: 1050; display: none;" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalTitle"></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="modal-theme-loader">
						<div class="loader-track">
							<div class="loader-bar"></div>
						</div>
					</div>
					<div id="modalBody"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- modal section end -->



	<div class="modal fade" id="tukarptjModal" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Pusat Tanggungjawab</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="col-sm-12">
						<div class="alert alert-info icons-alert text-inverse">
							<p>Sila klik Pusat Tanggungjawab yang berkenaan jika anda ingin ubah akses ke Pusat
								Tanggungjawab tersebut.
							</p>
						</div>
						<div class="form-group row">
							<div class="col-md-12 ">
								<p class="m-b-10">Kini anda akses kepada <code>(<?php echo (get_session("ptj_kod")); ?>) -
										<?php echo (get_session("ptj_nama")); ?></code>.</p>
							</div>
						</div>
						<div class="form-group row p-t-20">
							<div class="col-md-12 ">
								<p>Lain-lain Pusat Tanggungjawab :</p>
								<?php foreach ($ptj as $value) { ?>
										<a href="<?= base_url("profil/set_ptj/". $value->konf_ptj_id."/") . $value->id; ?>" class="font-color ">
											<div class="card notification-card bg-default">
												<div class="card-block2 ">
													<div class="row align-items-center ">
														<div class="col-12 notify-cont">
															<h6><?= $value->ptj_kod; ?> - <?= $value->ptj_nama; ?><br>[ <?php echo strtoupper($value->role_name); ?> ]</h6>
														</div>
													</div>
												</div>
											</div>
										</a>

								<?php } ?>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
				</div>
			</div>
		</div>
	</div>

	<!-- jquery slimscroll js -->
	<script src="<?php echo assets_url(); ?>components/jquery-slimscroll/js/jquery.slimscroll.js"></script>
	<!-- sweet alert js -->
	<script src="<?php echo assets_url(); ?>components/sweetalert2/js/sweetalert2.min.js"></script>
	<!-- modernizr js -->
	<script src="<?php echo assets_url(); ?>components/modernizr/js/modernizr.js"></script>
	<script src="<?php echo assets_url(); ?>components/modernizr/js/css-scrollbars.js"></script>
	<!-- data-table js -->
	<script src="<?php echo assets_url(); ?>components/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo assets_url(); ?>components/datatables.net-buttons/js/dataTables.buttons.min.js">
	</script>
	<script src="<?php echo assets_url(); ?>components/datatables.net-buttons/js/buttons.print.min.js"></script>
	<script src="<?php echo assets_url(); ?>components/datatables.net-buttons/js/buttons.html5.min.js"></script>
	<script src="<?php echo assets_url(); ?>components/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="<?php echo assets_url(); ?>components/datatables.net-responsive/js/dataTables.responsive.min.js">
	</script>
	<script src="<?php echo assets_url(); ?>components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js">
	</script>
	<script src="<?php echo assets_url(); ?>pages/data-table/extensions/buttons/js/dataTables.buttons.min.js">
	</script>
	<!-- Tree view js -->
	<script src="<?php echo assets_url(); ?>components/jstree/js/jstree.min.js"></script>
	<script src="<?php echo assets_url(); ?>pages/treeview/jquery.tree.js"></script>






	<!-- Custom js -->
	<script src="<?php echo assets_url(); ?>js/pcoded.min.js"></script>
	<!-- menu js -->
	<!-- <script src="<?php echo assets_url(); ?>js/vertical/vertical-layout.min.js "></script> -->
	<script src="<?php echo assets_url(); ?>js/jquery.mCustomScrollbar.concat.min.js"></script>
	<!-- Masking js -->
	<script src="<?php echo assets_url(); ?>pages/form-masking/inputmask.js"></script>
	<script src="<?php echo assets_url(); ?>pages/form-masking/jquery.inputmask.js"></script>
	<script src="<?php echo assets_url(); ?>pages/form-masking/autoNumeric.js"></script>
	<script src="<?php echo assets_url(); ?>js/form-mask.js"></script>
	<!--Forms - Wizard js-->
	<script src="<?php echo assets_url(); ?>components/jquery.cookie/js/jquery.cookie.js"></script>
	<script src="<?php echo assets_url(); ?>components/jquery.steps/js/jquery.steps.js"></script>
	<script src="<?php echo assets_url(); ?>components/jquery-validation/js/jquery.validate.js"></script>
	<!-- Select 2 js -->
	<script src="<?php echo assets_url(); ?>components/select2/js/select2.full.min.js"></script>
	<!-- Validation js -->
	<script src="<?php echo assets_url(); ?>js/form-validation.js"></script>
	<script src="<?php echo assets_url(); ?>js/moment.js"></script>
	<script src="<?php echo assets_url(); ?>js/script.js"></script>
	<script src="<?php echo assets_url(); ?>pages/data-table/extensions/buttons/js/extension-btns-custom.js">
	</script>
	<!-- notification js -->
	<script src="<?php echo assets_url(); ?>js/notification.js"></script>
	<!-- Global js -->
	<script src="<?php echo assets_url(); ?>js/form-global.js"></script>
	<script src="<?php echo assets_url(); ?>components/jquery/js/jquery.json.js "></script>
	<?php
	foreach ($js as $file) {
		echo "\n\t\t";
	?><script src="<?php echo $file; ?>"></script><?php
													}
													echo "\n\t";
														?>

	<?php echo $this->load->get_section('js_footer'); ?>
</body>

</html>
