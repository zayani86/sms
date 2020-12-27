<?php defined('BASEPATH') or exit('No direct script access allowed');  ?>

<?php echo form_open_multipart(site_url($actionform) . url_akses(), array('method' => 'post', 'name' => 'add', 'id' => 'form_entry')); ?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Waktu dan Masa Aktiviti</h5>
            </div>
            <div class="card-block2">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Kategori<span style="color:red">*</span></label>
                    <div class="col-sm-3">
                        <?php if($mode == 'add'){ ?>
                            <select name="kategori" id="kategori_id" class="form-control" >
                                <?= generate_option_konf_kod_by_kategory('KATEGORI_PENTADBIRAN', set_value('kategori_id', isset($aktiviti->kategori) ? $aktiviti->kategori : "")); ?>
                            </select>
                        <?php } else { ?>
                            <label class="col-form-label"><?php echo strtoupper($aktiviti->keterangan) ?></label>
                        <?php } ?>
                    </div>
                    <label class="col-sm-3 col-form-label">Tarikh </label>
                    <div class="col-sm-3">
                            <input type="date" name="tarikh_aktiviti" id="tarikh_aktiviti" value="<?= set_value('tarikh_aktiviti', isset($aktiviti->tarikh_mula) ? $aktiviti->tarikh_mula : date('Y-m-d')) ?>" class="form-control" >
                    </div>
                    
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Waktu Mula <span style="color:red">*</span></label>
                    <div class="col-sm-3">

                        <input type="time" id="waktu_mula_id" name="waktu_mula" value="<?= set_value('waktu_mula', isset($aktiviti->waktu_mula) ? date('H:i', strtotime($aktiviti->waktu_mula)) : "" ) ?>" class="form-control" >
                    </div>
                    <label class="col-sm-3 col-form-label">Waktu Tamat <span style="color:red">*</span></label>
                    <div class="col-sm-3">
                        <input type="time" id="waktu_tamat_id" name="waktu_tamat" value="<?= set_value('waktu_mula', isset($aktiviti->waktu_tamat) ? date('H:i', strtotime($aktiviti->waktu_tamat)) : "" ) ?>" class="form-control" >
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Perkara / Tajuk</label>
                    <div class="col-sm-9">
                        <textarea id="perkara" name="perkara" type="text" class="form-control" rows="4"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-block2">
                <div>
                    <div class="pull-right">
                        <a class="btn btn-inverse" href="<?php echo base_url('aktiviti/pentadbiran/pentadbiran_controller') . url_akses() ?>"><i class="icofont icofont-arrow-left"></i><?= gettext("Kembali") ?></a>
                        <button type="submit" id="btn_form_simpan" class="btn btn-primary"><i class="icofont icofont-save"></i><?= gettext('Simpan') ?></button>
                    </div>
                </div>
            </div>
        </div>
        

    </div>
</div>

</form>

