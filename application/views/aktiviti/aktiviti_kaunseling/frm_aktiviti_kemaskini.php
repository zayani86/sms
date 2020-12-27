<?php defined('BASEPATH') or exit('No direct script access allowed');  ?>

<?php echo form_open_multipart(site_url($actionform) . url_akses(), array('method' => 'post', 'name' => 'add', 'id' => 'form_entry')); ?>
<div class="row">
    <div class="col-sm-12">
        <div class="tab-header card waves-effect waves-light">
            <ul class="nav nav-tabs md-tabs tab-timeline" role="tablist" id="mytab">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#maklumat_utama" role="tab">Maklumat Aktiviti</a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item hideShow"> 
                    <a class="nav-link" data-toggle="tab" href="#maklumat_secondary" role="tab">Keterangan Aktiviti</a>
                    <div class="slide"></div>
                </li>
            </ul>
        </div>
        <div class="tab-content">
            <div class="tab-pane active" id="maklumat_utama" role="tabpanel">
                <?php $this->view('aktiviti/aktiviti_kaunseling/frm_aktiviti_kemaskini_main'); ?>
            </div>
            <div class="tab-pane" id="maklumat_secondary" role="tabpanel">
                <?php $this->view('aktiviti/aktiviti_kaunseling/frm_aktiviti_details_kemaskini_secondary'); ?>
            </div>
        </div>
        <div class="card">
            <div class="card-block2">
                <div>
                    <div class="pull-right">
                        <a class="btn btn-inverse" href="<?php echo base_url('aktiviti/aktiviti_kaunseling/aktiviti_controller') . url_akses() ?>"><i class="icofont icofont-arrow-left"></i><?= gettext("Kembali") ?></a>
                        <button type="submit" id="btn_form_simpan" class="btn btn-primary"><i class="icofont icofont-save"></i><?= gettext('Kemaskini') ?></button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

</form>

