<?php defined('BASEPATH') or exit('No direct script access allowed');  ?>


<div class="row">
    <div class="col-sm-12">
        
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
                                    <input type="text" name="nama_klien" id="nama_klien" class="form-control" value="<?= $aktiviti_details->nama_klien ?>" >
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
                                        <?= generate_guru_terlibat($aktiviti_details->m) ?>
                                    </select>
                                </div>
                                <div class="col-sm-1">
                                    <select name="c" id="c" class="form-control" >
                                        <?= generate_guru_terlibat($aktiviti_details->c) ?>
                                    </select>
                                </div>
                                <div class="col-sm-1">
                                    <select name="i" id="i" class="form-control" >
                                        <?= generate_guru_terlibat($aktiviti_details->i) ?>
                                    </select>
                                </div>
                                <div class="col-sm-1">
                                    <select name="sb" id="sb" class="form-control" >
                                        <?= generate_guru_terlibat($aktiviti_details->sb) ?>
                                    </select>
                                </div>
                                <div class="col-sm-1">
                                    <select name="sw" id="sw" class="form-control" >
                                        <?= generate_guru_terlibat($aktiviti_details->sw) ?>
                                    </select>
                                </div>
                                <div class="col-sm-1">
                                    <select name="ll" id="ll" class="form-control" >
                                        <?= generate_guru_terlibat($aktiviti_details->ll) ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">&nbsp;</label>
                                <label class="col-sm-1 col-form-label">P</label>
                                <div class="col-sm-1">
                                    <select name="pm" id="pm" class="form-control" >
                                        <?= generate_guru_terlibat($aktiviti_details->pm) ?>
                                    </select>
                                </div>
                                <div class="col-sm-1">
                                    <select name="pc" id="pc" class="form-control" >
                                        <?= generate_guru_terlibat($aktiviti_details->pc) ?>
                                    </select>
                                </div>
                                <div class="col-sm-1">
                                    <select name="pi" id="pi" class="form-control" >
                                        <?= generate_guru_terlibat($aktiviti_details->pi) ?>
                                    </select>
                                </div>
                                <div class="col-sm-1">
                                    <select name="psb" id="psb" class="form-control" >
                                        <?= generate_guru_terlibat($aktiviti_details->psb) ?>
                                    </select>
                                </div>
                                <div class="col-sm-1">
                                    <select name="psw" id="psw" class="form-control" >
                                        <?= generate_guru_terlibat($aktiviti_details->psw) ?>
                                    </select>
                                </div>
                                <div class="col-sm-1">
                                    <select name="pll" id="pll" class="form-control" >
                                        <?= generate_guru_terlibat($aktiviti_details->pll) ?>
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
                                    <input type="text" name="nama_penjaga" id="nama_penjaga" class="form-control" value="<?= $aktiviti_details->nama_penjaga ?>" >
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
                                <textarea id="perkara" name="perkara" type="text" class="form-control" rows="4"><?= $aktiviti_details->perkara ?></textarea>
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
                                <textarea id="persoalan" name="persoalan" type="text" class="form-control" rows="4"><?= $aktiviti_details->persoalan ?></textarea>
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
                                <textarea id="rumusan_program" name="rumusan_program" type="text" class="form-control" rows="4"><?= $aktiviti_details->rumusan_program ?></textarea>
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
                                <textarea id="objektif_program" name="objektif_program" type="text" class="form-control" rows="4"><?= $aktiviti_details->objektif_program ?></textarea>
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
                                <textarea id="sasaran_program" name="sasaran_program" type="text" class="form-control" rows="4"><?= $aktiviti_details->sasaran_program ?></textarea>
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
                                <textarea id="kelebihan_program" name="kelebihan_program" type="text" class="form-control" rows="4"><?= $aktiviti_details->kelebihan_program ?></textarea>
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
                                <textarea id="kelemahan_program" name="kelemahan_program" type="text" class="form-control" rows="4"><?= $aktiviti_details->kelemahan_program ?></textarea>
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
                                <textarea id="penambahbaikan_program" name="penambahbaikan_program" type="text" class="form-control" rows="4"><?= $aktiviti_details->penambahbaikan_program ?></textarea>
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
                                <textarea id="tindakan_cakna" name="tindakan_cakna" type="text" class="form-control" rows="4"><?= $aktiviti_details->tindakan_cakna ?></textarea>
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
                                <textarea id="keterangan_tindakan_intervensi" name="keterangan_tindakan_intervensi" type="text" class="form-control" rows="4"><?= $aktiviti_details->keterangan_tindakan_intervensi ?></textarea>
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
                                    <input class="border-checkbox" type="checkbox" id="berfokus_id" name="focus" <?php echo $aktiviti_details->focus ? 'checked' : '' ?> >
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
                                    <input class="border-checkbox" type="checkbox" id="risiko_cicir" name="risiko_cicir" <?php echo $aktiviti_details->risiko_cicir ? 'checked' : '' ?> >
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
                                        <?php if(!empty($senarai_murid)) { ?>
                                            <?php $count = 1; ?>
                                            <?php foreach($senarai_murid as $key => $value) {  ?>
                                                <tr>
                                                    <td class="text-center"><?= $count; ?></td>
                                                    <td><?= $value->nama; ?> | <?= $value->no_kp_baru; ?></td>
                                                    <td class="text-center">
                                                    <a href='javascript:void(0)' id='deleteBtn' class='removemurid' alt='hapus' data-id='<?= $value->id ?>'><i class='text-danger ti-trash' style='font-size: 20px;'></i></a>
                                                    </td>
                                                </tr>
                                            <?php $count++; } ?>
                                        <?php } else { ?>
                                            <tr><td colspan="3">Tiada Rekod</td></tr>
                                        <?php } ?>
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
                    
                </div>
            </div>
        </div>
    </div>
</div>

