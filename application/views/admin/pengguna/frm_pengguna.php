<style>
    /* .modal{
		z-index: 100000 !important;
	} */

    .select2-container--open {
        z-index: 9999999 !important;
    }
</style>
<?php defined('BASEPATH') or exit('No direct script access allowed');  ?>

<?php echo form_open_multipart(site_url($actionform) . url_akses(), array('method' => 'post', 'name' => 'add', 'id' => 'form_entry')); ?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-block2">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="tab-content">
                            <div class="alert alert-danger icons-alert text-inverse" id="errorTxt" style="display: none;">

                            </div>
                            <div class="tab-pane active" id="maklumat">
                                <div class="p-t-20 p-b-20">
                                    <h5>Maklumat Pengguna</h5>
                                    <?php if (!validation_errors()) { ?>
                                        <p style="font-style: italic">Sila isikan maklumat pengguna berikut dan pastikan alamat <strong>emel</strong> adalah sah.</p>
                                    <?php } else { ?>
                                        <span class="text-danger">
                                            <?php echo validation_errors(); ?>
                                        </span>
                                    <?php } ?>
									<div class="errorTxt">
										<span id="errNm2"></span>
										<span id="errNm1"></span>
									</div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nama<span class="text-danger">&#42;</span></label>
                                    <div class="col-sm-9">
                                        <input id="name" name="name" type="text" class="form-control <?php echo (empty(form_error('name'))) ? '' : 'is-invalid'; ?>" value="<?php echo set_value('name', isset($profile->name) ? $profile->name : ''); ?>">
									</div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nama Singkatan<span class="text-danger">&#42;</span></label>
                                    <div class="col-sm-9">
                                        <input id="nama_ringkasan" name="nama_ringkasan" type="text" class="form-control <?php echo (empty(form_error('nama_ringkasan'))) ? '' : 'is-invalid'; ?>" value="<?php echo set_value('nama_ringkasan', isset($profile->nama_ringkasan) ? $profile->nama_ringkasan : ''); ?>" maxlength="10">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">ID Pengguna<span class="text-danger">&#42;</span></label>
                                    <div class="col-sm-9">
                                        <?php if ($mode == 'add') { ?>
                                            <div class="input-group">
                                                <input type="text" class="form-control text-center numbers_only <?php echo (empty(form_error('ic1'))) ? '' : 'is-invalid';
                                                                                                                echo (empty(form_error('ic'))) ? '' : 'is-invalid'; ?>" name="ic1" id="ic1" maxlength="6" value="<?php echo set_value('ic1', isset($profile->no_pengenalan_1) ? $profile->no_pengenalan_1 : ''); ?>">
                                                <span class="input-group-addon bg-white text-muted">-</span>
                                                <input type="text" class="form-control text-center numbers_only <?php echo (empty(form_error('ic2'))) ? '' : 'is-invalid';
                                                                                                                echo (empty(form_error('ic'))) ? '' : 'is-invalid'; ?>" name="ic2" id="ic2" maxlength="2" value="<?php echo set_value('ic2', isset($profile->no_pengenalan_1) ? $profile->no_pengenalan_1 : ''); ?>">
                                                <span class="input-group-addon bg-white text-muted">-</span>
                                                <input type="text" class="form-control text-center numbers_only <?php echo (empty(form_error('ic3'))) ? '' : 'is-invalid';
                                                                                                                echo (empty(form_error('ic'))) ? '' : 'is-invalid'; ?>" name="ic3" id="ic3" maxlength="4" value="<?php echo set_value('ic3', isset($profile->no_pengenalan_1) ? $profile->no_pengenalan_1 : ''); ?>">
                                            </div>
                                        <?php } else { ?>
                                            <label class="col-form-label"><strong id="id_pengguna"><?= substr($user->username, 0, 6) . "-" . substr($user->username, 6, 2) . "-" . substr($user->username, 8, 4) ?></strong></label>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Emel Rasmi<span class="text-danger">&#42;</span></label>
                                    <div class="col-sm-9">
                                        <input id="email" name="email" type="text" class="form-control <?php echo (empty(form_error('email'))) ? '' : 'is-invalid'; ?>" value="<?php echo set_value('email', isset($profile->email) ? $profile->email : ''); ?>">
                                        <input type="hidden" id="email_old" name="email_old" value="<?php echo (isset($profile->email) ? $profile->email : ""); ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">No. Tel. Pejabat</label>
                                    <div class="col-sm-9">
                                        <input id="no_tel_pejabat" name="no_tel_pejabat" type="text" class="form-control tel_no <?php echo (empty(form_error('no_tel_pejabat'))) ? '' : 'is-invalid'; ?>" value="<?php echo set_value('no_tel_pejabat', isset($profile->no_tel) ? $profile->no_tel : ''); ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">No. Tel. Bimbit</label>
                                    <div class="col-sm-9">
                                        <input id="no_tel_bimbit" name="no_tel_bimbit" type="text" class="form-control hp_no <?php echo (empty(form_error('no_tel_bimbit'))) ? '' : 'is-invalid'; ?>" value="<?php echo set_value('no_tel_bimbit', isset($profile->no_hp) ? $profile->no_hp : ''); ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Example Dropdown</label>
                                    <div class="col-sm-9">
                                        <select name="test" id="test" class="form-control">
                                            <option value="">-- Sila Pilih --</option>
                                            <?= generate_option_konf_kod_by_kategory('TEST', set_value('test', isset($profile->konf_unit_id) ? $profile->konf_unit_id : "")); ?>
                                        </select>
                                    </div>
                                </div>

                                <hr>

               

                            </div>
                            <!--/tab-pane-->
                            <div class="tab-pane" id="peranan">

                            </div>
                            <!--/tab-pane-->

                            <div class="tab-pane" id="akses">

                            </div>
                            <div class="pull-left">
                                <a class="btn btn-inverse" href="<?php echo base_url('admin/profile/user_list') . url_akses() ?>"><i class="icofont icofont-arrow-left"></i><?= gettext('Kembali') ?></a>
                            </div>
                            <div class="pull-right">
                                <button type="submit" id="btn_form_simpan" class="btn btn-primary"><i class="icofont icofont-save"></i><?= gettext('Simpan') ?></button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
<style>
    .swal2-container {
        z-index: 10000;
    }
</style>

