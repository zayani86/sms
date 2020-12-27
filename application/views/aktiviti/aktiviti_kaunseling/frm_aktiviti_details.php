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
                    <label class="col-sm-3 col-form-label">Kategori Sesi :</label>
                    <label class="col-sm-3 text-muted col-form-label"><?php echo strtoupper($aktiviti->keterangan) ?></label>
                    <label class="col-sm-3 col-form-label">Tarikh :</label>
                    <label class="col-sm-3 text-muted col-form-label"><?php echo date('d/m/Y', strtotime($aktiviti->tarikh_mula)) ?></label>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Waktu Mula :</label>
                    <label class="col-sm-3 text-muted col-form-label"><?php echo date('h:i a', strtotime($aktiviti->waktu_mula)) ?></label>
                    <label class="col-sm-3 col-form-label">Waktu Tamat :</label>
                    <label class="col-sm-3 text-muted col-form-label"><?php echo date('h:i a', strtotime($aktiviti->waktu_tamat)) ?></label>
                </div>
                <div class="alert alert-info icons-alert text-inverse">
                    <p><?= gettext("Maklumat Aktiviti") ?></p>
                </div>
                <div class="row col-md-10 pull-right">
                    <?php if(!empty($aktiviti->js_desc)) { ?>
                        <label class="col-sm-3 col-form-label">Jenis Sesi :</label>
                        <label class="col-sm-9 text-muted col-form-label"><?= $aktiviti->js_desc ?></label>
                    <?php } ?>
                    <?php if(!empty($aktiviti->s_desc)) { ?>
                        <label class="col-sm-3 col-form-label">Sasaran :</label>
                        <label class="col-sm-9 text-muted col-form-label"><?= $aktiviti->s_desc ?></label>
                    <?php } ?>
                    <?php if(!empty($aktiviti->klasifikasi_desc)) { ?>
                        <label class="col-sm-3 col-form-label">Klasifikasi Kelas Ganti :</label>
                        <label class="col-sm-9 text-muted col-form-label"><?= $aktiviti->klasifikasi_desc ?></label>
                    <?php } ?>
                    <?php if(!empty($aktiviti->nama_tingkatan)) { ?>
                        <label class="col-sm-3 col-form-label">Tingkatan / Tahun :</label>
                        <label class="col-sm-9 text-muted col-form-label"><?= $aktiviti->nama_tingkatan ?></label>
                    <?php } ?>
                    <?php if(!empty($aktiviti->kelas_desc)) { ?>
                        <label class="col-sm-3 col-form-label">Kelas :</label>
                        <label class="col-sm-9 text-muted col-form-label"><?= $aktiviti->kelas_desc ?></label>
                    <?php } ?>
                    <?php if(!empty($aktiviti->bil_waktu)) { ?>
                        <label class="col-sm-3 col-form-label">Bilangan Waktu :</label>
                        <label class="col-sm-9 text-muted col-form-label"><?= $aktiviti->bil_waktu ?></label>
                    <?php } ?>
                    <?php if(!empty($aktiviti->kategori_k_desc)) { ?>
                        <label class="col-sm-3 col-form-label">Kategori Klien :</label>
                        <label class="col-sm-9 text-muted col-form-label"><?= $aktiviti->kategori_k_desc ?></label>
                    <?php } ?>
                    <?php if(!empty($aktiviti->program_j_desc)) { ?>
                        <label class="col-sm-3 col-form-label">Jenis Program :</label>
                        <label class="col-sm-9 text-muted col-form-label"><?= $aktiviti->program_j_desc ?></label>
                    <?php } ?>
                    <?php if(!empty($aktiviti->tajuk_program)) { ?>
                        <label class="col-sm-3 col-form-label">Tajuk Program :</label>
                        <label class="col-sm-9 text-muted col-form-label"><?= $aktiviti->tajuk_program ?></label>
                    <?php } ?>
                    <?php if(!empty($aktiviti->kat_cakna_desc)) { ?>
                        <label class="col-sm-3 col-form-label">Kategori Ziarah Cakna :</label>
                        <label class="col-sm-9 text-muted col-form-label"><?= $aktiviti->kat_cakna_desc ?></label>
                    <?php } ?>
                    <?php if(!empty($aktiviti->impak_cakna_desc)) { ?>
                        <label class="col-sm-3 col-form-label">Impak Ziarah Cakna :</label>
                        <label class="col-sm-9 text-muted col-form-label"><?= $aktiviti->impak_cakna_desc ?></label>
                    <?php } ?>
                    <?php if(!empty($aktiviti->p_desc)) { ?>
                        <label class="col-sm-3 col-form-label">Pendekatan :</label>
                        <label class="col-sm-9 text-muted col-form-label"><?= $aktiviti->p_desc ?></label>
                    <?php } ?>
                    <?php if(!empty($aktiviti->perkhid_desc)) { ?>
                        <label class="col-sm-3 col-form-label">Jenis Perkhidmatan :</label>
                        <label class="col-sm-9 text-muted col-form-label"><?= $aktiviti->perkhid_desc ?></label>
                    <?php } ?>
                    <?php if(!empty($aktiviti->fokus_desc)) { ?>
                        <label class="col-sm-3 col-form-label">Fokus :</label>
                        <label class="col-sm-9 text-muted col-form-label"><?= $aktiviti->fokus_desc ?></label>
                    <?php } ?>
                    <?php if(!empty($aktiviti->sub_fokus_desc)) { ?>
                        <label class="col-sm-3 col-form-label">Fokus :</label>
                        <label class="col-sm-9 text-muted col-form-label"><?= $aktiviti->sub_fokus_desc ?></label>
                    <?php } ?>
                </div>      
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5>Keterangan Aktiviti</h5>
            </div>
            <div class="card-block2">
                <?php if($aktiviti->kategori_sesi == 7004 ) { ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nama Klien </label>
                                <div class="col-sm-6">
                                    <input type="text" name="nama_klien" id="nama_klien" class="form-control" >
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <?php if($aktiviti->kategori_sesi == 7005 ) { ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Guru Terlibat</label>
                                <label class="col-sm-1 col-form-label">M</label>
                                <div class="col-sm-1">
                                    <select name="m" id="m" class="form-control" >
                                        <?= generate_guru_terlibat() ?>
                                    </select>
                                </div>
                                <div class="col-sm-1">
                                    <select name="c" id="c" class="form-control" >
                                        <?= generate_guru_terlibat() ?>
                                    </select>
                                </div>
                                <div class="col-sm-1">
                                    <select name="i" id="i" class="form-control" >
                                        <?= generate_guru_terlibat() ?>
                                    </select>
                                </div>
                                <div class="col-sm-1">
                                    <select name="sb" id="sb" class="form-control" >
                                        <?= generate_guru_terlibat() ?>
                                    </select>
                                </div>
                                <div class="col-sm-1">
                                    <select name="sw" id="sw" class="form-control" >
                                        <?= generate_guru_terlibat() ?>
                                    </select>
                                </div>
                                <div class="col-sm-1">
                                    <select name="ll" id="ll" class="form-control" >
                                        <?= generate_guru_terlibat() ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">&nbsp;</label>
                                <label class="col-sm-1 col-form-label">P</label>
                                <div class="col-sm-1">
                                    <select name="pm" id="pm" class="form-control" >
                                        <?= generate_guru_terlibat() ?>
                                    </select>
                                </div>
                                <div class="col-sm-1">
                                    <select name="pc" id="pc" class="form-control" >
                                        <?= generate_guru_terlibat() ?>
                                    </select>
                                </div>
                                <div class="col-sm-1">
                                    <select name="pi" id="pi" class="form-control" >
                                        <?= generate_guru_terlibat() ?>
                                    </select>
                                </div>
                                <div class="col-sm-1">
                                    <select name="psb" id="psb" class="form-control" >
                                        <?= generate_guru_terlibat() ?>
                                    </select>
                                </div>
                                <div class="col-sm-1">
                                    <select name="psw" id="psw" class="form-control" >
                                        <?= generate_guru_terlibat() ?>
                                    </select>
                                </div>
                                <div class="col-sm-1">
                                    <select name="pll" id="pll" class="form-control" >
                                        <?= generate_guru_terlibat() ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <?php if($aktiviti->kategori_sesi == 7005 ) { ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nama Penjaga Murid </label>
                                <div class="col-sm-6">
                                    <input type="text" name="nama_penjaga" id="nama_penjaga" class="form-control" >
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <?php if($aktiviti->kategori_sesi == 7000 || $aktiviti->kategori_sesi == 7001 || $aktiviti->kategori_sesi == 7004 || $aktiviti->kategori_sesi == 7005 ) { ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Perkara</label>
                            <div class="col-sm-6">
                                <textarea id="perkara" name="perkara" type="text" class="form-control" rows="4"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <?php if($aktiviti->kategori_sesi == 7000 || $aktiviti->kategori_sesi == 7001 || $aktiviti->kategori_sesi == 7004 || $aktiviti->kategori_sesi == 7005) { ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Persoalan</label>
                            <div class="col-sm-6">
                                <textarea id="persoalan" name="persoalan" type="text" class="form-control" rows="4"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>

                <?php if($aktiviti->kategori_sesi == 7002) { ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Rumusan Program</label>
                            <div class="col-sm-6">
                                <textarea id="rumusan_program" name="rumusan_program" type="text" class="form-control" rows="4"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>

                <?php if($aktiviti->kategori_sesi == 7002) { ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Objektif</label>
                            <div class="col-sm-6">
                                <textarea id="objektif_program" name="objektif_program" type="text" class="form-control" rows="4"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>

                <?php if($aktiviti->kategori_sesi == 7002) { ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Sasaran </label>
                            <div class="col-sm-6">
                                <textarea id="sasaran_program" name="sasaran_program" type="text" class="form-control" rows="4"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>

                <?php if($aktiviti->kategori_sesi == 7002) { ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kelebihan </label>
                            <div class="col-sm-6">
                                <textarea id="kelebihan_program" name="kelebihan_program" type="text" class="form-control" rows="4"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>

                <?php if($aktiviti->kategori_sesi == 7002) { ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kelemahan </label>
                            <div class="col-sm-6">
                                <textarea id="kelemahan_program" name="kelemahan_program" type="text" class="form-control" rows="4"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>

                <?php if($aktiviti->kategori_sesi == 7002) { ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Penambahbaikan </label>
                            <div class="col-sm-6">
                                <textarea id="penambahbaikan_program" name="penambahbaikan_program" type="text" class="form-control" rows="4"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>

                <?php if($aktiviti->kategori_sesi == 7005) { ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tindakan </label>
                            <div class="col-sm-6">
                                <textarea id="tindakan_cakna" name="tindakan_cakna" type="text" class="form-control" rows="4"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>

                <?php if($aktiviti->kategori_sesi == 7000 || $aktiviti->kategori_sesi == 7001 || $aktiviti->kategori_sesi == 7003 || $aktiviti->kategori_sesi == 7004 || $aktiviti->kategori_sesi == 7002 || $aktiviti->kategori_sesi == 7005 ) { ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tindakan/Intervensi</label>
                            <div class="col-sm-6">
                                <select name="tindakan_intervensi_id" id="tindakan_intervensi_id" class="form-control" >
                                    <option value="">-- Sila Pilih --</option>
                                    <?= generate_option_konf_kod_by_kategory('INTERVENSI', set_value('tindakan_intervensi_id', isset($aktiviti_details->tindakan_intervensi_id) ? $aktiviti_details->tindakan_intervensi_id : "")); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <?php if($aktiviti->kategori_sesi == 7000 || $aktiviti->kategori_sesi == 7001 || $aktiviti->kategori_sesi == 7003 || $aktiviti->kategori_sesi == 7004 || $aktiviti->kategori_sesi == 7002 || $aktiviti->kategori_sesi == 7005 ) { ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Huraian Tindakan Intervensi</label>
                            <div class="col-sm-6">
                                <textarea id="keterangan_tindakan_intervensi" name="keterangan_tindakan_intervensi" type="text" class="form-control" rows="4"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <?php if($aktiviti->kategori_sesi == 7000 || $aktiviti->kategori_sesi == 7001 || $aktiviti->kategori_sesi == 7002) { ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-6">
                                <div class="border-checkbox-group ">
                                    <input class="border-checkbox" type="checkbox" id="berfokus_id" name="focus" >
                                    <label class="border-checkbox-label" for="berfokus_id">&nbsp;Berfokus</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>

                <?php if($aktiviti->kategori_sesi == 7002) { ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-6">
                                <div class="border-checkbox-group ">
                                    <input class="border-checkbox" type="checkbox" id="risiko_cicir" name="risiko_cicir" >
                                    <label class="border-checkbox-label" for="risiko_cicir">&nbsp;Berisiko Cicir</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5>Pemilihan Murid</h5>
            </div>
            <div class="card-block2">
                <div class="p-t-20 p-b-20">
                    <h5>Pemilihan Murid Mengikut Kelas</h5>
                    <p style="font-style: italic">Sila pilih dan klik tambah untuk murid.</p>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Pusat Tanggungjawab<span class="text-danger">&#42;</span></label>
                    <div class="col-sm-5">
                        <?php echo generate_gridlookup_ptj("", empty(form_error('ptj_display')) ? "" : form_error('ptj_display')); ?>
                    </div>
                    <div class="col-sm-2">
                        
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">
                    </div>
                    <div class="col-sm-9">
                        <div class="dt-responsive table-responsive">
                            <table id="list_table_murid" class="table compact dt-responsive table-striped table-bordered table-hover" width='100%'>
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th class="w-75">Senarai Nama Murid</th>
                                        <th>Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody class="first">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">&nbsp;</label>
                    <div class="col-sm-9">
                        <input type="hidden" name="aktiviti_id" value="<?= $aktiviti->id ?>">
                        <hr />
                    </div>
                </div>
                <div>
                    <div class="pull-right">
                        <button type="submit" id="btn_form_simpan" class="btn btn-primary"><i class="icofont icofont-save"></i><?= gettext('Simpan') ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</form>

