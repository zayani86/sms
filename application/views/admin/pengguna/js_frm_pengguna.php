<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<script type="text/javascript">
    'use strict';
    color();

    $('input[type=checkbox]').click(function() {
        color();
    });

    var dNow = new Date();

    var month = dNow.getMonth() + 1;
    var day = dNow.getDate();
    var year = dNow.getFullYear();

    if (month < 10)
        month = '0' + month.toString();
    if (day < 10)
        day = '0' + day.toString();
    var minDate = year + '-' + month + '-' + day;

    $("#tarikh_tamat_id_sementara_id").attr("min", minDate);

    function checkCheckboxes( id){

		var mainCheck = $("#checkall_"+id).prop("checked");
		if(mainCheck == true){
            $("#lihat_menu_"+id). prop("checked", true);
            $("#tambah_menu_"+id). prop("checked", true);
            $("#simpan_menu_"+id). prop("checked", true);
            $("#hapus_menu_"+id). prop("checked", true);
            $("#cetak_menu_"+id). prop("checked", true);
        }else{
            $("#lihat_menu_"+id). prop("checked", false);
            $("#tambah_menu_"+id). prop("checked", false);
            $("#simpan_menu_"+id). prop("checked", false);
            $("#hapus_menu_"+id). prop("checked", false);
            $("#cetak_menu_"+id). prop("checked", false);
        }
    }

    function checkCheckboxesUpd( id,id2,id3){

        var mainCheck = $("#checkall_upd_"+id+"_"+id2+"_"+id3).prop("checked");
        if(mainCheck == true){
            $("#lihat_menu_upd_"+id+"_"+id2+"_"+id3). prop("checked", true);
            $("#tambah_menu_upd_"+id+"_"+id2+"_"+id3). prop("checked", true);
            $("#simpan_menu_upd_"+id+"_"+id2+"_"+id3). prop("checked", true);
            $("#hapus_menu_upd_"+id+"_"+id2+"_"+id3). prop("checked", true);
            $("#cetak_menu_upd_"+id+"_"+id2+"_"+id3). prop("checked", true);
        }else{
            $("#lihat_menu_upd_"+id+"_"+id2+"_"+id3). prop("checked", false);
            $("#tambah_menu_upd_"+id+"_"+id2+"_"+id3). prop("checked", false);
            $("#simpan_menu_upd_"+id+"_"+id2+"_"+id3). prop("checked", false);
            $("#hapus_menu_upd_"+id+"_"+id2+"_"+id3). prop("checked", false);
            $("#cetak_menu_upd_"+id+"_"+id2+"_"+id3). prop("checked", false);
        }
    }


    function checkCheckboxes_sementara( id){
        var mainCheck = $("#checkall_asa_"+id).prop("checked");
        if(mainCheck == true){
            $("#lihat_menu_asa_"+id). prop("checked", true);
            $("#tambah_menu_asa_"+id). prop("checked", true);
            $("#simpan_menu_asa_"+id). prop("checked", true);
            $("#hapus_menu_asa_"+id). prop("checked", true);
            $("#cetak_menu_asa_"+id). prop("checked", true);
        }else{
            $("#lihat_menu_asa_"+id). prop("checked", false);
            $("#tambah_menu_asa_"+id). prop("checked", false);
            $("#simpan_menu_asa_"+id). prop("checked", false);
            $("#hapus_menu_asa_"+id). prop("checked", false);
            $("#cetak_menu_asa_"+id). prop("checked", false);
        }
    }

    function checkCheckboxes_sementara_edit( id,id2){
        var mainCheck = $("#checkall_upd_"+id+"_"+id2).prop("checked");
        if(mainCheck == true){
            $("#lihat_menu_upd_"+id+"_"+id2). prop("checked", true);
            $("#tambah_menu_upd_"+id+"_"+id2). prop("checked", true);
            $("#simpan_menu_upd_"+id+"_"+id2). prop("checked", true);
            $("#hapus_menu_upd_"+id+"_"+id2). prop("checked", true);
            $("#cetak_menu_upd_"+id+"_"+id2). prop("checked", true);
        }else{
            $("#lihat_menu_upd_"+id+"_"+id2). prop("checked", false);
            $("#tambah_menu_upd_"+id+"_"+id2). prop("checked", false);
            $("#simpan_menu_upd_"+id+"_"+id2). prop("checked", false);
            $("#hapus_menu_upd_"+id+"_"+id2). prop("checked", false);
            $("#cetak_menu_upd_"+id+"_"+id2). prop("checked", false);
        }
    }



    $('#email').on('change', function() {
        var email = $('#email').val();
        $.ajax({
            data: {
                email: email
            },
            type: "GET",
            url: "<?= base_url('sistem/check_email') . url_akses() ?>",
            dataType: "JSON",
            success: function(data) {
                if (data != null) {
                    console.log(data.status);
                    if (data.status == 1) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Email telah wujud',
                            text: 'Email telah digunakan didalam sistem',
                        })
                        $('#email').val('');
                        $('#email').focus();
                    }

                }
            }
        });
    });

    $('#ic1').on('change', function() {
        checkIC();
    });

    $('#ic2').on('change', function() {
        checkIC();
    });

    $('#ic3').on('change', function() {
        checkIC();
    });

    function checkIC() {
        var ic1 = $('#ic1').val();
        var ic2 = $('#ic2').val();
        var ic3 = $('#ic3').val();
		var ic = ic1 + ic2 + ic3;

        $.ajax({
            data: {
                ic: ic
            },
            type: "GET",
            url: "<?= base_url('sistem/check_ic') . url_akses() ?>",
            dataType: "JSON",
            success: function(data) {
                if (data != null) {
                    console.log(data.status);
                    if (data.status == 1) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Id pengguna telah wujud',
                            text: 'Id pengguna telah digunakan didalam sistem',
                        })
                        $('#ic1').focus();
                        $('#ic1').val('')
                        $('#ic2').val('');
                        $('#ic3').val('');

                    }

                }
            }
        });
	}

    $('#btn_form_simpan_pengguna').click(function(e) {

        $("#errorTxt").empty()

        event.preventDefault();
        $('#is_draf').val('1');

        var name = $("#name").val();
        var nama_sing = $('#nama_ringkasan').val();
        var ic1 = $('#ic1').val();
        var ic2 = $('#ic2').val();
        var ic3 = $('#ic3').val();
        var email = $('#email').val();
        var jwtn_hakiki = $("input[name=jwtn_hakiki]").val();
        var ptj = $("input[name=ptj]").val();
        var nama_peranan = $("input[name=nama_peranan]").val();
        var no_pengenalan = "";
        var peranan = "";
        var ptj_insert = $("input[name=ptj_insert]").val();

        var check_array = [];
        var check_array_inserted = [];
        var check_per = '';

        $("input[name='ptj_insert[]']").each(function() {
            var value = $(this).val();
            if (value) {
                check_array.push(value);
            }
        });

        $("input[name='ptj_inserted[]']").each(function() {
            var value = $(this).val();
            if (value) {
                check_array_inserted.push(value);
            }
        });

        if (check_array.length == 0 && check_array_inserted.length == 0) {
            check_per = 1;
        }

        if (ic1 == "" || ic2 == "" || ic3 == "") {
            no_pengenalan = 1;
        }

        if (ptj != "") {
            if (nama_peranan != "") {
                peranan = 1;
            }
        }

        if (name == "" || no_pengenalan == 1 || nama_sing == "" || email == "" || jwtn_hakiki == "" || check_per == 1) {
            if (name == "") {
                $('#name').addClass("is-invalid");
                $("#errorTxt").append('<li id="errname" >Ruangan "Nama" diperlukan.</li>');
            } else {
                $("#name").removeClass("is-invalid");
                // $("#errname").remove();
            }

            if (nama_sing == "") {
                $('#nama_ringkasan').addClass("is-invalid");
                $("#errorTxt").append('<li id="errnama_ringkasan" >Ruangan "Nama Singkatan" diperlukan.</li>');

            } else {
                $("#nama_ringkasan").removeClass("is-invalid");
                // $("#errnama_ringkasan").remove();
            }

            if (no_pengenalan == 1) {
                if (ic1 == "") {
                    $('#ic1').addClass("is-invalid");
                }

                if (ic2 == "") {
                    $('#ic2').addClass("is-invalid");
                }

                if (ic3 == "") {
                    $('#ic3').addClass("is-invalid");
                }
                $("#errorTxt").append('<li id="erric" >Ruangan "ID Pengguna" diperlukan.</li>');

            } else {
                if (ic1 != "") {
                    $('#ic1').removeClass("is-invalid");
                }

                if (ic2 != "") {
                    $('#ic2').removeClass("is-invalid");
                }

                if (ic3 != "") {
                    $('#ic3').removeClass("is-invalid");
                }
                // $("#erric").remove();

            }

            if (email == "") {
                $('#email').addClass("is-invalid");
                $("#errorTxt").append('<li id="erremail" >Ruangan "Email Rasmi" diperlukan.</li>');

            } else {
                $("#email").removeClass("is-invalid");
                // $("#erremail").remove();
            }

            if (jwtn_hakiki == "") {
                $('#jwtn_hakiki_display').addClass("is-invalid");
                $("#errorTxt").append('<li id="errjwtn_hakiki_display" >Ruangan "Jawatan Hakiki" diperlukan.</li>');
            } else {
                $("#jwtn_hakiki_display").removeClass("is-invalid");
                // $("#errjwtn_hakiki_display").remove();

            }

            if (check_per == 1) {
                $("#list_table_ptj").css("background-color", "lightcoral");
                $("#errorTxt").append('<li id="errlist_table_ptj" >Sila pilih peranan.</li>');

            } else {
                $("#list_table_ptj").css("background-color", "");
                // $("#errlist_table_ptj").remove();

            }
            $("#errorTxt").show();

            $('html, body').animate({
                scrollTop: 0
            }, 'slow');
        } else {
            Swal({
                html: 'Anda pasti untuk simpan rekod ini?',
                type: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: "Tidak",
                allowOutsideClick: false
            }).then((result) => {
                if (result.value) {

                    $('#form_entry').submit();
                    $("body").append('<div class="theme-loader"> <div class="loader-track"> <div class="loader-bar"></div> </div> </div>');

                    // Swal.fire({
                    //     title: 'Sila Tunggu.',
                    //     width: 600,
                    //     padding: '3em',
                    //     background: '#fff',
                    //     showConfirmButton: false,
                    //     allowOutsideClick: false,
                    //     backdrop: `
					// 		rgba(160,160,160,0.4)
					// 		left top
					// 		no-repeat
					// 	  `
                    // })
                }
            })
        }


    });

    window.onload = function magicStick() {
        $(".btn_popup_tambah_peranan").hide();
        kemaskini_pengguna_peranan();
        kemaskini_pengguna_peranan_kem();
    }
    var reader = new FileReader();

    function readURL(input) { //use of this function: replace image selected from default?
        if (input.files && input.files[0]) {

            reader.onload = function(e) {
                $('#profile-img')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    };

    function changeID() {
        var ic1 = $('#ic1_s').val();
        var ic2 = $('#ic2_s').val();
        var ic3 = $('#ic3_s').val();

        $('#id_pengguna').text(ic1 + ic2 + ic3);
    }

    function validateNumber(evt) {
        // var key = window.event ? event.keyCode : event.which;
        // if (event.keyCode === 8) {
        //     return true;
        // } else if ( key < 48 || key > 57 ) {
        //     return false;
        // } else {
        //     return true;
        // }

        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode == 46) {
            //Check if the text already contains the . character
            if (this.value.indexOf('.') === -1) {
                return false;
            } else {
                return true;
            }
        } else {
            if (charCode > 31 &&
                (charCode < 48 || charCode > 57))
                return false;
        }
        return true;
    }
    $('#modal_jwtn_hakiki').on('show.bs.modal', function() {
        $("#nama_jawatan_query").select2();
    })
    $(document).ready(function() {

        $("#unit").select2();

        $(".btn_kemaskini_peranan").on("click", function() {
            var nama_peranan = $("#control_checkbox_" + $(this).data("id")).val();
            var msg_err = "";

            if (nama_peranan == 0)
                msg_err = "Sila isi peranan pengguna untuk ditambah.";

            if (msg_err) {
                swal({
                    html: msg_err,
                    type: "error",
                    title: "Tambah Peranan Gagal",
                    showCancelButton: false,
                    confirmButtonText: 'OK',
                    allowOutsideClick: false
                });

                return false;
            }
            $("#modal_form_entry_" + $(this).data("id")).submit();
        });

        // $(".jFiler-input-caption span").text("Muatnaik gambar");
        // console.log($(".jFiler-input-caption span").html());

        $('.icnumber').keypress(validateNumber);

        $("#remove_img").click(function(e) {
            e.preventDefault();
            $('#profile_pic').val('');
            $('#header_name').val('');
            $('#profile-img').attr('src', 'assets/themes/v1/images/general/avatar-blank.png');

        });

        $('.numbers_only').keypress(function(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;

            return true;
        });

        $('.changeID').keyup(function() {
            changeID();
        });

        $('#li_maklumat').click(function() {
            $('#maklumat').show();
            $('#peranan').hide();
            $('#akses').hide();
            $('#katalaluan').hide();
        });

        $('#li_peranan').click(function() {
            $('#maklumat').hide();
            $('#peranan').show();
            $('#akses').hide();
            $('#katalaluan').hide();
        });

        $('#li_akses').click(function() {
            $('#maklumat').hide();
            $('#peranan').hide();
            $('#akses').show();
            $('#katalaluan').hide();
        });

        $('#li_katalaluan').click(function() {
            $('#maklumat').hide();
            $('#peranan').hide();
            $('#akses').hide();
            $('#katalaluan').show();
        });

        let index = 0;

        $(document).on("click", ".btn_tambah_ptj", function() {

            let index_remove = parseInt($('.index_size_after_remove_class').val());
            index = ($('.index_size_class').val() == null || index > 0) ? index_remove > 0 ? (index_remove) : (0 + index) : (parseInt($('.index_size_class').val()) + index);

            // reasign to 0  back
            $('.index_size_after_remove_class').val(0);

            let msg_err = "";
            let ptj_id = $('input[name="ptj"]').val();
            let ptj_text = $("#ptj_display").val();

            if (!ptj_id) {
                msg_err = "Sila pilih Pusat Tanggungjawab";

            } else {
                $("#list_table_ptj").find("tr").each(function() {
                    var dataInTable = $.trim($(this).find("td:eq(1)").text());
                    // console.log("Ptj: "+ptj_text+" intable: "+ dataInTable);
                    if (ptj_text == dataInTable) {
                        msg_err = "PTJ telah wujud."
                    }
                });
            }

            if (msg_err) {
                swal({
                    html: msg_err,
                    type: "error",
                    showCancelButton: false,
                    confirmButtonText: 'OK',
                    allowOutsideClick: false
                });

                // console.log(msg_err);
                return false;
            }

            let htmlnewrow = "";

            htmlnewrow = `
            <tr>
                <input type="hidden" name="ptj_insert[]" value="${ptj_id}">
                <td class="text-center" rowspan="2"> ${++index} </td>
                <td class="text-left"><input type="hidden" name="ptj_text[]" value="${ptj_text}" />${ptj_text}</td>
                <td class="text-center" rowspan="2"><a href="javascript:void(0);" class="removeptj" title="Hapus"><i class="ti-trash text-danger" style="font-size: 20px;"></i></a></td>
            </tr>
            <tr>
                <td colspan="1">
                    <table id="list_table_peranan_${ptj_id}" class="table table-bordered list_table_peranan_${ptj_id}">
                        <thead>
                            <tr>
                                <th colspan="3">Peranan Pengguna <a href="javascript:void(0);"  title="Tambah Pengguna" class="pull-right btn_popup_tambah_peranan" data-toggle="modal" data-target="#popup_tambah_peranan" data-id="${ptj_id}"><i class="icofont icofont-plus text-primary"></i></a></th>
                            </tr>
                            <tr>
                                <th>No</td>
                                <th>Peranan</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </td>
            </tr>
            `;

            if (htmlnewrow) {
                $('.index_size_class').val(index);
                $('#list_table_ptj tbody.first').append(htmlnewrow);
                $("#ptj_display").val("");
                $("input[name=ptj]").val("");
            }


        });

        $(document).on("click", ".btn_popup_tambah_peranan", function() {

            document.getElementById("modal_form_entry").reset();

            let id = $(this).data("id");
            var search = $.trim($("#search_module").val());
            var wf_code = $("#search_module").find(":selected").data("kod");

            if (search === "") {
                show_all();
            } else {
                hide_divs(search);
            }

            if (wf_code == "") {

            } else {
                // kena check kenapa error ni
                // $("#" + wf_code).style.display = "true";
            }

            $("#btn_tambah_peranan").data("id", id);
            $("#btn_tambah_peranan_kem").data("id", id);
        });

        $('.btn_tambah_peranan').click(function() {
            let ptj_id = $(this).data("id");
            var nama_peranan = $('#control_checkbox').val();

            var msg_err = "";

            var check_menu = 0;
            var check_aliran = 1;

            $('.check_menu:checkbox:checked').each(function() {
                if (check_menu == 0 && $(this).val() != "")
                    check_menu = 1;
            });

            // $('.peranan_checkbox_class:checkbox:checked').each(function() {
            //     if (check_aliran == 0 && $(this).val() != "")
            //         check_aliran = 1;
            // });


            // var roles_id = $('#roles_modal').val();
            // var roles_text = $("#roles_modal option:selected").text();
            var peranan_input = "";
            $('.peranan_checkbox_class:checkbox:checked').each(function(i) {

                /**
                 * musa tambah
                 */
                var attr = $(this).attr('disabled');

                if (typeof attr !== typeof undefined && attr !== false) {
                    return false;
                }

                peranan_input += '<input type="hidden" name="peranan_checkbox[' + ptj_id + '][]" value="' + $(this).val() + '" >';
            });
            var check_lihat_input = "";
            $('.check_lihat_menu:checkbox:checked').each(function(i) {
                check_lihat_input += '<input type="hidden" name="check_lihat_input[' + ptj_id + '][' + $(this).val() + ']" value="' + $(this).val() + '" >';
            });
            var check_tambah_input = "";
            $('.check_tambah_menu:checkbox:checked').each(function(i) {
                check_tambah_input += '<input type="hidden" name="check_tambah_input[' + ptj_id + '][' + $(this).val() + ']" value="' + $(this).val() + '" >';
            });
            var check_simpan_input = "";
            $('.check_simpan_menu:checkbox:checked').each(function(i) {
                check_simpan_input += '<input type="hidden" name="check_simpan_input[' + ptj_id + '][' + $(this).val() + ']" value="' + $(this).val() + '" >';
            });
            var check_hapus_input = "";
            $('.check_hapus_menu:checkbox:checked').each(function(i) {
                check_hapus_input += '<input type="hidden" name="check_hapus_input[' + ptj_id + '][' + $(this).val() + ']" value="' + $(this).val() + '" >';
            });
            var check_cetak_input = "";
            $('.check_cetak_menu:checkbox:checked').each(function(i) {
                check_cetak_input += '<input type="hidden" name="check_cetak_input[' + ptj_id + '][' + $(this).val() + ']" value="' + $(this).val() + '" >';
            });

            if (nama_peranan == 0)
                msg_err = "Sila isi peranan pengguna untuk ditambah."
            if (check_menu == 0)
                msg_err += "<br>Sila pilih menu untuk diakses."
            if (check_aliran == 0)
                msg_err += "<br>Sila pilih aliran kerja."

            if (nama_peranan == 1) {
                nama_peranan = "penyedia";
            } else if (nama_peranan == 2) {
                nama_peranan = "penyemak";
            } else if (nama_peranan == 3) {
                nama_peranan = "pelulus";
            }

            if (msg_err != "") {
                swal({
                    html: msg_err,
                    type: "error",
                    title: "Tambah Peranan Gagal",
                    showCancelButton: false,
                    confirmButtonText: 'OK',
                    allowOutsideClick: false
                });
            } else {
                $('#roles_modal').val('');

                var row = document.getElementById('list_table_peranan_empty');
                if (row) {
                    row.parentNode.removeChild(row);
                }

                var rowCount = $('#list_table_peranan_' + ptj_id + ' > tbody > tr').length + 1;

                console.log(ptj_id);

                var htmlnewrow = "";
                htmlnewrow = '<tr><input type="hidden" name="role[' + ptj_id + '][]" value="" />' +
                    '<td class="text-center">' + rowCount +
                    peranan_input +
                    check_lihat_input +
                    check_tambah_input +
                    check_simpan_input +
                    check_hapus_input +
                    check_cetak_input +
                    '</td>' +
                    '<td class="text-left"><input type="hidden" id="nama_peranan[]" name="nama_peranan[' + ptj_id + ']" value="' + nama_peranan + '" />' + nama_peranan + '</td>' +
                    '<td class="text-center"><a href="javascript:void(0)" id="deleteBtn" class=" removeperanan" alt="hapus" data-id="' + ptj_id + '"><i class="text-danger ti-trash" style="font-size: 20px;"></i></a></td>' +
                    '</tr>';

                // htmlnewrow = '<tr><input type="hidden" name="role['+ptj_id+'][]" value="'" />' +
                //     '<td class="text-center">' + rowCount + '</td>' +
                //     '<td class="text-left"><input type="hidden" id="role_text[]" name="role_text['+ptj_id+'][]" value="' + roles_text + '" />' + roles_text + '</td>' +
                //     '<td class="text-center"><a href="javascript:void(0)" id="deleteBtn" class=" removeperanan" alt="hapus" data-id="'+ptj_id+'"><i class="text-danger ti-trash"></i></a></td>' +
                //     '</tr>';

                if (htmlnewrow) {
                    $('#list_table_peranan_' + ptj_id + ' tbody').append(htmlnewrow);
                }

                $(".btn_popup_tambah_peranan").hide();

                $('#popup_tambah_peranan').modal('toggle');
                swal({
                    html: 'Tambah Peranan Berjaya',
                    type: "success",
                    showCancelButton: false,
                    confirmButtonText: 'OK',
                    allowOutsideClick: false
                });

            }
        });

        $('.btn_tambah_peranan_kem').click(function() {
            let ptj_id = $(this).data("id");
            var nama_peranan = $('#control_checkbox').val();
            var msg_err = "";

            var check_menu = 0;
            // var check_aliran = 0;

            $('.check_menu_kem:checkbox:checked').each(function() {
                if (check_menu == 0 && $(this).val() != "")
                    check_menu = 1;
            });

            // $('.peranan_checkbox_class_kem:checkbox:checked').each(function() {
            //     if (check_aliran == 0 && $(this).val() != "")
            //         check_aliran = 1;
            // });


            // var roles_id = $('#roles_modal').val();
            // var roles_text = $("#roles_modal option:selected").text();
            var peranan_input = "";
            $('.peranan_checkbox_class_kem:checkbox:checked').each(function(i) {
                /**
                 * musa tambah
                 */
                var attr = $(this).attr('disabled');

                if (typeof attr !== typeof undefined && attr !== false) {
                    return false;
                }
                peranan_input += '<input type="hidden" name="peranan_checkbox[' + ptj_id + '][]" value="' + $(this).val() + '" >';
            });


            if (peranan_input == '') {
                var peranan_input = "";
                $('.peranan_checkbox_class:checkbox:checked').each(function(i) {

                    /**
                     * musa tambah
                     */
                    var attr = $(this).attr('disabled');

                    if (typeof attr !== typeof undefined && attr !== false) {
                        return false;
                    }
                    peranan_input += '<input type="hidden" name="peranan_checkbox[' + ptj_id + '][]" value="' + $(this).val() + '" >';
                });
            }


            var check_lihat_input = "";
            $('.check_lihat_menu_kem:checkbox:checked').each(function(i) {
                check_lihat_input += '<input type="hidden" name="check_lihat_input[' + ptj_id + '][' + $(this).val() + ']" value="' + $(this).val() + '" >';
            });
            var check_tambah_input = "";
            $('.check_tambah_menu_kem:checkbox:checked').each(function(i) {
                check_tambah_input += '<input type="hidden" name="check_tambah_input[' + ptj_id + '][' + $(this).val() + ']" value="' + $(this).val() + '" >';
            });
            var check_simpan_input = "";
            $('.check_simpan_menu_kem:checkbox:checked').each(function(i) {
                check_simpan_input += '<input type="hidden" name="check_simpan_input[' + ptj_id + '][' + $(this).val() + ']" value="' + $(this).val() + '" >';
            });
            var check_hapus_input = "";
            $('.check_hapus_menu_kem:checkbox:checked').each(function(i) {
                check_hapus_input += '<input type="hidden" name="check_hapus_input[' + ptj_id + '][' + $(this).val() + ']" value="' + $(this).val() + '" >';
            });
            var check_cetak_input = "";
            $('.check_cetak_menu_kem:checkbox:checked').each(function(i) {
                check_cetak_input += '<input type="hidden" name="check_cetak_input[' + ptj_id + '][' + $(this).val() + ']" value="' + $(this).val() + '" >';
            });

            if (nama_peranan == 0)
                msg_err = "Sila isi peranan pengguna untuk ditambah."
            if (check_menu == 0)
                msg_err += "<br>Sila pilih menu untuk diakses."
            // if (check_aliran == 0)
            //     msg_err += "<br>Sila pilih aliran kerja."

            if (nama_peranan == 1) {
                nama_peranan = "penyedia";
            } else if (nama_peranan == 2) {
                nama_peranan = "penyemak";
            } else if (nama_peranan == 3) {
                nama_peranan = "pelulus";
            }

            if (msg_err != "") {
                swal({
                    html: msg_err,
                    type: "error",
                    title: "Tambah Peranan Gagal",
                    showCancelButton: false,
                    confirmButtonText: 'OK',
                    allowOutsideClick: false
                });
            } else {
                $('#roles_modal').val('');

                var row = document.getElementById('list_table_peranan_empty');
                if (row) {
                    row.parentNode.removeChild(row);
                }

                var rowCount = $('#list_table_peranan_' + ptj_id + ' > tbody > tr').length + 1;

                console.log(ptj_id);

                var htmlnewrow = "";
                htmlnewrow = '<tr><input type="hidden" name="role[' + ptj_id + '][]" value="" />' +
                    '<td class="text-center">' + rowCount +
                    peranan_input +
                    check_lihat_input +
                    check_tambah_input +
                    check_simpan_input +
                    check_hapus_input +
                    check_cetak_input +
                    '</td>' +
                    '<td class="text-left"><input type="hidden" id="nama_peranan[]" name="nama_peranan[' + ptj_id + ']" value="' + nama_peranan + '" />' + nama_peranan + '</td>' +
                    '<td class="text-center"><a href="javascript:void(0)" id="deleteBtn" class=" removeperanan" alt="hapus" data-id="' + ptj_id + '"><i class="text-danger ti-trash" style="font-size: 20px;"></i></a></td>' +
                    '</tr>';

                // htmlnewrow = '<tr><input type="hidden" name="role['+ptj_id+'][]" value="'" />' +
                //     '<td class="text-center">' + rowCount + '</td>' +
                //     '<td class="text-left"><input type="hidden" id="role_text[]" name="role_text['+ptj_id+'][]" value="' + roles_text + '" />' + roles_text + '</td>' +
                //     '<td class="text-center"><a href="javascript:void(0)" id="deleteBtn" class=" removeperanan" alt="hapus" data-id="'+ptj_id+'"><i class="text-danger ti-trash"></i></a></td>' +
                //     '</tr>';

                if (htmlnewrow) {
                    $('#list_table_peranan_' + ptj_id + ' tbody').append(htmlnewrow);
                }

                $(".btn_popup_tambah_peranan").hide();

                $('#popup_tambah_peranan').modal('toggle');
                swal({
                    html: 'Tambah Peranan Berjaya',
                    type: "success",
                    showCancelButton: false,
                    confirmButtonText: 'OK',
                    allowOutsideClick: false
                });

            }
        });

        $('.btn_tambah_akses_sementara').click(function() {
            let ptj_id = $("#ptj_input_id").val();
            let ptj_display_name = $("#ptj_input_display").val();
            let tarikh_mula = $("#tarikh_mula_id").val();
            let tarikh_tamat = $("#tarikh_tamat_id").val();
            let keterangan = "-";

            var check_menu = 0;
            // var check_aliran = 0;
            let msg_err = "";

            $('.check_menu_kem:checkbox:checked').each(function() {
                if (check_menu == 0 && $(this).val() != "")
                    check_menu = 1;
            });



            var input_new = '<input type="hidden" name="ptj_id_akses_sementara[' + ptj_id + ']" class="ptj_id_akses_sementara_class" value="' + ptj_id + '" >' +
                '<input type="hidden" name="tarikh_mula_arr[' + ptj_id + ']" value="' + tarikh_mula + '" >' +
                '<input type="hidden" name="tarikh_tamat_arr[' + ptj_id + ']" value="' + tarikh_tamat + '" >' +
                '<input type="hidden" name="keterangan_arr[' + ptj_id + ']" value="' + keterangan + '" >';

            var peranan_input = "";
            $('.peranan_checkbox_class_as:checkbox:checked').each(function(i) {

                /**
                 * musa tambah
                 */
                var attr = $(this).attr('disabled');

                if (typeof attr !== typeof undefined && attr !== false) {
                    return false;
                }

                peranan_input += '<input type="hidden" name="peranan_checkbox_as[' + ptj_id + '][]" value="' + $(this).val() + '" >';
            });

            var check_lihat_input = "";
            $('.check_lihat_menu_as:checkbox:checked').each(function(i) {
                check_lihat_input += '<input type="hidden" name="check_lihat_input_as[' + ptj_id + '][' + $(this).val() + ']" value="' + $(this).val() + '" >';
            });
            var check_tambah_input = "";
            $('.check_tambah_menu_as:checkbox:checked').each(function(i) {
                check_tambah_input += '<input type="hidden" name="check_tambah_input_as[' + ptj_id + '][' + $(this).val() + ']" value="' + $(this).val() + '" >';
            });
            var check_simpan_input = "";
            $('.check_simpan_menu_as:checkbox:checked').each(function(i) {
                check_simpan_input += '<input type="hidden" name="check_simpan_input_as[' + ptj_id + '][' + $(this).val() + ']" value="' + $(this).val() + '" >';
            });
            var check_hapus_input = "";
            $('.check_hapus_menu_as:checkbox:checked').each(function(i) {
                check_hapus_input += '<input type="hidden" name="check_hapus_input_as[' + ptj_id + '][' + $(this).val() + ']" value="' + $(this).val() + '" >';
            });
            var check_cetak_input = "";
            $('.check_cetak_menu_as:checkbox:checked').each(function(i) {
                check_cetak_input += '<input type="hidden" name="check_cetak_input_as[' + ptj_id + '][' + $(this).val() + ']" value="' + $(this).val() + '" >';
            });

            if (check_menu == 0)
                msg_err += "<br>Sila pilih menu untuk diakses."
            // if (check_aliran == 0)
            //     msg_err += "<br>Sila pilih aliran kerja."

            if (msg_err != "") {
                swal({
                    html: msg_err,
                    type: "error",
                    title: "Tambah Peranan Gagal",
                    showCancelButton: false,
                    confirmButtonText: 'OK',
                    allowOutsideClick: false
                });
            } else {
                $('#roles_modal').val('');

                var row = document.getElementById('list_table_peranan_empty');
                if (row) {
                    row.parentNode.removeChild(row);
                }

                var rowCount = $('#list_table_akses > tbody > tr').length + 1;

                // console.log(ptj_id);

                var masterhtml = "";
                var htmlnewrow = "";
                var htmlnewrow2 = "";
                var htmlnewrow3 = "";
                var htmlnewrow2add = "";

                htmlnewrow = '<tr>' +
                    '<td class="text-center">' + rowCount +
                    check_lihat_input +
                    check_tambah_input +
                    check_simpan_input +
                    check_hapus_input +
                    check_cetak_input +
                    peranan_input +
                    input_new +
                    '</td>' +
                    '<td class="text-left">' + ptj_display_name + '</td>';
                htmlnewrow2 = `'<td class="text-left">${moment(tarikh_mula).format("DD-MM-YYYY")}</td>' +
                    '<td class="text-left">${moment(tarikh_tamat).format("DD-MM-YYYY")}</td>'`;
                htmlnewrow2add = '<td class="text-left">' + keterangan + '</td>';
                htmlnewrow3 = '<td class="text-left"> - </td>' +
                    '<td class="text-center"><a href="javascript:void(0)" id="deleteBtn" class=" remove_akses" alt="hapus" data-id="' + ptj_id + '"><i class="text-danger ti-trash" style="font-size: 20px;"></i></a></td>' +
                    '</tr>';

                masterhtml = htmlnewrow + htmlnewrow2 + htmlnewrow2add + htmlnewrow3;

                if (masterhtml) {
                    $('#list_table_akses tbody').append(masterhtml);
                }

                $("#ptj2_display").val('');
                $("#tarikh_mula").val('');
                $("#tarikh_tamat").val('');

                $("#tarikh_tamat").attr("max", null);
                $("#tarikh_tamat").attr("min", null);

                $("#tarikh_mula").attr("max", null);
                $("#tarikh_mula").attr("min", null);
				
                // $('input[type=date]').each(function resetDate() {
                //     // This works as long as the form doesn't have an initial value specified
                //     this.value = this.defaultValue;
                // });
                $("#keterangan").val('');

                $('#popup_tambah_akses_peranan_add').modal('toggle');
                swal({
                    html: 'Tambah Peranan Berjaya',
                    type: "success",
                    showCancelButton: false,
                    confirmButtonText: 'OK',
                    allowOutsideClick: false
                });

            }
        });

        $(document).on('change', '#tarikh_tamat_id_sementara_id', function() {
            var tarikh_tamat_id_sementara_id = new Date($("#tarikh_tamat_id_sementara_id").val());
            var tarikh_tamat_old = "";
            $('#list_table_akses tr').not(':first').each(function() {

                var tarikh_tamat = $(this).find("td").eq(3).html();
                tarikh_tamat = tarikh_tamat.replace("/", "-").replace("/", "-");
                var dateParts = tarikh_tamat.split("-");

                var tarikh_tamat_f = new Date(dateParts[2], dateParts[1] - 1, dateParts[0]);

                if (tarikh_tamat_old == "") {
                    tarikh_tamat_old = tarikh_tamat_f;
                }

                if (tarikh_tamat_old < tarikh_tamat_f) {
                    tarikh_tamat_old = tarikh_tamat_f;
                }
            });

            if (tarikh_tamat_id_sementara_id < tarikh_tamat_old) {
                Swal.fire({
                    icon: 'error',
                    title: 'Ralat',
                    text: 'Tarikh tamat id sementara kurang dari tarikh id akses sementara',
                })
                $("#tarikh_tamat_id_sementara_id").val('')
                $("#tarikh_tamat_id_sementara_id").focus()
            }


        });

        $("#select_modul").change(function() {
            $("#container").html("");

            $.ajax({
                url: "<?= base_url('sistem/view_menu') . url_akses(); ?>",
                method: "POST",
                data: {
                    csrf_jts_name: $.cookie('csrf_cookie_name'),
                    id: $(this).val()
                }
            }).done(function(result) {
                $("#container").html(result);
            }).done(function() {
                $('#akses_modal').modal('toggle');
            });
        });

        $(document).on('click', 'a.remove_akses', function() {
            let ptj_id = $(this).data("id");

            swal({
                html: "Anda pasti untuk hapuskan rekod ini?",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: "Tidak",
                allowOutsideClick: false
            }).then((result) => {
                if (result.value) {
                    $(this).closest('tr').remove();

                    $('#list_table_akses tbody tr').each(function(i) {
                        $($(this).find('td')[0]).html(i + 1);
                    });

                    if ($('#list_table_akses tbody tr').length == 0) {
                        $('#list_table_akses tbody').append('<tr id="list_table_peranan_empty"><td colspan="6" class="text-center">Tiada Rekod.</td></tr>');
                    }
                    return false;
                }
            })

        });

        $(document).on('click', 'a.removeperanan', function() {
            let ptj_id = $(this).data("id");

            swal({
                html: "Anda pasti untuk hapuskan rekod ini?",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: "Tidak",
                allowOutsideClick: false
            }).then((result) => {
                if (result.value) {
                    $(this).closest('tr').remove();
                    $(".btn_popup_tambah_peranan").show();

                    $('#list_table_peranan_' + ptj_id + ' tbody tr').each(function(i) {
                        $($(this).find('td')[0]).html(i + 1);
                    });

                    if ($('#list_table_peranan_' + ptj_id + ' tbody tr').length == 0) {
                        $('#list_table_peranan' + ptj_id + ' tbody').append('<tr id="list_table_peranan_empty"><td colspan="3" class="text-center">Tiada Rekod.</td></tr>');
                    }
                    return false;
                }
            })

        });

        $(document).on('click', 'a.removeptj', function() {
            let firstrow = $(this).closest('tr');
            let secondrow = firstrow.next();
            let newindex = 0;

            swal({
                html: "Anda pasti untuk hapuskan rekod ini?",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: "Tidak",
                allowOutsideClick: false
            }).then((result) => {
                if (result.value) {
                    firstrow.remove();
                    secondrow.remove();

                    $('#list_table_ptj tbody.first > tr').each(function(i) {
                        if (i % 2 === 0) {
                            $($(this).find('td')[0]).html(++newindex);
                        }
                    });

                    $('.index_size_after_remove_class').val(newindex);
                }
            })


        });

        $(document).on('click', '#btn_tambah_akses_add', function() {
            let ptj_inserted = $("input[name='ptj_inserted[]']").map(function() {
                return $(this).val();
            }).get();
            let ptj_inserting = $("input[name='ptj_insert[]']").map(function() {
                return $(this).val();
            }).get();
            let ptj_all = ptj_inserted.concat(ptj_inserting);

            let msg_err = "";
            let ptj = $("input[name='ptj2']").val();
            let ptj_text = $("#ptj2_display").val();
            let tarikh_mula = $("input[name='tarikh_mula']").val();
            let tarikh_tamat = $("input[name='tarikh_tamat']").val();

            $('.ptj_id_akses_sementara_class').each(function() {
                if (ptj == $(this).val()) {
                    msg_err += "<br>Pusat Tanggungjawab yang sama, tidak boleh dicipta lebih dari 2.";
                }
            });

            // let rowCount = $('#list_table_akses > tbody > tr').length + 1;
            $("#ptj_input_id").val(ptj);
            $("#ptj_input_display").val(ptj_text);
            $("#tarikh_mula_id").val(tarikh_mula);
            $("#tarikh_tamat_id").val(tarikh_tamat);

            if (ptj.length == 0 || tarikh_mula.length == 0 || tarikh_tamat.length == 0) {
                msg_err = "Sila isi maklumat."
            }

            if (msg_err != "") {
                swal({
                    html: msg_err,
                    type: "error",
                    showCancelButton: false,
                    confirmButtonText: 'OK',
                    allowOutsideClick: false
                });

                return false;
            }

            $("#popup_tambah_akses_peranan_add").modal("show");
        });

        $(document).on('click', '#btn_tambah_akses_edit', function() {
            let ptj_inserted = $("input[name='ptj_inserted[]']").map(function() {
                return $(this).val();
            }).get();
            let ptj_inserting = $("input[name='ptj_insert[]']").map(function() {
                return $(this).val();
            }).get();
            let ptj_all = ptj_inserted.concat(ptj_inserting);

            let msg_err = "";
            let ptj = $("input[name='ptj2']").val();
            let ptj_text = $("#ptj2_display").val();
            let roles_id = $('#roles').val();
            let roles_text = $("#roles option:selected").text();
            let tarikh_mula = $("input[name='tarikh_mula']").val();
            let tarikh_tamat = $("input[name='tarikh_tamat']").val();

            let rowCount = $('#list_table_akses > tbody > tr').length + 1;

            if (ptj.length == 0 || roles.length == 0 || tarikh_mula.length == 0 || tarikh_tamat.length == 0) {
                msg_err = "Sila isi maklumat."
            }

            if (msg_err != "") {
                swal({
                    html: msg_err,
                    type: "error",
                    showCancelButton: false,
                    confirmButtonText: 'OK',
                    allowOutsideClick: false
                });

                return false;
            }

            let htmlnewrow = "";
            htmlnewrow = `
                <tr>
                    <td class="text-center">
                        ${rowCount}
                    </td>
                    <td class="text-left" style="white-space:normal">
                        <input type="hidden" name="ptj_sementara[]" value="${ptj}" />
                        ${ptj_text}
                    </td>
                    <td style="white-space:normal">
                        <input type="hidden" name="peranan_sementara[]" value="${roles_id}" />
                        ${roles_text}
                    </td>
                    <td>
                        <input type="hidden" name="tarikh_mula[]" value="${tarikh_mula}" />
                        ${moment(tarikh_mula).format('DD-MM-YYYY')}
                    </td>
                    <td>
                        <input type="hidden" name="tarikh_tamat[]" value="${tarikh_tamat}" />
                        ${moment(tarikh_tamat).format('DD-MM-YYYY')}
                    </td>
                    <td class="text-center">
                        -
                    </td>
                    <td class="text-center">
                        <a href="javascript:void(0)" class="removeakses" alt="Hapus"><i class="text-danger ti-trash" style="font-size: 20px;"></i></a>
                    </td>
                </tr>`;

            if (htmlnewrow) {
                $('#list_table_akses tbody').append(htmlnewrow);

                $("input[name='ptj2']").val("");
                $("#ptj2_display").val("");
                $('#roles').val("");
                $("input[name='tarikh_mula']").val("");
                $("input[name='tarikh_tamat']").val("");
            }
        });

        $(document).on('click', 'a.removeakses', function() {

            swal({
                html: "Anda pasti untuk hapuskan rekod ini?",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: "Tidak",
                allowOutsideClick: false
            }).then((result) => {
                if (result.value) {
                    $(this).closest('tr').remove();

                    $('#list_table_akses tbody tr').each(function(i) {
                        $($(this).find('td')[0]).html(i + 1);
                    });
                }
            })

        });

        $('.deleteakses').click(function(e) {
            event.preventDefault();
            var link = $(this).attr('href');

            swal({
                html: "Anda pasti untuk hapuskan rekod ini?",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: "Tidak",
                allowOutsideClick: false
            }).then((result) => {
                if (result.value) {
                    window.location.href = link;
                }
            })
        });

        $('.deleteptj').click(function(e) {
            event.preventDefault();
            var link = $(this).attr('href');

            swal({
                html: "Anda pasti untuk hapuskan rekod ini?",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: "Tidak",
                allowOutsideClick: false
            }).then((result) => {
                if (result.value) {
                    window.location.href = link;
                }
            })
        });

        let searchParams = new URLSearchParams(window.location.href);
        let param = searchParams.get('tab');
        if (param == "akses") {
            $("#li_akses").trigger("click");
        } else if (param == "peranan") {
            $("#li_peranan").trigger("click");
        }

        $(document).ready(function() {
            $(document).on('click', '.checkall_lihat', function() {
                var id = $(this).attr('id');
                $('.checkmenu_' + id).prop('checked', this.checked);
            });
            $(document).on('click', '.checkall_tambah', function() {
                var id = $(this).attr('id');
                $('.checkmenu_' + id).prop('checked', this.checked);
            });
            $(document).on('click', '.checkall_simpan', function() {
                var id = $(this).attr('id');
                $('.checkmenu_' + id).prop('checked', this.checked);
            });
            $(document).on('click', '.checkall_hapus', function() {
                var id = $(this).attr('id');
                $('.checkmenu_' + id).prop('checked', this.checked);
            });
            $(document).on('click', '.checkall_cetak', function() {
                var id = $(this).attr('id');
                $('.checkmenu_' + id).prop('checked', this.checked);
            });
            $(document).on('click', '.check_lihat_menu', function() {
                var className = $(this).attr('class');
                var modulid = className.replace("border-checkbox check_lihat_menu checkmenu_lihat_modul_", "");
                var parent_id = $(this).data("parent");

                var isAllChecked = 0;
                $(".checkmenu_lihat_modul_" + modulid).each(function() {
                    if (!this.checked)
                        isAllChecked = 1;
                });

                if (isAllChecked == 0) {
                    $('.check_lihat_modul_' + modulid).prop('checked', this.checked);
                } else {
                    $('.check_lihat_modul_' + modulid).prop("checked", false);
                }

                check_parent('#lihat_menu_', $(this));
                uncheck_parent('lihat_menu_', $(this));
            });

            $(document).on('click', '.check_tambah_menu', function() {
                var className = $(this).attr('class');
                var modulid = className.replace("border-checkbox check_tambah_menu checkmenu_tambah_modul_", "");

                var isAllChecked = 0;
                $(".checkmenu_tambah_modul_" + modulid).each(function() {
                    if (!this.checked)
                        isAllChecked = 1;
                });

                if (isAllChecked == 0) {
                    $('.check_tambah_modul_' + modulid).prop('checked', this.checked);
                } else {
                    $('.check_tambah_modul_' + modulid).prop("checked", false);
                }

                check_parent('#tambah_menu_', $(this));
                uncheck_parent('tambah_menu_', $(this));
            });

            $(document).on('click', '.check_simpan_menu', function() {
                var className = $(this).attr('class');
                var modulid = className.replace("border-checkbox check_simpan_menu checkmenu_simpan_modul_", "");

                var isAllChecked = 0;
                $(".checkmenu_simpan_modul_" + modulid).each(function() {
                    if (!this.checked)
                        isAllChecked = 1;
                });

                if (isAllChecked == 0) {
                    $('.check_simpan_modul_' + modulid).prop('checked', this.checked);
                } else {
                    $('.check_simpan_modul_' + modulid).prop("checked", false);
                }

                check_parent('#simpan_menu_', $(this));
                uncheck_parent('simpan_menu_', $(this));
            });

            $(document).on('click', '.check_hapus_menu', function() {
                var className = $(this).attr('class');
                var modulid = className.replace("border-checkbox check_hapus_menu checkmenu_hapus_modul_", "");

                var isAllChecked = 0;
                $(".checkmenu_hapus_modul_" + modulid).each(function() {
                    if (!this.checked)
                        isAllChecked = 1;
                });

                if (isAllChecked == 0) {
                    $('.check_hapus_modul_' + modulid).prop('checked', this.checked);
                } else {
                    $('.check_hapus_modul_' + modulid).prop("checked", false);
                }

                check_parent('#hapus_menu_', $(this));
                uncheck_parent('hapus_menu_', $(this));
            });

            $(document).on('click', '.check_cetak_menu', function() {
                var className = $(this).attr('class');
                var modulid = className.replace("border-checkbox check_cetak_menu checkmenu_cetak_modul_", "");
                var id = $(this).attr('id').replace("cetak_menu_", "");
                var curr = $(this);

                var isAllChecked = 0;
                $(".checkmenu_cetak_modul_" + modulid).each(function() {
                    if (!this.checked)
                        isAllChecked = 1;
                });

                if (isAllChecked == 0) {
                    $('.check_cetak_modul_' + modulid).prop('checked', this.checked);
                } else {
                    $('.check_cetak_modul_' + modulid).prop("checked", false);
                }

                check_parent('#cetak_menu_', $(this));
                uncheck_parent('cetak_menu_', $(this));
            });

            /* new peranan  */
            $(document).on('click', '.checkall_sedia', function() {
                var id = $(this).attr('id');
                $('.checkmenu_' + id).prop('checked', this.checked);
            });

            $(document).on('click', '.check_sedia_menu', function() {
                var className = $(this).attr('class');
                var modulid = className.replace("border-checkbox check_sedia_menu checkmenu_sedia_modul_", "");
                var parent_id = $(this).data("parent");

                var isAllChecked = 0;
                $(".checkmenu_sedia_modul_" + modulid).each(function() {
                    if (!this.checked)
                        isAllChecked = 1;
                });

                if (isAllChecked == 0) {
                    $('.check_sedia_modul_' + modulid).prop('checked', this.checked);
                } else {
                    $('.check_sedia_modul_' + modulid).prop("checked", false);
                }

                check_parent('#sedia_menu_', $(this));
                uncheck_parent('sedia_menu_', $(this));
            });

            /* new peranan end */

            function uncheck_parent(tag, dom) {
                var id = dom.attr('id').replace(tag, "");
                var children = $('[id*="' + tag + '"][data-parent="' + id + '"]');

                children.each(function() {
                    if (dom.is(':checked')) {
                        $(this).prop('checked', true);
                    } else {
                        $(this).prop('checked', false);
                    }

                    if (children.length > 0) uncheck_parent(tag, $(this));
                });
            }

            function check_parent(tag, dom) {
                var parent_id = dom.data("parent");

                if (typeof parent_id !== 'undefined' && dom.is(':checked')) {
                    $(tag + parent_id).prop('checked', true);
                    check_parent(tag, $(tag + parent_id));
                }
            }

            $("#search_module").keyup(function() {
                var search = $.trim(this.value);
                var wf_code = (this).data("id");

                if (search === "") {
                    show_all();
                } else {
                    hide_divs(search);
                }
            });

            $("#search_module").change(function() {
                var search = $.trim(this.value);
                var wf_code = $(this).find(":selected").data("kod");

                if (search === "") {
                    show_all();
                } else {
                    hide_divs(search);
                }

                $(".hide-all-peranan").hide();

                if (wf_code == "") {

                } else {
                    $("#" + wf_code).show();
                }

            });

            $("#search_module_update").keyup(function() {
                var search = $.trim(this.value);
                var wf_code = (this).data("id");

                if (search === "") {
                    show_all();
                } else {
                    hide_divs(search);
                }
            });

            $(".search_module_update").change(function() {
                var search = $.trim(this.value);
                var wf_code = $(this).find(":selected").data("kod");
                var flag = $(this).find(":selected").data("flag");

                if (search === "") {
                    show_all();
                } else {
                    hide_divs(search);
                }


                if (wf_code == "") {

                } else {
                    $("#" + wf_code + "_" + flag).show();
                }

            });

            // akses sementara
            $("#search_module_akses_sementara_add").keyup(function() {
                var search = $.trim(this.value);
                var wf_code = (this).data("id");

                if (search === "") {
                    show_all();
                } else {
                    hide_divs(search);
                }
            });

            $("#search_module_akses_sementara_add").change(function() {
                var search = $.trim(this.value);
                var wf_code = $(this).find(":selected").data("kod");

                if (search === "") {
                    show_all();
                } else {
                    hide_divs(search);
                }

                $(".hide-all-peranan").hide();

                if (wf_code == "") {

                } else {
                    $("#" + wf_code).show();
                }

            });

            $("#search_module_update_sementara").keyup(function() {
                var search = $.trim(this.value);
                var wf_code = (this).data("id");

                if (search === "") {
                    show_all();
                } else {
                    hide_divs(search);
                }
            });

            $(".search_module_update_sementara").change(function() {
                var search = $.trim(this.value);
                var wf_code = $(this).find(":selected").data("kod");
                var flag = $(this).find(":selected").data("flag");

                if (search === "") {
                    show_all();
                } else {
                    hide_divs(search);
                }


                if (wf_code == "") {

                } else {
                    $("#" + wf_code + "_" + flag).show();
                }

            });

            function get_akses_text(kod_array) {
                var list_akses = ['l', 't', 's', 'h', 'c'];
                var akses_text = "";

                if (kod_array.includes('l')) akses_text += "Lihat ";
                if (kod_array.includes('t')) akses_text += "Tambah ";
                if (kod_array.includes('s')) akses_text += "Simpan ";
                if (kod_array.includes('h')) akses_text += "Hapus ";
                if (kod_array.includes('c')) akses_text += "Cetak ";

                return akses_text;
            }

            $(document).on('click', '#tambah_menu', function() {
                if ($("#list_table_akses_empty")) {
                    $("#list_table_akses_empty").remove();
                }
                var tarikh_mula = $("#tarikh_mula").val();
                var tarikh_tamat = $("#tarikh_tamat").val();

                var allchecked = $("input[type=checkbox][id*='menu']:checked");
                var all_akses = {};
                var all_label = {};
                var row = "";
                var counter = $("td.counter").length;

                allchecked.each(function(index, ele) {
                    var akses = $(ele).attr("id").slice(0, 1);
                    var menu_id = $(ele).val();
                    var label_text = $(ele).closest("tr").find("td.nama_menu").text();

                    if (!Array.isArray(all_akses[menu_id])) {
                        all_akses[menu_id] = [];
                    }
                    if (!Array.isArray(all_label[menu_id])) {
                        all_label[menu_id] = [];
                    }

                    all_akses[menu_id].push(akses);
                    if (!all_label[menu_id].includes(label_text)) {
                        all_label[menu_id].push(label_text);
                    }
                });

                $.each(all_akses, function(key, value) {
                    row += `
                <tr>
                    <td class="counter">
                        <input type="hidden" name="menu_id[]" value="${key}">
                        ${++counter}
                    </td>
                    <td>
                        <input type="hidden" name="akses[]" value="${all_akses[key].join()}">
                        ${all_label[key]}
                    </td>
                    <td>
                        ${get_akses_text(all_akses[key].join())}
                    </td>
                    <td>${tarikh_mula}</td>
                    <td>${tarikh_tamat}</td>
                    <td><button type="button" class="btn btn-mini btn-danger delete_added_menu_access" alt="hapus"><i class="ti-trash" style="font-size: 20px;"></i>Hapus</button></td>
                </tr>`;
                });

                $('#list_table_akses tbody').append(row);
                $("#btn_tutup_modal").trigger("click");
            });

            $(document).on('click', '.delete_added_menu_access', function() {
                var row = this.closest("tr");
                row.remove();
            });

            $(document).on('click', '.delete_menu_access', function() {
                swal({
                    html: "Adakah anda pasti untuk hapus menu akses ini?",
                    type: "warning",
                    showCancelButton: true,
                    allowOutsideClick: false
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                                url: "<?= base_url('sistem/hapus_pengguna_menu_akses') . url_akses(); ?>",
                                method: "POST",
                                data: {
                                    id: $(this).data("id")
                                }
                            })
                            .done((result) => {
                                var result_obj = jQuery.parseJSON(result);
                                if (result_obj.status == true) {
                                    var row = this.closest("tr");
                                    row.remove();
                                    swal({
                                        html: "Menu akses berjaya dihapus.",
                                        type: "success",
                                        showCancelButton: false,
                                        confirmButtonText: 'OK',
                                        allowOutsideClick: false
                                    });
                                } else {
                                    swal({
                                        html: "Menu akses gagal dihapus. Sila cuba lagi!",
                                        type: "error",
                                        showCancelButton: false,
                                        confirmButtonText: 'OK',
                                        allowOutsideClick: false
                                    })
                                }
                            });
                    }
                });
            });
        });

        $(document).on('click', '.btn_reset_searchform', function() {
            var inputs = $(this).closest('div.modal-body').find('input');
            inputs.each(function() {
                $(this).val("");
                $(this).keyup();
            });
        });

        $(document).on("click", "#btn_set_semula", function() {
            $("#form_entry input:not([type=hidden])").val("");
            $("#form_entry input[name=jwtn_hakiki]").val("");
            $("#form_entry input[name=jwtn_gelaran]").val("");
            $("#form_entry select").val("");
            // $("#kod").val("");
            // $("#kod_lain").val("");
            // $("#keterangan_kod").val("");
            // $( "#active" ).prop( "checked", false );
        });

        $(document).on('click', '.icon-jfi-trash', function() {
            $('#profile_pic').val('');
            // $('#header_name').val('');
            if ($('#header_name').val() != "") {
                $('#profile-img').attr('src', $('#header_name').val());
            } else {
                $('#profile-img').attr('src', 'assets/themes/v1/images/general/avatar-blank.png');
            }
        });

        $(document).on("keyup", "#password1", function() {
            var regularExpression = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@$!%*#?&]).{6,12}$/;
            var valid = regularExpression.test(this.value);
            var err_msg = 'Katalaluan hendaklah mengandungi Huruf Besar,Huruf Kecil,Nombor dan Simbol dalam lingkungan 6 hingga 12 aksara';

            if (this.value != "") {
                if (valid == false) {
                    // console.log(this.value + " : " + valid);
                    $("span.err_msg").html(err_msg);
                } else {
                    $("span.err_msg").html("");
                }
            } else {
                $("span.err_msg").html("");
            }

        });

        $("input[id*='ic']").keyup(function() {
            if (this.value.length == this.maxLength) {
                $(this).nextAll('input').first().focus();
            }
        });

        function hide_divs(search) {
            var search_upper = search.toUpperCase();
            $("#container > div").hide();
            $('#container > div[id*="' + search_upper + '"]').show();
        }

        function show_all() {
            $("#container > div").show();
        }



        $('.btn_popup_tambah_peranan_update').click(function() {

            var ppr_id = $(this).data('roleid');
            var pkp_id = $(this).data('id');
            var type = $("#control_checkbox_" + pkp_id + "_" + ppr_id).find(":selected").val();
            var name_string = "penyedia";

            if (type == 1) {
                $(".disabled_1").attr("disabled", false);
                $(".disabled_2").attr("disabled", true);
                $(".disabled_3").attr("disabled", true);
                name_string = "penyedia";
            } else if (type == 2) {
                $(".disabled_1").attr("disabled", true);
                $(".disabled_2").attr("disabled", false);
                $(".disabled_3").attr("disabled", true);
                name_string = "penyemak";
            } else if (type == 3) {
                $(".disabled_1").attr("disabled", true);
                $(".disabled_2").attr("disabled", true);
                $(".disabled_3").attr("disabled", false);
                name_string = "pelulus";
            }

            $("#nama_peranan_id_" + pkp_id + "_" + ppr_id).val(name_string);
        });

    });

    $(document).on('change', '#control_checkbox', function() {
        var type = $(this).find(":selected").val();
        var name_string = "penyedia";

        if (type == 1) {
            $(".disabled_1").attr("disabled", false);
            $(".disabled_2").attr("disabled", true);
            $(".disabled_3").attr("disabled", true);
            name_string = "penyedia";
        } else if (type == 2) {
            $(".disabled_1").attr("disabled", true);
            $(".disabled_2").attr("disabled", false);
            $(".disabled_3").attr("disabled", true);
            name_string = "penyemak";
        } else if (type == 3) {
            $(".disabled_1").attr("disabled", true);
            $(".disabled_2").attr("disabled", true);
            $(".disabled_3").attr("disabled", false);
            name_string = "pelulus";
        }

        $("#nama_peranan_id").val(name_string);

    });

    $(document).on('change', '#control_checkbox_sementara', function() {
        var type = $(this).find(":selected").val();
        var name_string = "penyedia";

        if (type == 1) {
            $(".disabled_1").attr("disabled", false);
            $(".disabled_2").attr("disabled", true);
            $(".disabled_3").attr("disabled", true);
            name_string = "penyedia";
        } else if (type == 2) {
            $(".disabled_1").attr("disabled", true);
            $(".disabled_2").attr("disabled", false);
            $(".disabled_3").attr("disabled", true);
            name_string = "penyemak";
        } else if (type == 3) {
            $(".disabled_1").attr("disabled", true);
            $(".disabled_2").attr("disabled", true);
            $(".disabled_3").attr("disabled", false);
            name_string = "pelulus";
        }

        $("#nama_peranan_sementara_id").val(name_string);
    });

    $(document).on('change', '.control_checkbox_class', function() {
        var type = $(this).find(":selected").val();
        var pkp_id = $(this).data('pkp_id');
        var ppr_id = $(this).data('ppr_id');

        var name_string = "penyedia";

        if (type == 1) {
            $(".disabled_1").attr("disabled", false);
            $(".disabled_2").attr("disabled", true);
            $(".disabled_3").attr("disabled", true);
            name_string = "penyedia";
        } else if (type == 2) {
            $(".disabled_1").attr("disabled", true);
            $(".disabled_2").attr("disabled", false);
            $(".disabled_3").attr("disabled", true);
            name_string = "penyemak";
        } else if (type == 3) {
            $(".disabled_1").attr("disabled", true);
            $(".disabled_2").attr("disabled", true);
            $(".disabled_3").attr("disabled", false);
            name_string = "pelulus";
        }

        $("#nama_peranan_id_" + pkp_id + "_" + ppr_id).val(name_string);
        $("#nama_peranan_id").val(name_string);

    });

    function kemaskini_pengguna_peranan() {
        var type = $("#control_checkbox").find(":selected").text();
        var name_string = "penyedia";

        if (type == 1) {
            $(".disabled_1").attr("disabled", false);
            $(".disabled_2").attr("disabled", true);
            $(".disabled_3").attr("disabled", true);
            name_string = "penyedia";
        } else if (type == 2) {
            $(".disabled_1").attr("disabled", true);
            $(".disabled_2").attr("disabled", false);
            $(".disabled_3").attr("disabled", true);
            name_string = "penyemak";
        } else if (type == 3) {
            $(".disabled_1").attr("disabled", true);
            $(".disabled_2").attr("disabled", true);
            $(".disabled_3").attr("disabled", false);
            name_string = "pelulus";
        }

        $("#nama_peranan_id").val(name_string);
        $(".btn_popup_tambah_peranan").hide();
    }

    function kemaskini_pengguna_peranan_kem() {
        var type = $("#control_checkbox_<?= $v_ptj->pkp_id ?>_<?= $v_ptj->ppr_id ?>").find(":selected").text();
        var name_string = "penyedia";

        if (type == 1) {
            $(".disabled_1").attr("disabled", false);
            $(".disabled_2").attr("disabled", true);
            $(".disabled_3").attr("disabled", true);
            name_string = "penyedia";
        } else if (type == 2) {
            $(".disabled_1").attr("disabled", true);
            $(".disabled_2").attr("disabled", false);
            $(".disabled_3").attr("disabled", true);
            name_string = "penyemak";
        } else if (type == 3) {
            $(".disabled_1").attr("disabled", true);
            $(".disabled_2").attr("disabled", true);
            $(".disabled_3").attr("disabled", false);
            name_string = "pelulus";
        }

        $("#nama_peranan_id").val(name_string);
        $(".btn_popup_tambah_peranan").hide();
    }

    $(document).on("change", "#tarikh_mula_id_sementara_id", function() {
        var dNow = new Date();
        var dMul = new Date(this.value);
        if (dMul < dNow) {

            var month = dNow.getMonth() + 1;
            var day = dNow.getDate();
            var year = dNow.getFullYear();

            if (month < 10)
                month = '0' + month.toString();
            if (day < 10)
                day = '0' + day.toString();
            var minDate = year + '-' + month + '-' + day;

            $("#tarikh_tamat_id_sementara_id").attr("min", minDate);
        } else {

            $("#tarikh_tamat_id_sementara_id").attr("min", this.value);
        }

    });

    $(document).on("change", "#tarikh_tamat_id_sementara_id", function() {
        $("#tarikh_tamat").attr("max", this.value);
    });

    $(document).on("click", '#tarikh_mula', function() {
        var tarikh_mula_sem = $("#tarikh_mula_id_sementara_id").val();
        var tarikh_tamat_sem = $("#tarikh_tamat_id_sementara_id").val();

        if (tarikh_mula_sem == "") {
            var dtMin = new Date();
        } else {
            var dtMin = new Date(tarikh_mula_sem);
        }

        var month = dtMin.getMonth() + 1;
        var day = dtMin.getDate();
        var year = dtMin.getFullYear();

        if (month < 10)
            month = '0' + month.toString();
        if (day < 10)
            day = '0' + day.toString();
        var minDate = year + '-' + month + '-' + day;

        $('#tarikh_mula').attr('min', minDate);

        if (tarikh_tamat_sem == "") {
            var dtMax = new Date();
        } else {
            var dtMax = new Date(tarikh_tamat_sem);
        }

        var month = dtMax.getMonth() + 1;
        var day = dtMax.getDate();
        var year = dtMax.getFullYear();

        if (month < 10)
            month = '0' + month.toString();
        if (day < 10)
            day = '0' + day.toString();
        var maxDate = year + '-' + month + '-' + day;

        if (tarikh_tamat_sem != "") {
            $('#tarikh_mula').attr('max', maxDate);
        }else{
            $("#tarikh_tamat").attr("max", null);
            $("#tarikh_tamat").attr("min", null);

            $("#tarikh_mula").attr("max", null);
            $("#tarikh_mula").attr("min", null);
		}

    });

    $(document).on("click", '#tarikh_tamat', function() {
        var tarikh_mula_sem = $("#tarikh_mula_id_sementara_id").val();
        var tarikh_tamat_sem = $("#tarikh_tamat_id_sementara_id").val();
        var tarikh_mula = $("#tarikh_mula").val();

        if (tarikh_mula_sem == "") {
            if (tarikh_mula == "") {
                var dtMin = new Date();
            } else {
                var dtMin = new Date(tarikh_mula);
            }
        } else {
            if (tarikh_mula == "") {
                var dtMin = new Date(tarikh_mula_sem);
            } else {
                var dtNow = new Date();

                var dtMin = new Date(tarikh_mula);
                if (dtMin < dtNow) {
                    dtMin = new Date();
                }
            }
        }

        var month = dtMin.getMonth() + 1;
        var day = dtMin.getDate();
        var year = dtMin.getFullYear();

        if (month < 10)
            month = '0' + month.toString();
        if (day < 10)
            day = '0' + day.toString();
        var minDate = year + '-' + month + '-' + day;

        $('#tarikh_tamat').attr('min', minDate);

        if (tarikh_tamat_sem == "") {
            var dtMax = new Date();
        } else {
            var dateNow = new Date();
            var dtMax = new Date(tarikh_tamat_sem);

            if (dtMax < dateNow) {
                dtMax = new Date();
            }
        }

        var month = dtMax.getMonth() + 1;
        var day = dtMax.getDate();
        var year = dtMax.getFullYear();

        if (month < 10)
            month = '0' + month.toString();
        if (day < 10)
            day = '0' + day.toString();
        var maxDate = year + '-' + month + '-' + day;

        if (tarikh_tamat_sem != "") {
            var dNow = new Date();
            var dMax = new Date(tarikh_tamat_sem);

            if (dNow > dMax) {
                var month = dNow.getMonth() + 1;
                var day = dNow.getDate();
                var year = dNow.getFullYear();

                if (month < 10)
                    month = '0' + month.toString();
                if (day < 10)
                    day = '0' + day.toString();
                var maxDate = year + '-' + month + '-' + day;

                $('#tarikh_tamat').attr('max', maxDate);
            } else {

                $('#tarikh_tamat').attr('max', maxDate);
            }
        }

    });

    // $(document).on("click", '#tarikh_tamat', function(){
    //
    //     var dtToday = new Date();
    //
    //     var month = dtToday.getMonth() + 1;
    //     var day = dtToday.getDate();
    //     var year = dtToday.getFullYear();
    //
    //     if(month < 10)
    //         month = '0' + month.toString();
    //     if(day < 10)
    //         day = '0' + day.toString();
    //
    //     var maxDate = year + '-' + month + '-' + day;
    //     $('#tarikh_tamat').attr('min', maxDate);
    // });


    $(document).on("click", '.tarikh_tamat', function() {
        var dtToday = new Date();

        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();

        if (month < 10)
            month = '0' + month.toString();
        if (day < 10)
            day = '0' + day.toString();

        var maxDate = year + '-' + month + '-' + day;
        $('.tarikh_tamat').attr('min', maxDate);
    });

    $(document).on('click', '.aktifkan_as_date', function() {

        $("#role_sementara_id").val($(this).data('id'));
        $("#user_id").val($(this).data('userid'));
        $('#updateTarikhTamat').modal('show');
    });

    $(document).on('click', '#simpan_date_as', function() {
        $('#form_submit_data_update_as').submit();
    });

    function color() {
        $("input[type=checkbox]").each(function(idx, elem) {
            var is_checked = $(this).prop("checked");
            console.log(is_checked);

            if (is_checked == true) {
                $(this).parent().removeClass("border-checkbox-group-inverse");
                $(this).parent().addClass("border-checkbox-group-primary");
            } else {
                $(this).parent().removeClass("border-checkbox-group-primary");
                $(this).parent().addClass("border-checkbox-group-inverse");

            }
        });
    }
</script>
