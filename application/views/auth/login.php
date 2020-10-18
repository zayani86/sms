<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container ">
	<div class="row d-flex justify-content-around desktop" >
		<div class="col-sm-6">
			<img src="<?php echo assets_url(); ?>images/general/logo-sistem_old.png" class="">
		</div>
		<div class="col-sm-6">
			<div class="row" >
			<div class="col-sm-2"></div>
			<div class="col-sm-2" style="margin-left: 20px">
				<div class="main-div-logo">
					<img src="<?php echo assets_url(); ?>images/general/logo-sistem.png" class="" style="width: 250px">
				</div>
			</div>
			<div class="col-sm-2"></div>
			</div>
		</div>
	</div>

	<div class="row d-flex justify-content-around mobile" align="center" >
			<div class="col-sm-6">
				<img src="<?php echo assets_url(); ?>images/general/logo-sistem_old.png" class="" style="width: 150px">
				<img src="<?php echo assets_url(); ?>images/general/logo-sistem.png" class="" style="width: 110px;margin-top:10px">
			</div>
	</div>

	<div class="row d-flex justify-content-around">
		<div class="col-sm-6 col-lg-6"></div>
		<div class="col-sm-6 col-lg-6">
			<div class="login-form p-t-20">
				<div class="main-div">
					<div class="panel">
						<h2>Log Masuk</h2>
						<span class="text-black">Sila Masukkan ID Pengguna dan Kata Laluan</span>
						<!-- <span class="text-blue"><?php //echo isset($_SESSION['auth_message']) ? $_SESSION['auth_message'] : FALSE;?></span> -->
					</div>
					<div class="text-warning text-center">
						<?php echo isset($_SESSION['auth_message']) ? $_SESSION['auth_message'] : FALSE;?>
					</div>
					<?php echo form_open("auth/login"); ?>
					<div class="form-group pt-3 pb-2 input-group input-group-primary">
						<span class="input-group-addon" id="basic-addon1"><i class="ti-user"></i></span>
						<input class="form-control" placeholder="ID Pengguna" id="identity" name="identity" type="tel" autofocus  >
						<!-- <?php echo form_input($identity);?> -->
					</div>

					<div class="form-group pb-2 input-group input-group-primary">
						<span class="input-group-addon" id="basic-addon1"><i class="ti-key"></i></span>
						<input class="form-control" placeholder="Katalaluan"  id="password" name="password"  type="password"  >
					</div>
					<div class="row">
						<div class="col-lg-6">
							<button type="reset" class="btn btn-cancel-login"><i class="ti-reload"></i> Set Semula</button>
						</div>
						<div class="col-lg-6">
							<button type="submit" class="btn btn-blue-login" value="login" name="login"><i class="ti-lock"></i> Log Masuk</button>
						</div>
					</div>
					<div class="forgot text-black text-center p-3">
						Lupa Kata Laluan? <a href="JavaScript:void(0);" id="btn-reset_password" class="text-black">Klik sini</a>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
  'use strict';

  $(function() {
    $("#identity").inputmask({ mask: "999999-99-9999"});
  
  })

    $(document).ready(function() {
  
        $('#btn-reset_password').click(function (event) {
            event.preventDefault();

            Swal.fire({
            type: 'question',
            html:
                'Sila masukkan <b>emel</b> anda untuk set semula katalaluan akaun anda dibawah',
            input: 'email',
            inputAttributes: {
                autocapitalize: 'off'
            },

            showCancelButton: true,
            showConfirmButton: true,
            confirmButtonText: 'Hantar',
            cancelButtonText: 'Batal',
           
            allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.value) {
                var formData = new FormData();

                formData.append("email",result.value);
                    
                $.ajax({
                    url: "<?php echo base_url('daftar/set_katalaluan') ?>",
                    type: "post",
                    data: formData,
                    datatype: "json",
                    async: true,
                    processData: false,
                    contentType: false,
                    
                    })

                    .done(function (resultJSON) {
                        
                        var data = jQuery.parseJSON(resultJSON);
                        
                        if (data.success == false) {
                            Swal(
                                'Ralat!',
                                'Email yang dimasukkan tiada dalam rekod pengguna sistem.',
                                'error'
                                )
                        }
                        else 
                        {
                            swal({
                                title: 'Berjaya',
                                html: 'Maklumat akses pengguna yang baru telah dihantar ke email anda.',
                                type: 'success'
                            })
                        }
                    })

                    .fail(function (jqXHR, ajaxOptions, thrownError) {
                        Swal(
                        'Ralat!',
                        'Rekod gagal untuk disimpan.',
                        'error'
                        )
                    });
                }
            })
        })
    });
</script>
