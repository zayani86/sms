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
                                    <h5> Individu</h5>
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
                                    <label class="col-sm-3 col-form-label">Perkara<span class="text-danger">&#42;</span></label>
                                    <div class="col-sm-9">
                                           <textarea name="perkara" class="form-control" rows="4"></textarea> 
									</div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Persoalan<span class="text-danger">&#42;</span></label>
                                    <div class="col-sm-9">
                                        <textarea name="persoalan" class="form-control" rows="4"></textarea>                             </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Tindakan/Intevensi<span class="text-danger">&#42;</span></label>
                                    <div class="col-sm-9">
                                        <select name="intevensi" id="test" class="form-control">
                                            <option value="">-- Sila Pilih --</option>
                                            <?= generate_option_konf_kod_by_kategory('SASARAN', set_value('sasaran', isset($profile->konf_unit_id) ? $profile->konf_unit_id : "")); ?>
                                        </select>  
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Huraian Tindakan/Intevensi<span class="text-danger">&#42;</span></label>
                                    <div class="col-sm-9">
                                           <textarea name="huraianintevensi" class="form-control" rows="4"></textarea> 
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

