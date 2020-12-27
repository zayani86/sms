<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

if (!function_exists('generate_gridlookup_ptj')) {
    function generate_gridlookup_ptj($id = "", $error = "")
    {
        $_ci = get_instance();

        $has_error = (empty($error) ? "" : "is-invalid");
        // TODO: delete the bulleted red to make it not used as to view ptj from db
        $htmlstring = '<div class="input-group input-group-button">
                <input type="text" class="form-control ' . $has_error . '" id="ptj_display" name="ptj_display" disabled=""
                value="">
                <span class="input-group-addon btn btn-primary jabatan" id="basic-addon10">
                    <span class=""><i class="icofont icofont-search"></i>Cari</span>
                </span>
            </div>
            
            <div class="modal fade" id="Modal_murid" tabindex="-1" role="dialog" aria-labelledby="JabatanModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="JabatanModalLabel">Senarai Murid</h5>
                            <button type="button" class="close" aria-label="Close" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="col-lg-12">
                                <div class="alert alert-info icons-alert text-inverse">
                                        <p>Klik pada no. pengenalan untuk pilih.</p>
                                    </div> 
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Tingkatan / Tahun</label>
                                    <div class="col-sm-9">
                                            <select id="tingkatan_grid_id" name="tingkatan_grid_id" class="form-control">
                                                <option value="">--Sila Pilih--</option>
                                                ' . generate_tingkatan_tahun(set_value('nama_tingkatan', isset($aktiviti->tingkatan_grid_id) ? $aktiviti->tingkatan_grid_id : ""), get_session('konf_sekolah')) .  '
                                            </select>
                                        </div>
                                </div>
                                        <hr>
                                        <div class="text-right">
                                            <button type="button" 
                                                class="btn btn-primary btn_tambah_murid"><i
                                                    class="icofont icofont-document-search"></i>Tambah</button>
                                        </div>
                                        <hr>
                                        <div class="dt-responsive table-responsive">
                                            <table id="list_murid" class="table compact dt-responsive table-striped table-bordered table-hover" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Kelas</th>
                                                        <th>Nama Murid / No Pengenalan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr><td colspan="3">Sila Pilih Tingkatan / Tahun</td></tr>
                                                </tbody>
                                            </table>
                                        </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div>';

        $javascriptstring = '
            <script type="text/javascript">
            "use strict";

            $(document).ready(function() {
                $("#tingkatan_grid_id").on("change", function(){
                    let value_tingkatan = $(this).val();

                    $.ajax({
                        data: {kategori: value_tingkatan},
                        type: "GET",
                        url: "'. base_url("aktiviti/aktiviti_kaunseling/aktiviti_controller/get_kelas_nama_tingkatan") . url_akses() .'",
                        dataType: "JSON",
                        success: function (data) {

                            let tbl_murid = $("#list_murid");
                            let num = 0;
                            let count = 1;

                            tbl_murid.empty();
                            
                            tbl_murid.append("<table id=\'list_murid\' class=\'table compact dt-responsive table-striped table-bordered table-hover\' width=\'100%\'>");
                            tbl_murid.append("<thead><tr><th>No</th><th>Kelas</th><th>Nama Murid / No Pengenalan &nbsp;<input type=\'checkbox\' class=\'checkAll\' value=\'\'>Pilih Semua</th></tr></thead>");
                            tbl_murid.append("<tbody>");

                            $.each(data.id, function () {
                                let keterangan = data.nama_kelas[num];
                                let kelas_id = data.id[num];

                                $.ajax({
                                    data: {kelas_id: kelas_id},
                                    type: "GET",
                                    url: "'. base_url("aktiviti/aktiviti_kaunseling/aktiviti_controller/ajax_get_murid") . url_akses() .'",
                                    dataType: "JSON",
                                    success: function (murid) {
                                        let string_murid = "";
                                        for(var key in murid){
                                            string_murid += "<div class=\'border-checkbox-group border-checkbox-group-primary\'><input type=\'checkbox\' id=\'murid_inp_id_" + murid[key].id + "\' class=\'murid_checkbox_class border-checkbox\' name=\'murid_id["+ murid[key].id + "]\' value=\'"+murid[key].id+" \' > &nbsp;<label class=\'border-checkbox-label\' for=\'murid_inp_id_" + murid[key].id + "\'>"+ murid[key].nama + " | <b>"+ murid[key].no_kp_baru +" <input type=\'hidden\' id=\'nama_murid_id_"+ murid[key].id +"\' name=\'nama_murid["+ murid[key].id +"]\' value=\'"+ murid[key].nama + "\' > <input type=\'hidden\' id=\'no_kp_murid_"+ murid[key].id +"\' name=\'no_kp_murid_["+ murid[key].id +"]\' value=\'"+ murid[key].no_kp_baru + "\' > <input type=\'hidden\' id=\'kelas_id_grid_"+ murid[key].id +"\' name=\'kelas_id_grid_["+ murid[key].id +"]\' value=\'"+ kelas_id+ "\' ></label></b><br></div>";
                                        }

                                        $("#test_id_" + kelas_id).html(string_murid);

                                    }
                                });
                              
                                tbl_murid.append("<tr><td> "+ count +" </td><td> " + keterangan + "</td><td><span id=\'test_id_" + kelas_id + "\' ></span> </td></tr>");
                                
                                num++;
                                count++;
                            });
                            
                            tbl_murid.append("</tbody></table>");

                        }
                    });
                });

                $(".jabatan").click(function () {
                    $("#Modal_murid").modal("show");
                });  
            
                var jabatan_dt = $("#list_jabatan").DataTable({ 
                    "processing": true,
                    "serverSide": false, 
                    "order": [],
                    "ajax": {
                        "url": "' . base_url('aktiviti/aktiviti_kaunseling/aktiviti_controllerdt_senarai_murid/dt_senarai_jabatan') . url_akses() . '",
                        "type": "GET",
                    },
                    language: {"url": "' . assets_url() . 'js/data-tables.ms_my.js"},
                    fixedcolumns:true,
                    createdRow: function(row, data, dataIndex){
                        $(row).addClass("ptj_row");
                        $(row).data("id", data[4]);
                        $(row).data("display_name", data[2]);
                        $(row).css( "cursor", "pointer" );
                    },
                });
            
                $(document).on("click", ".btn_tambah_murid", function(){
                    
                    let peranan_input = "";
                    let jumlah_murid = 1;

                    var rowCount = $(\'#list_table_murid > tbody > tr\').length + 1;
                    var htmlnewrow = "";

                    $(".murid_checkbox_class:checkbox:checked").each(function(i) {

                        let nama_murid = $("#nama_murid_id_"+$(this).val()).val();
                        let no_kp_murid = $("#no_kp_murid_"+$(this).val()).val();
                        
                        htmlnewrow += "<tr>" +
                        "<td class=\'text-center\'> "+ rowCount + "</td>" +
                        "<td class=\'text-left\'> "+ nama_murid + " | "+ no_kp_murid + "</td>" +
                        "<td class=\'text-center\'><a href=\'javascript:void(0)\' id=\'deleteBtn\' class=\' removeperanan\' alt=\'hapus\' data-id=\'" + peranan_input + "\'><i class=\'text-danger ti-trash\' style=\'font-size: 20px;\'></i></a></td>" +
                        "</tr>";

                        rowCount++;
                    });

                    

                    if (htmlnewrow) {
                        $(\'#list_table_murid tbody\').append(htmlnewrow);
                    }

                    $("#Modal_murid").modal("hide");
                });
            
                jabatan_dt.on( "order.dt search.dt", function () {
                    jabatan_dt.column(0, {search:"applied", order:"applied"}).nodes().each( function (cell, i) {
                        cell.innerHTML = i+1;
                    } );
                } ).draw();

                $(".btn_reset_searchform_ptj").click(function(){ 
                    $("#kod_jabatan_modal").val("");
                    $("#nama_jabatan_modal").val("");
                    jabatan_dt.columns().search( "" ).draw();
                });

                $(document).on("click", ".btn_filter_searchform_ptj", function(){
                    if ($("#kod_jabatan_modal").val()) jabatan_dt.columns(1).search( $("#kod_jabatan_modal").val() ).draw();
                    if ($("#nama_jabatan_modal").val()) jabatan_dt.columns(2).search( $("#nama_jabatan_modal").val() ).draw();
                });

                $(document).on("click", ".checkAll", function() {
                    $(".murid_checkbox_class").not(this).prop("checked", this.checked);
                });

                $(document).on(\'click\', \'a.removeperanan\', function() {
                    let ptj_id = $(this).data("id");
        
                    swal({
                        html: "Anda pasti untuk hapuskan rekod ini?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Ya",
                        cancelButtonText: "Tidak",
                        allowOutsideClick: false
                    }).then((result) => {
                        if (result.value) {
                            $(this).closest(\'tr\').remove();
                            $(".btn_popup_tambah_peranan").show();
        
                            $("#list_table_murid tbody tr").each(function(i) {
                                $($(this).find(\'td\')[0]).html(i + 1);
                            });
        
                            if ($("#list_table_murid tbody tr").length == 0) {
                                $("#list_table_murid tbody").append("<tr id=\'list_table_peranan_empty\'><td colspan=\'3\' class=\'text-center\'>Tiada Rekod.</td></tr>");
                            }
                            return false;
                        }
                    })
        
                });

            });
            </script>
            ';

        return $htmlstring . $javascriptstring;
    }
}

