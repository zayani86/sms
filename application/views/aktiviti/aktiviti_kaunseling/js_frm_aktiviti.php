<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<script type="text/javascript">
    'use strict';
    window.onload = function magicStick(){
        let kategori_id = $('#kategori_id').val();
        mainMagicStick(kategori_id);
        pendekatanMagicStick();
        focusMagicStick();
        programMagicStick(kategori_id);
        triggeredTingkatan();
    };

    function mainMagicStick(kategori_id){

        let mode = $("#mode_id").val();
        
        $.ajax({
            data: {kategori: kategori_id},
            type: "GET",
            url: "<?=base_url('aktiviti/aktiviti_kaunseling/aktiviti_controller/ajax_get_jenis_sesi') . url_akses()?>",
            dataType: "JSON",
            success: function (data) {
                
                if (data.kategori != null) {
                    for(var key in data.kategori)
                    {
                        if (data.id != null) {
                            
                            if(kategori_id == 7000)
                            {
                                $('.is_hide_7004').attr('style', 'display:none');
                                $('.is_hide_7001').removeAttr('style');
                                $('.is_hide_7002').removeAttr('style');
                                $('.is_hide_7003').attr('style', 'display:none');
                                $('.is_hide_7007').attr('style', 'display:none');
                                $('.is_hide_7006').removeAttr('style');
                                
                                $('.lain_lain_program_class').attr('style', 'display:none');

                                if(key == 'INDIVIDU')
                                {
                                    let jenisSesi = $(".jenis_sesi");
                                    let selected_value_jenis_sesi = null;

                                    if(mode == 'update')
                                    {
                                        selected_value_jenis_sesi = jenisSesi.val();
                                    }

                                    //remove old options
                                    jenisSesi.empty();
                                    jenisSesi.append($("<option></option>").attr("value", '').text('-Sila Pilih-'));
                                    var num = 0;
                                    if( selected_value_jenis_sesi == null)
                                        $(".jenis_sesi").attr("value", 0).attr("selected", true);

                                    $(".jenis_sesi").trigger('change');

                                    $.each(data.id[key], function () {

                                        if(data.id[key][num] == selected_value_jenis_sesi)
                                        {
                                            jenisSesi.append($("<option></option>").attr("value", data.id[key][num]).attr("selected", true).text(data.keterangan[key][num]));
                                        }
                                        else
                                        {
                                            jenisSesi.append($("<option></option>").attr("value", data.id[key][num]).text(data.keterangan[key][num]));
                                        }
                                        
                                        num++;
                                    });
                                } 
                                else if(key == 'SASARAN')
                                {
                                    let sasaran = $(".sasaran");
                                    let selected_value_sasaran = null;

                                    if(mode == 'update')
                                    {
                                        selected_value_sasaran = sasaran.val();
                                    }
                                    //remove old options
                                    sasaran.empty();
                                    sasaran.append($("<option></option>").attr("value", '').text('-Sila Pilih-'));
                                    var num = 0;

                                    if( selected_value_sasaran == null)
                                        $(".sasaran").attr("value", 0).attr("selected", true);

                                    $(".sasaran").trigger('change');

                                    $.each(data.id[key], function () {
                                        if(data.id[key][num] == selected_value_sasaran)
                                        {
                                            sasaran.append($("<option></option>").attr("value", data.id[key][num]).attr("selected", true).text(data.keterangan[key][num]));
                                        }
                                        else
                                        {
                                            sasaran.append($("<option></option>").attr("value", data.id[key][num]).text(data.keterangan[key][num]));
                                        }
                                        num++;
                                    });
                                }
                                else if(key == 'PENDEKATAN')
                                {
                                    let pendekatan = $(".pendekatan");
                                    let selected_value_pendekatan = null;

                                    if(mode == 'update')
                                    {
                                        selected_value_pendekatan = pendekatan.val();
                                    }

                                    //remove old options
                                    pendekatan.empty();
                                    pendekatan.append($("<option></option>").attr("value", '').text('-Sila Pilih-'));
                                    var num = 0;

                                    if( selected_value_pendekatan == null)
                                        $(".pendekatan").attr("value", 0).attr("selected", true);

                                    $(".pendekatan").trigger('change');

                                    $.each(data.id[key], function () {
                                        if(data.id[key][num] == selected_value_pendekatan)
                                        {
                                            pendekatan.append($("<option></option>").attr("value", data.id[key][num]).attr("selected", true).text(data.keterangan[key][num]));
                                        }
                                        else
                                        {
                                            pendekatan.append($("<option></option>").attr("value", data.id[key][num]).text(data.keterangan[key][num]));
                                        }
                                        num++;
                                    });
                                }
                                
                            } 
                            else if (kategori_id == 7001)
                            {
                                $('.is_hide_7002').removeAttr('style');
                                $('.is_hide_7001').attr('style', 'display:none');
                                $('.is_hide_7003').attr('style', 'display:none');
                                $('.is_hide_7004').attr('style', 'display:none');
                                $('.lain_lain_program_class').attr('style', 'display:none');
                                $('.is_hide_7007').attr('style', 'display:none');
                                $('.is_hide_7006').removeAttr('style');

                                let jenisSesi = $(".jenis_sesi");
                                let selected_value_jenis_sesi = null;
                                
                                if(mode == 'update')
                                {
                                    selected_value_jenis_sesi = $("#jenis_sesi_oth").val();
                                }
                                
                                //remove old options
                                jenisSesi.empty();
                                jenisSesi.append($("<option></option>").attr("value", '').text('-Sila Pilih-'));
                                var num = 0;

                                if( selected_value_jenis_sesi == null)
                                    $(".jenis_sesi").attr("value", 0).attr("selected", true);
                                $(".jenis_sesi").trigger('change');

                                $.each(data.id[key], function () {
                                    if(data.id[key][num] == selected_value_jenis_sesi)
                                    {
                                        jenisSesi.append($("<option></option>").attr("value", data.id[key][num]).attr("selected", true).text(data.keterangan[key][num]));
                                    }
                                    else
                                    {
                                        jenisSesi.append($("<option></option>").attr("value", data.id[key][num]).text(data.keterangan[key][num]));
                                    }
                                    num++;
                                });
                            }
                            else if (kategori_id == 7002)
                            {
                                
                                $('.is_hide_7002').attr('style', 'display:none');
                                $('.is_hide_7003').removeAttr('style');
                                $('.is_hide_7004').attr('style', 'display:none');
                                $('.is_hide_7005').attr('style', 'display:none');
                                $('.lain_lain_program_class').attr('style', 'display:none');
                                $('.is_hide_7007').attr('style', 'display:none');
                                $('.is_hide_7006').removeAttr('style');

                                let program = $(".program");
                                //remove old options
                                program.empty();
                                program.append($("<option></option>").attr("value", '').text('-Sila Pilih-'));
                                var num = 0;

                                $(".program").attr("value", 0).attr("selected", true);
                                $(".program").trigger('change');

                                $.each(data.id[key], function () {
                                    program.append($("<option></option>").attr("value", data.id[key][num]).text(data.keterangan[key][num]));
                                    num++;
                                });
                            }
                            else if (kategori_id == 7003)
                            {
                                
                                $('.is_hide_7002').attr('style', 'display:none');
                                $('.is_hide_7003').attr('style', 'display:none');
                                $('.lain_lain_program_class').attr('style', 'display:none');
                                $('.is_hide_7005').attr('style', 'display:none');
                                $('.is_hide_7007').attr('style', 'display:none');
                                $('.is_hide_7004').removeAttr('style');
                                // $('.is_hide_7006').removeAttr('style');

                                let jenisSesi = $(".sasaran");
                                let selected_value_jenis_sesi = null;
                                let sasaran_id = $("#sasaran_id").val();
                                
                                if(mode == 'update')
                                {
                                    selected_value_jenis_sesi = sasaran_id;
                                }
                                
                                //remove old options
                                jenisSesi.empty();
                                jenisSesi.append($("<option></option>").attr("value", '').text('-Sila Pilih-'));
                                var num = 0;

                                if( selected_value_jenis_sesi == null)
                                    $(".sasaran").attr("value", 0).attr("selected", true);
                                $(".sasaran").trigger('change');

                                $.each(data.id[key], function () {
                                    if(data.id[key][num] == selected_value_jenis_sesi)
                                    {
                                        jenisSesi.append($("<option></option>").attr("value", data.id[key][num]).attr("selected", true).text(data.keterangan[key][num]));
                                    }
                                    else
                                    {
                                        jenisSesi.append($("<option></option>").attr("value", data.id[key][num]).text(data.keterangan[key][num]));
                                    }
                                    num++;
                                });
                            }
                            else if (kategori_id == 7004)
                            {
                                
                                $('.is_hide_7002').attr('style', 'display:none');
                                $('.is_hide_7003').attr('style', 'display:none');
                                $('.lain_lain_program_class').attr('style', 'display:none');
                                $('.is_hide_7004').attr('style', 'display:none');
                                $('.is_hide_7007').attr('style', 'display:none');
                                $('.is_hide_7005').removeAttr('style');
                                $('.is_hide_7006').removeAttr('style');

                                let jenisSesi = $(".klien");
                                let klien_id = $("#klien_id").val();
                                let selected_value_jenis_sesi = null;

                                if(mode == 'update')
                                {
                                    selected_value_jenis_sesi = klien_id;
                                }
                                //remove old options
                                jenisSesi.empty();
                                jenisSesi.append($("<option></option>").attr("value", '').text('-Sila Pilih-'));
                                var num = 0;

                                if(selected_value_jenis_sesi == null)
                                    $(".klien").attr("value", 0).attr("selected", true);
                                $(".klien").trigger('change');

                                $.each(data.id[key], function () {
                                    if(data.id[key][num] == selected_value_jenis_sesi)
                                    {
                                        jenisSesi.append($("<option></option>").attr("value", data.id[key][num]).attr("selected", true).text(data.keterangan[key][num]));
                                    }
                                    else
                                    {
                                        jenisSesi.append($("<option></option>").attr("value", data.id[key][num]).text(data.keterangan[key][num]));
                                    }
                                    num++;
                                });
                            }
                            else if (kategori_id == 7005)
                            {
                                
                                $('.is_hide_7002').attr('style', 'display:none');
                                $('.is_hide_7003').attr('style', 'display:none');
                                $('.lain_lain_program_class').attr('style', 'display:none');
                                $('.is_hide_7004').attr('style', 'display:none');
                                $('.is_hide_7005').attr('style', 'display:none');
                                $('.is_hide_7006').attr('style', 'display:none');
                                $('.is_hide_7007').removeAttr('style');

                                let jenisSesi = $(".klien");
                                //remove old options
                                jenisSesi.empty();
                                jenisSesi.append($("<option></option>").attr("value", '').text('-Sila Pilih-'));
                                var num = 0;

                                $(".klien").attr("value", 0).attr("selected", true);
                                $(".klien").trigger('change');

                                $.each(data.id[key], function () {
                                    jenisSesi.append($("<option></option>").attr("value", data.id[key][num]).text(data.keterangan[key][num]));
                                    num++;
                                });
                            }
                            
                            
                        }
                    }
                }
                else
                {
                    let jenisSesi = $(".jenis_sesi");
                    let sasaran = $(".sasaran");
                    let pendekatan = $(".pendekatan");

                    jenisSesi.empty();
                    jenisSesi.append($("<option></option>").attr("value", '').text('-Sila Pilih-'));
                    sasaran.empty();
                    sasaran.append($("<option></option>").attr("value", '').text('-Sila Pilih-'));
                    pendekatan.empty();
                    pendekatan.append($("<option></option").attr("value", '').text('-Sila Pilih-'));
                }
            }
        });
    }

    function pendekatanMagicStick()
    {
        let jenis_perkhidmatan_id = $('#jenis_perkhidmatan_id :selected').val();
        let mode = $("#mode_id").val();

        if(jenis_perkhidmatan_id == 6833)
        {
            $('.sub_focus').removeAttr('style');
        }
        else
        {
            $('.sub_focus').attr('style', 'display:none');
        }

        $.ajax({
            data: {kategori: jenis_perkhidmatan_id},
            type: "GET",
            url: "<?=base_url('aktiviti/aktiviti_kaunseling/aktiviti_controller/ajax_get_jenis_sesi') . url_akses()?>",
            dataType: "JSON",
            success: function (data) {

                if (data.kategori != null) {
                    for(var key in data.kategori)
                    {
                        if (data.id != null) {
                            let focus = $(".focus");
                            let selected_value_jenis_focus  = null;
                            if(mode == 'update')
                            {
                                selected_value_jenis_focus = focus.val();
                            }

                            //remove old options
                            focus.empty();
                            focus.append($("<option></option>").attr("value", '').text('-Sila Pilih--'));
                            var num = 0;

                            if( selected_value_jenis_focus == null)
                                $(".focus").attr("value", 0).attr("selected", true);
                            

                            $.each(data.id[key], function () {

                                if(data.id[key][num] == selected_value_jenis_focus)
                                {
                                    focus.append($("<option></option>").attr("value", data.id[key][num]).attr("selected", true).text(data.keterangan[key][num]));
                                }
                                else
                                {
                                    focus.append($("<option></option>").attr("value", data.id[key][num]).text(data.keterangan[key][num]));
                                }
                                num++;
                            });
                        }
                    }
                }
                else
                {
                    let focus = $(".focus");
                    focus.empty();
                    focus.append($("<option></option").attr("value", '').text('-Sila Pilih-'));
                }
            }
        });
    }

    function focusMagicStick()
    {
        let focus_id = $('.focus :selected').val();
        let mode = $("#mode_id").val();
        
        $.ajax({
            data: {kategori: focus_id},
            type: "GET",
            url: "<?=base_url('aktiviti/aktiviti_kaunseling/aktiviti_controller/ajax_get_jenis_sesi') . url_akses()?>",
            dataType: "JSON",
            success: function (data) {
                
                if (data.kategori != null) {
                    
                    for(var key in data.kategori)
                    {
                        
                        if (data.id != null) {
                            
                            let focus_sub = $(".focus_sub");
                            let selected_value_jenis_focus_sub = null;

                            if(mode == 'update')
                            {
                                selected_value_jenis_focus_sub = focus_sub.val();
                            }
                            
                            //remove old options
                            focus_sub.empty();
                            focus_sub.append($("<option></option>").attr("value", '').text('-Sila Pilih-@'));
                            var num = 0;

                            if( selected_value_jenis_focus_sub == null)
                                $(".focus_sub").attr("value", 0).attr("selected", true);
                            $(".focus_sub").trigger('change');

                            $.each(data.id[key], function () {
                                
                                if(data.id[key][num] == selected_value_jenis_focus_sub)
                                {
                                    focus_sub.append($("<option></option>").attr("value", data.id[key][num]).attr("selected", true).text(data.keterangan[key][num]));
                                }
                                else
                                {
                                    focus_sub.append($("<option></option>").attr("value", data.id[key][num]).text(data.keterangan[key][num]));
                                }
                                num++;
                            });
                            
                        }
                    }
                }
                else
                {
                    let focus_sub = $(".focus_sub");
                    
                    focus_sub.empty();
                    focus_sub.append($("<option></option").attr("value", '').text('-Sila Pilih-'));
                }
            }
        });
    }

    function programMagicStick(kategori_id)
    {
        let mode = $("#mode_id").val();
        let program_id = $("#program_id").val();

        if(kategori_id == 7146)
        {
            $('.lain_lain_program_class').removeAttr('style');
        }
        else
        {
            $('.lain_lain_program_class').attr('style', 'display:none');
        }
        
        $.ajax({
            data: {kategori: kategori_id},
            type: "GET",
            url: "<?=base_url('aktiviti/aktiviti_kaunseling/aktiviti_controller/ajax_get_jenis_sesi') . url_akses()?>",
            dataType: "JSON",
            success: function (data) {
                
                if (data.kategori != null) {
                    
                    for(var key in data.kategori)
                    {
                        
                        if (data.id != null) {
                            
                            let program = $(".program");
                            let selected_value_program = null;

                            if(mode == 'update')
                            {
                                selected_value_program = program_id;
                            }
                            
                            //remove old options
                            program.empty();
                            program.append($("<option></option>").attr("value", '').text('-Sila Pilih-'));
                            var num = 0;

                            if( selected_value_program == null)
                                $(".program").attr("value", 0).attr("selected", true);
                            $(".program").trigger('change');

                            $.each(data.id[key], function () {
                                
                                if(data.id[key][num] == selected_value_program)
                                {
                                    program.append($("<option></option>").attr("value", data.id[key][num]).attr("selected", true).text(data.keterangan[key][num]));
                                }
                                else
                                {
                                    program.append($("<option></option>").attr("value", data.id[key][num]).text(data.keterangan[key][num]));
                                }
                                num++;
                            });
                            
                        }
                    }
                }
                else
                {
                    let program = $(".program");
                    
                    program.empty();
                    program.append($("<option></option").attr("value", '').text('-Sila Pilih-'));
                }
            }
        });
    }

    function triggeredTingkatan()
    {
        let kelas_id = $("#kelas_id").val();
        let tingkatan_tahun = $('#nama_tingkatan :selected').val();
        let mode = $("#mode_id").val();
        
        $.ajax({
            data: {kategori: tingkatan_tahun},
            type: "GET",
            url: "<?=base_url('aktiviti/aktiviti_kaunseling/aktiviti_controller/get_kelas_nama_tingkatan') . url_akses()?>",
            dataType: "JSON",
            success: function (data) {

                if (data.id != null) {
                    let kelas = $(".kelas_class");
                    let selected_value_kelas = null;

                    if(mode == 'update')
                    {
                        selected_value_kelas = kelas_id;
                    }
                    //remove old options
                    kelas.empty();
                    kelas.append($("<option></option>").attr("value", '').text('-Sila Pilih-'));
                    var num = 0;
                    
                    if( selected_value_kelas == null)
                        $(".kelas_class").attr("value", 0).attr("selected", true);
                    

                    $.each(data.id, function () {
                        
                        if(data.id[num] == selected_value_kelas)
                        {
                            kelas.append($("<option></option>").attr("value", data.id[num]).attr("selected", true).text(data.nama_kelas[num]));
                        }
                        else
                        {
                            kelas.append($("<option></option>").attr("value", data.id[num]).text(data.nama_kelas[num]));
                        }
                        num++;
                    });
                }
                else
                {
                    let kelas = $(".kelas_class");
                    kelas.empty();
                    kelas.append($("<option></option").attr("value", '').text('-Sila Pilih-'));
                }
            }
        });
    }

    $(document).ready(function(){

        $('#kategori_id').on('change', function() {
            let kategori_id = $('#kategori_id :selected').val();
            
            $.ajax({
                data: {kategori: kategori_id},
                type: "GET",
                url: "<?=base_url('aktiviti/aktiviti_kaunseling/aktiviti_controller/ajax_get_jenis_sesi') . url_akses()?>",
                dataType: "JSON",
                success: function (data) {
                    
                    if (data.kategori != null) {
                        for(var key in data.kategori)
                        {
                            if (data.id != null) {
                                
                                if(kategori_id == 7000)
                                {
                                    $('.is_hide_7004').attr('style', 'display:none');
                                    $('.is_hide_7001').removeAttr('style');
                                    $('.is_hide_7002').removeAttr('style');
                                    $('.is_hide_7003').attr('style', 'display:none');
                                    $('.is_hide_7007').attr('style', 'display:none');
                                    $('.is_hide_7006').removeAttr('style');
                                    
                                    $('.lain_lain_program_class').attr('style', 'display:none');

                                    if(key == 'INDIVIDU')
                                    {
                                        let jenisSesi = $(".jenis_sesi");
                                        //remove old options
                                        jenisSesi.empty();
                                        jenisSesi.append($("<option></option>").attr("value", '').text('-Sila Pilih-'));
                                        var num = 0;

                                        $(".jenis_sesi").attr("value", 0).attr("selected", true);
                                        $(".jenis_sesi").trigger('change');

                                        $.each(data.id[key], function () {
                                            jenisSesi.append($("<option></option>").attr("value", data.id[key][num]).text(data.keterangan[key][num]));
                                            num++;
                                        });
                                    } 
                                    else if(key == 'SASARAN')
                                    {
                                        let sasaran = $(".sasaran");
                                        //remove old options
                                        sasaran.empty();
                                        sasaran.append($("<option></option>").attr("value", '').text('-Sila Pilih-'));
                                        var num = 0;

                                        $(".sasaran").attr("value", 0).attr("selected", true);
                                        $(".sasaran").trigger('change');

                                        $.each(data.id[key], function () {
                                            sasaran.append($("<option></option>").attr("value", data.id[key][num]).text(data.keterangan[key][num]));
                                            num++;
                                        });
                                    }
                                    else if(key == 'PENDEKATAN')
                                    {
                                        let pendekatan = $(".pendekatan");
                                        //remove old options
                                        pendekatan.empty();
                                        pendekatan.append($("<option></option>").attr("value", '').text('-Sila Pilih-'));
                                        var num = 0;

                                        $(".pendekatan").attr("value", 0).attr("selected", true);
                                        $(".pendekatan").trigger('change');

                                        $.each(data.id[key], function () {
                                            pendekatan.append($("<option></option>").attr("value", data.id[key][num]).text(data.keterangan[key][num]));
                                            num++;
                                        });
                                    }
                                    
                                } 
                                else if (kategori_id == 7001)
                                {
                                    $('.is_hide_7002').removeAttr('style');
                                    $('.is_hide_7001').attr('style', 'display:none');
                                    $('.is_hide_7003').attr('style', 'display:none');
                                    $('.is_hide_7004').attr('style', 'display:none');
                                    $('.lain_lain_program_class').attr('style', 'display:none');
                                    $('.is_hide_7007').attr('style', 'display:none');
                                    $('.is_hide_7006').removeAttr('style');

                                    let jenisSesi = $(".jenis_sesi");
                                    //remove old options
                                    jenisSesi.empty();
                                    jenisSesi.append($("<option></option>").attr("value", '').text('-Sila Pilih-'));
                                    var num = 0;

                                    $(".jenis_sesi").attr("value", 0).attr("selected", true);
                                    $(".jenis_sesi").trigger('change');

                                    $.each(data.id[key], function () {
                                        jenisSesi.append($("<option></option>").attr("value", data.id[key][num]).text(data.keterangan[key][num]));
                                        num++;
                                    });
                                }
                                else if (kategori_id == 7002)
                                {
                                    
                                    $('.is_hide_7002').attr('style', 'display:none');
                                    $('.is_hide_7003').removeAttr('style');
                                    $('.is_hide_7004').attr('style', 'display:none');
                                    $('.is_hide_7005').attr('style', 'display:none');
                                    $('.lain_lain_program_class').attr('style', 'display:none');
                                    $('.is_hide_7007').attr('style', 'display:none');
                                    $('.is_hide_7006').removeAttr('style');

                                    let program = $(".program");
                                    //remove old options
                                    program.empty();
                                    program.append($("<option></option>").attr("value", '').text('-Sila Pilih-'));
                                    var num = 0;

                                    $(".program").attr("value", 0).attr("selected", true);
                                    $(".program").trigger('change');

                                    $.each(data.id[key], function () {
                                        program.append($("<option></option>").attr("value", data.id[key][num]).text(data.keterangan[key][num]));
                                        num++;
                                    });
                                }
                                else if (kategori_id == 7003)
                                {
                                    
                                    $('.is_hide_7002').attr('style', 'display:none');
                                    $('.is_hide_7003').attr('style', 'display:none');
                                    $('.lain_lain_program_class').attr('style', 'display:none');
                                    $('.is_hide_7005').attr('style', 'display:none');
                                    $('.is_hide_7007').attr('style', 'display:none');
                                    $('.is_hide_7004').removeAttr('style');
                                    $('.is_hide_7006').removeAttr('style');

                                    let jenisSesi = $(".sasaran");
                                    //remove old options
                                    jenisSesi.empty();
                                    jenisSesi.append($("<option></option>").attr("value", '').text('-Sila Pilih-'));
                                    var num = 0;

                                    $(".sasaran").attr("value", 0).attr("selected", true);
                                    $(".sasaran").trigger('change');

                                    $.each(data.id[key], function () {
                                        jenisSesi.append($("<option></option>").attr("value", data.id[key][num]).text(data.keterangan[key][num]));
                                        num++;
                                    });
                                }
                                else if (kategori_id == 7004)
                                {
                                    
                                    $('.is_hide_7002').attr('style', 'display:none');
                                    $('.is_hide_7003').attr('style', 'display:none');
                                    $('.lain_lain_program_class').attr('style', 'display:none');
                                    $('.is_hide_7004').attr('style', 'display:none');
                                    $('.is_hide_7007').attr('style', 'display:none');
                                    $('.is_hide_7005').removeAttr('style');
                                    $('.is_hide_7006').removeAttr('style');

                                    let jenisSesi = $(".klien");
                                    //remove old options
                                    jenisSesi.empty();
                                    jenisSesi.append($("<option></option>").attr("value", '').text('-Sila Pilih-'));
                                    var num = 0;

                                    $(".klien").attr("value", 0).attr("selected", true);
                                    $(".klien").trigger('change');

                                    $.each(data.id[key], function () {
                                        jenisSesi.append($("<option></option>").attr("value", data.id[key][num]).text(data.keterangan[key][num]));
                                        num++;
                                    });
                                }
                                else if (kategori_id == 7005)
                                {
                                    
                                    $('.is_hide_7002').attr('style', 'display:none');
                                    $('.is_hide_7003').attr('style', 'display:none');
                                    $('.lain_lain_program_class').attr('style', 'display:none');
                                    $('.is_hide_7004').attr('style', 'display:none');
                                    $('.is_hide_7005').attr('style', 'display:none');
                                    $('.is_hide_7006').attr('style', 'display:none');
                                    $('.is_hide_7007').removeAttr('style');

                                    let jenisSesi = $(".klien");
                                    //remove old options
                                    jenisSesi.empty();
                                    jenisSesi.append($("<option></option>").attr("value", '').text('-Sila Pilih-'));
                                    var num = 0;

                                    $(".klien").attr("value", 0).attr("selected", true);
                                    $(".klien").trigger('change');

                                    $.each(data.id[key], function () {
                                        jenisSesi.append($("<option></option>").attr("value", data.id[key][num]).text(data.keterangan[key][num]));
                                        num++;
                                    });
                                }
                                
                                
                            }
                        }
                    }
                    else
                    {
                        let jenisSesi = $(".jenis_sesi");
                        let sasaran = $(".sasaran");
                        let pendekatan = $(".pendekatan");

                        jenisSesi.empty();
                        jenisSesi.append($("<option></option>").attr("value", '').text('-Sila Pilih-'));
                        sasaran.empty();
                        sasaran.append($("<option></option>").attr("value", '').text('-Sila Pilih-'));
                        pendekatan.empty();
                        pendekatan.append($("<option></option").attr("value", '').text('-Sila Pilih-'));
                    }
                }
            });
        });

        $("#jenis_perkhidmatan_id").on('change', function(){
            let jenis_perkhidmatan_id = $('#jenis_perkhidmatan_id :selected').val();

            if(jenis_perkhidmatan_id == 6833)
            {
                $('.sub_focus').removeAttr('style');
            }
            else
            {
                $('.sub_focus').attr('style', 'display:none');
            }

            $.ajax({
                data: {kategori: jenis_perkhidmatan_id},
                type: "GET",
                url: "<?=base_url('aktiviti/aktiviti_kaunseling/aktiviti_controller/ajax_get_jenis_sesi') . url_akses()?>",
                dataType: "JSON",
                success: function (data) {

                    if (data.kategori != null) {
                        for(var key in data.kategori)
                        {
                            if (data.id != null) {
                                let focus = $(".focus");
                                //remove old options
                                focus.empty();
                                focus.append($("<option></option>").attr("value", '').text('-Sila Pilih-'));
                                var num = 0;

                                $(".focus").attr("value", 0).attr("selected", true);
                                $(".focus").trigger('change');

                                $.each(data.id[key], function () {
                                    focus.append($("<option></option>").attr("value", data.id[key][num]).text(data.keterangan[key][num]));
                                    num++;
                                });
                            }
                        }
                    }
                    else
                    {
                        let focus = $(".focus");
                        focus.empty();
                        focus.append($("<option></option").attr("value", '').text('-Sila Pilih-'));
                    }
                }
            });
        });

        $(".focus").on('change', function(){
            let focus_id = $('.focus :selected').val();

            $.ajax({
                data: {kategori: focus_id},
                type: "GET",
                url: "<?=base_url('aktiviti/aktiviti_kaunseling/aktiviti_controller/ajax_get_jenis_sesi') . url_akses()?>",
                dataType: "JSON",
                success: function (data) {

                    if (data.kategori != null) {
                        for(var key in data.kategori)
                        {
                            if (data.id != null) {
                                let focus_sub = $(".focus_sub");
                                //remove old options
                                focus_sub.empty();
                                focus_sub.append($("<option></option>").attr("value", '').text('-Sila Pilih-'));
                                var num = 0;

                                $(".focus_sub").attr("value", 0).attr("selected", true);
                                $(".focus_sub").trigger('change');

                                $.each(data.id[key], function () {
                                    focus_sub.append($("<option></option>").attr("value", data.id[key][num]).text(data.keterangan[key][num]));
                                    num++;
                                });
                            }
                        }
                    }
                    else
                    {
                        let focus_sub = $(".focus_sub");
                        focus_sub.empty();
                        focus_sub.append($("<option></option").attr("value", '').text('-Sila Pilih-'));
                    }
                }
            });
        });

        $('.program').on('change', function(){
            let jenis_program_id = $('.program :selected').val();

            if(jenis_program_id == 7146)
            {
                $('.lain_lain_program_class').removeAttr('style');
            }
            else
            {
                $('.lain_lain_program_class').attr('style', 'display:none');
            }
        });

        $('#nama_tingkatan').on('change', function(){
            let tingkatan_tahun = $('#nama_tingkatan :selected').val();
            
            $.ajax({
                data: {kategori: tingkatan_tahun},
                type: "GET",
                url: "<?=base_url('aktiviti/aktiviti_kaunseling/aktiviti_controller/get_kelas_nama_tingkatan') . url_akses()?>",
                dataType: "JSON",
                success: function (data) {

                    if (data.id != null) {
                        let kelas = $(".kelas_class");
                        //remove old options
                        kelas.empty();
                        kelas.append($("<option></option>").attr("value", '').text('-Sila Pilih-'));
                        var num = 0;

                        $(".kelas_class").attr("value", 0).attr("selected", true);
                        $(".kelas_class").trigger('change');

                        $.each(data.id, function () {
                            kelas.append($("<option></option>").attr("value", data.id[num]).text(data.nama_kelas[num]));
                            num++;
                        });
                    }
                    else
                    {
                        let kelas = $(".kelas_class");
                        kelas.empty();
                        kelas.append($("<option></option").attr("value", '').text('-Sila Pilih-'));
                    }
                }
            });
        });

        
    });

    $(document).on('click', 'a.removemurid', function() {
        let aktiviti_murid = $(this).data("id");
        
        swal({
            html: "Anda pasti untuk hapuskan rekod ini?",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya",
            cancelButtonText: "Tidak",
            allowOutsideClick: false
        }).then((result) => {
            if (result.value) {

                $.ajax({
                    data: {aktiviti_murid_id: aktiviti_murid},
                    type: "GET",
                    url: "<?=base_url('aktiviti/aktiviti_kaunseling/aktiviti_controller/ajax_delete') . url_akses()?>",
                    dataType: "JSON",
                    success: function (data) {

                    }
                });

                $(this).closest('tr').remove();
                $(".btn_popup_tambah_peranan").show();

                $("#list_table_murid tbody tr").each(function(i) {
                    $($(this).find('td')[0]).html(i + 1);
                });

                if ($("#list_table_murid tbody tr").length == 0) {
                    $("#list_table_murid tbody").append("<tr id='list_table_peranan_empty'><td colspan='3' class='text-center'>Tiada Rekod.</td></tr>");
                }
                
                return false;
            }
        })

    });
</script>

