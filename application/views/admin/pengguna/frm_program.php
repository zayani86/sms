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
                                    <h5> Program</h5>
                                    <?php if (!validation_errors()) { ?>
                                        <p style="font-style: italic"></p>
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
                                    <label class="col-sm-3 col-form-label">Tarikh<span class="text-danger">&#42;</span></label>
                                    <div class="col-sm-9">
                                        <input id="tarikh" name="tarikh" type="text" class="form-control <?php echo (empty(form_error('name'))) ? '' : 'is-invalid'; ?>" value="<?php echo set_value('name', isset($profile->name) ? $profile->name : ''); ?>">
									</div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Tajuk Program<span class="text-danger">&#42;</span></label>
                                    <div class="col-sm-9">
                                        <input id="tarikh" name="tajuk_program" type="text" class="form-control ">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Jenis Program<span class="text-danger">&#42;</span></label>
                                    <div class="col-sm-9">
                                        <select name="jenis_program" id="test" class="form-control">
                                            <option value="">-- Sila Pilih --</option>
                                            <?= generate_option_konf_kod_by_kategory('PROGRAM', set_value('jenis_program', isset($profile->konf_unit_id) ? $profile->konf_unit_id : "")); ?>
                                        </select>                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Pendekatan<span class="text-danger">&#42;</span></label>
                                    <div class="col-sm-9">
                                        <select name="pendekatan" id="test" class="form-control">
                                            <option value="">-- Sila Pilih --</option>
                                            <?= generate_option_konf_kod_by_kategory('PENDEKATAN', set_value('pendekatan', isset($profile->konf_unit_id) ? $profile->konf_unit_id : "")); ?>
                                        </select>  
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Perkhidmatan</label>
                                    <div class="col-sm-9">
                                        <select name="perkhidmatan" id="test" class="form-control">
                                            <option value="">-- Sila Pilih --</option>
                                            <?= generate_option_konf_kod_by_kategory('PERKHIDMATAN', set_value('perkhidmatan', isset($profile->konf_unit_id) ? $profile->konf_unit_id : "")); ?>
                                        </select>  
									</div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Fokus</label>
                                    <div class="col-sm-9">
                                        <select name="fokus" id="test" class="form-control">
                                            <option value="">-- Sila Pilih --</option>
                                            <?= generate_option_konf_kod_by_kategory('FOKUS', set_value('fokus', isset($profile->konf_unit_id) ? $profile->konf_unit_id : "")); ?>
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
                                <button type="submit" id="btn_form_simpan" class="btn btn-primary"><i class="icofont icofont-save"></i><?= gettext('Seterusnya') ?></button>
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

