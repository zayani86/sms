<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="col-md-12">
    <div class="row">
        <div class="col-md-7">
            <div class="row">
                <!-- summary start -->
                <div class="col-md-12">
                    <div class="element-wrapper">
                        <h6 class="element-header">Profil Pengguna</h6>
                    </div>

                    <div class="card">
                        <div class="card-block p-0">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="user-image text-center">
										<img id="profile-img" name="profile-img" class="img-radius w-50 avatar img-circle img-thumbnail" src="<?php echo (isset($profile->profile_img) ? $profile->profile_img : assets_url().'images/general/avatar-blank.png'); ?>" alt="header event image" />

                                        <h6 class="f-w-600 m-t-15 m-b-10"><?php echo $this->session->nama; ?></h6>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="f-w-600 m-t-15 m-b-10">
                                        <?php echo date("A") == 'PM' ? 'Selamat Petang' : 'Selamat Pagi'; ?>
                                    </h5>
                                    <hr>
                                    <p class="text-muted"><?php echo $this->session->ptj_nama	?> - Unit</p>
                                    <hr>
                                    <p class="text-muted"><b>Log Masuk Terakhir</b><br><?php echo $this->session->old_last_login ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="element-wrapper">
                <h6 class="element-header">Pengumuman & Notifikasi</h6>
            </div>
            <div class="card-block p-0">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card notification-card">
                            <div class="card-block3">
                                <div class="row align-items-center">

                                    <div class="col-4 notify-icon"><i class="fa fa-bullhorn"></i></div>
                                    <div class="col-8 notify-cont">
                                        <a  href="javascript:void(0);" class="font-color pengumuman">
                                            <h4><?= $pengumuman_count ?></h4>
                                            <p>Pengumuman Baru</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

 

    <!-- MODAL Pengumuman START-->
    <div class="modal fade" id="Modal_Pengumuman" tabindex="-1" role="dialog" aria-labelledby="PengumumanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="PengumumanModalLabel">Pengumuman</h5>
            <button type="button" class="close" aria-label="Close"  data-dismiss="modal"> 
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                    <div class="dt-responsive ">
                        <table id="list_table" class="table compact " width='100%'>
                        <?php if(count($pengumuman) > 0 ) { ?>
                            <?php foreach($pengumuman as $key => $value) { ?>
                                <tr>
                                    <td>
										<div class="card-block ">
											<div class="card-comment ">
												<div class="card-block-large">
													<h5 ><U style="background-color: lightgrey">Tajuk: <?php echo $value->tajuk ?></U> </h5><br>
													<h6>Kepada: <?php echo $value->kepada ?> </h6>
													<p class="text-muted pull-left"><?php echo $value->keterangan ?></p>

													<div class="date" >
														<span class="pcoded-badge label label-info" style="font-size: 14px"><?php echo date("d-m-Y", strtotime($value->tarikh_mula)) ?></span><br><br>
														<span class="pcoded-badge label label-danger" style="font-size: 14px">Penting!</span><br><br>

													</div>
												</div>
											</div>

                                    </td>
                                </tr>
                            <?php } ?>

                        <?php } else { ?>
                            <tr>
                                <td>
                                    <p class="text-muted">Tiada Pengumuman</p>
                                </td>
                            </tr>
                        <?php } ?>
                        </table>
                    </div>                  
                </div>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" id="btn-close-modalDaftar" class="btn btn-inverse btn-outline-inverse" data-dismiss="modal"><i class="icofont icofont-close"></i><?php echo trans('general_btn_tutup') ?></button>                                                    -->
            </div>
        </div>
        </div>
    </div>
<!-- MODAL Pengumuman END-->

<!-- MODAL Notifikasi START-->
<div class="modal fade" id="Modal_Notifikasi" tabindex="-1" role="dialog" aria-labelledby="NotifikasiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="NotifikasiModalLabel">Notifikasi</h5>
        <button type="button" class="close" aria-label="Close"  data-dismiss="modal"> 
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <div class="col-lg-12">
                <div class="dt-responsive ">
                    <table id="list_table" class="table compact " width='100%'>
                        <tr>
                            <td>
                                <p class="text-wrap">Permohonan ID iSPEKS (No Rujukan: 00001) sedang menunggu untuk diproses.</p>
                                <p class="text-muted">01 Mac 2019 09:30 pagi</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="text-wrap">Permohonan ID iSPEKS (No Rujukan: 00001) sedang menunggu untuk diproses.</p>
                                <p class="text-muted">01 Mac 2019 09:00 pagi</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="text-wrap">Permohonan ID iSPEKS (No Rujukan: 00001) telah diluluskan.</p>
                                <p class="text-muted">01 Mac 2019 08:30 pagi</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="text-wrap">Sila semak semula permohonan tempahan bilik mesyuarat (No Rujukan 12001)</p>
                                <p class="text-muted">01 Mac 2019 08:15 pagi</p>
                            </td>
                        </tr>
                    </table>
                </div>                  
            </div>
        </div>
        <div class="modal-footer">
            <!-- <button type="button" id="btn-close-modalDaftar" class="btn btn-inverse btn-outline-inverse" data-dismiss="modal"><i class="icofont icofont-close"></i><?php echo trans('general_btn_tutup') ?></button>                                                    -->
        </div>
    </div>
    </div>
</div>
<!-- MODAL Notifikasi END-->

<script type="text/javascript">
    $('.pengumuman').click(function () { //button reset event click
        $('#Modal_Pengumuman').modal('show');
    });   
    $('.notifikasi').click(function () { //button reset event click
        $('#Modal_Notifikasi').modal('show');
    });   
</script>
