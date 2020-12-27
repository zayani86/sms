<?php defined('BASEPATH') or exit('No direct script access allowed');  ?>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Waktu dan Masa Aktiviti</h5>
            </div>
            <div class="card-block2">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Kategori Sesi<span style="color:red">*</span></label>
                    <div class="col-sm-3">
                        <?php if($mode == 'add'){ ?>
                            <select name="kategori" id="kategori_id" class="form-control" >
                                <?= generate_option_konf_kod_by_kategory('SESI', set_value('kategori_id', isset($aktiviti->kategori) ? $aktiviti->kategori : "")); ?>
                            </select>
                        <?php } else { ?>
                            <input type="hidden" name="aktiviti_id" id="aktiviti_id" value="<?= $aktiviti->id ?>" >
                            <input type="hidden" name="mode" id="mode_id" value="<?= $mode ?>" >
                            <input type="hidden" name="kategori_id" id="kategori_id" value="<?= $aktiviti->kategori_sesi ?>" >
                            <input type="hidden" name="program_id" id="program_id" value="<?= $aktiviti->jenis_program_id ?>" >
                            <input type="hidden" name="sasaran_id" id="sasaran_id" value="<?= $aktiviti->sasaran_id ?>" >
                            <input type="hidden" name="kelas_id" id="kelas_id" value="<?= $aktiviti->kelas ?>" >
                            <input type="hidden" name="klien_id" id="klien_id" value="<?= $aktiviti->kategori_klien ?>" >
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
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5>Maklumat Aktiviti</h5>
            </div>
            <div class="card-block2">
                <div class="form-group row is_hide_7002">
                    <label class="col-sm-3 col-form-label">Jenis Sesi <?= $aktiviti->jenis_sesi ?></label>
                    <div class="col-sm-6">
                        <input type="hidden" name="jenis_sesi_oth" value="<?= $aktiviti->jenis_sesi ?>" id="jenis_sesi_oth">
                        <select name="jenis_sesi" id="jenis_sesi_id" class="form-control jenis_sesi" >
                            <option value="">-- Sila Pilih --</option>
                            <?= generate_option_konf_kod_by_kategory('INDIVIDU', set_value('jenis_sesi', isset($aktiviti->jenis_sesi) ? $aktiviti->jenis_sesi : "")); ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row is_hide_7001 is_hide_7002 is_hide_7004">
                    <label class="col-sm-3 col-form-label">Sasaran</label>
                    <div class="col-sm-6">
                        <select name="sasaran_id" id="sasaran_id" class="form-control sasaran" >
                            <option value="">-- Sila Pilih --</option>
                            <?= generate_option_konf_kod_by_kategory('SASARAN', set_value('sasaran_id', isset($aktiviti->sasaran_id) ? $aktiviti->sasaran_id : "")); ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row is_hide_7001 is_hide_7002 is_hide_7003 is_hide_7004" style="display:none">
                    <label class="col-sm-3 col-form-label">Klasifikasi Kelas Ganti</label>
                    <div class="col-sm-6">
                        <select name="klasifikasi_kg_id" id="klasifikasi_kg_id" class="form-control" >
                            <option value="">-- Sila Pilih --</option>
                            <?= generate_option_konf_kod_by_kategory('KLASIFIKASI_KG', set_value('klasifikasi_kg_id', isset($aktiviti->klasifikasi_kg_id) ? $aktiviti->klasifikasi_kg_id : "")); ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row is_hide_7001 is_hide_7002 is_hide_7003 is_hide_7004" style="display:none">
                    <label class="col-sm-3 col-form-label">Tingkatan / Tahun</label>
                    <div class="col-sm-6">
                        <select name="nama_tingkatan" id="nama_tingkatan" class="form-control" >
                            <option value="">-- Sila Pilih --</option>
                            <?= generate_tingkatan_tahun(set_value('nama_tingkatan', isset($aktiviti->nama_tingkatan) ? $aktiviti->nama_tingkatan : ""), $this->session->konf_sekolah) ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row is_hide_7001 is_hide_7002 is_hide_7003 is_hide_7004" style="display:none">
                    <label class="col-sm-3 col-form-label">Kelas</label>
                    <div class="col-sm-6">
                        <select name="kelas" id="kelas" class="form-control kelas_class" >
                            <option value="">-- Sila Pilih --</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row is_hide_7001 is_hide_7002 is_hide_7003 is_hide_7004" style="display:none">
                    <label class="col-sm-3 col-form-label">Bilangan Waktu</label>
                    <div class="col-sm-6">
                        <select name="bil_waktu" id="bil_waktu" class="form-control" >
                            <option value="">-- Sila Pilih --</option>
                            <?= generate_bil_waktu($aktiviti->bil_waktu) ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row is_hide_7001 is_hide_7002 is_hide_7003 is_hide_7005" style="display:none">
                    <label class="col-sm-3 col-form-label">Kategori Klien</label>
                    <div class="col-sm-6">
                        <select name="klien" id="klien" class="form-control klien" >
                            <option value="">-- Sila Pilih --</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row is_hide_7001 is_hide_7002 is_hide_7003 is_hide_7007 " style="display:none">
                    <label class="col-sm-3 col-form-label">Kategori Ziarah Cakna</label>
                    <div class="col-sm-6">
                        <select name="kategori_ziarah_cakna" id="kategori_ziarah_cakna" class="form-control" >
                            <option value="">-- Sila Pilih --</option>
                            <?= generate_option_konf_kod_by_kategory('KATEGORI_CAKNA', set_value('kategori_ziarah_cakna', isset($aktiviti->kategori_cakna) ? $aktiviti->kategori_cakna : "")); ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row is_hide_7001 is_hide_7002 is_hide_7003 is_hide_7007 " style="display:none">
                    <label class="col-sm-3 col-form-label">Impak Ziarah Cakna</label>
                    <div class="col-sm-6">
                        <select name="impak_ziarah_cakna" id="impak_ziarah_cakna" class="form-control" >
                            <option value="">-- Sila Pilih --</option>
                            <?= generate_option_konf_kod_by_kategory('IMPAK_CAKNA', set_value('impak_ziarah_cakna', isset($aktiviti->impak_cakna) ? $aktiviti->impak_cakna : "")); ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row is_hide_7001 is_hide_7002 is_hide_7003" style="display:none">
                    <label class="col-sm-3 col-form-label">Jenis Program</label>
                    <div class="col-sm-6">
                        <select name="jenis_program_id" id="jenis_program_id" class="form-control program" >
                            <option value="">-- Sila Pilih --</option>
                            <?= generate_option_konf_kod_by_kategory('PROGRAM', set_value('jenis_program_id', isset($aktiviti->jenis_program_id) ? $aktiviti->jenis_program_id : "")); ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row lain_lain_program_class" style="display:none">
                    <label class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-6">
                        <input type="text" name="lain_lain_program" value="" class="form-control" placeholder="nyatakan nama program lain - lain">
                    </div>
                </div>
                <div class="form-group row is_hide_7001 is_hide_7002 is_hide_7003" style="display:none">
                    <label class="col-sm-3 col-form-label">Tajuk Program</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="tajuk_program" value="<?= set_value('jenis_perkhidmatan_id', isset($aktiviti->tajuk_program) ? $aktiviti->tajuk_program : "") ?>">
                    </div>
                </div>
                <div class="form-group row is_hide_7006">
                    <label class="col-sm-3 col-form-label">Pendekatan</label>
                    <div class="col-sm-6">
                        <select name="pendekatan_id" id="pendekatan_id" class="form-control pendekatan" >
                            <option value="">-- Sila Pilih --</option>
                            <?= generate_option_konf_kod_by_kategory('PENDEKATAN', set_value('pendekatan_id', isset($aktiviti->pendekatan_id) ? $aktiviti->pendekatan_id : "")); ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row is_hide_7006">
                    <label class="col-sm-3 col-form-label">Jenis Perkhidmatan</label>
                    <div class="col-sm-6">
                        <select name="jenis_perkhidmatan_id" id="jenis_perkhidmatan_id" class="form-control" >
                            <option value="">-- Sila Pilih --</option>
                            <?= generate_option_konf_kod_by_kategory('PERKHIDMATAN', set_value('jenis_perkhidmatan_id', isset($aktiviti->jenis_perkhidmatan_id) ? $aktiviti->jenis_perkhidmatan_id : "")); ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row is_hide_7006">
                    <label class="col-sm-3 col-form-label">Fokus</label>
                    <div class="col-sm-6">
                        <select name="fokus_id" id="fokus_id" class="form-control focus" >
                            <option value="">-- Sila Pilih Jenis Perkhidmatan --</option>
                            <?= generate_option_konf_kod_by_kategory('FOKUS', set_value('fokus_id', isset($aktiviti->fokus_id) ? $aktiviti->fokus_id : "")); ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row sub_focus" style="display:none">
                    <label class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-6">
                        <select name="sub_fokus_id" id="sub_fokus_id" class="form-control focus_sub" >
                            <option value="">-- Sila Pilih --</option>
                            <?= generate_option_konf_kod_by_kategory('FOKUS_SUB', set_value('sub_fokus_id', isset($aktiviti->fokus_sub_id) ? $aktiviti->fokus_sub_id : "")); ?>
                        </select>
                    </div>
                </div>
                
            </div>
        </div>

    </div>
</div>

</form>

