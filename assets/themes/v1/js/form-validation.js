  'use strict';
  
    $(document).ready(function () {
        $('#btn-formwizard_ajaxstandard_reset').click(function () { //button reset event click
            $('.form-control').removeClass('form-control-danger');
            $('.input-group').removeClass('input-group-danger');
            $('.error_message').remove();
            $('#formwizard_ajaxstandard')[0].reset();
        });

        $('#formwizard_ajaxstandard').submit(function (event) {
            event.preventDefault();
            // Swal({
            //     title: 'Perhatian!',
            //     text: 'Adakah anda pasti untuk ke skrin seterusnya?',
            //     type: 'warning',
            //     showCancelButton: true,
            //     cancelButtonText: 'Tidak',
            //     confirmButtonText: 'Ya',
            //     reverseButtons: true

            // }).then((result) => {
            //     if (result.value) {

                    $.ajax({
                        url: $('#formwizard_ajaxstandard').attr("action"),
                        type: "post",
                        data: new FormData($("#formwizard_ajaxstandard")[0]),
                        datatype: "json",
                        async: true,
                        processData: false,
                        contentType: false,
                        beforeSend: function () {
                            $('select').removeClass('form-control-danger');
                            $('input').removeClass('form-control-danger');
                            $('input-group').removeClass('input-group-danger');
                            $('.error_message').remove();
                        }
                    })

                    .done(function (result) {
                        var data = jQuery.parseJSON(result);
                        if (data.success == false) {
                            $.each(data.messages, function (key, value) {
                                var element = $('#' + key);

                                element
                                    .removeClass('form-control-danger')
                                    .removeClass('input-group-danger')
                                    .addClass(value.length > 0 ? 'form-control-danger' : '')
                                    .addClass(value.length > 0 ? 'input-group-danger' : '')
                                    .find('.text-danger')
                                    .remove();

                                element.after(value);
                            });
                        } else {
                            if (data.insert > 0) {
                                if (data.redirecturl)
                                {
                                    window.location.href = data.redirecturl;
                                } else {

                                    swal({
                                        title: 'Berjaya',
                                        text: 'Sistem berjaya menyimpan rekod.',
                                        type: 'success'
                                    }).then(function() {
                                        window.location.href = data.finishedurl;
                                    })
                                }
                            } else {
                                Swal(
                                    'Ralat!',
                                    'Sistem gagal untuk menyimpan rekod (E101).',
                                    'error'
                                )
                            }
                        }
                    })

                    .fail(function (jqXHR, ajaxOptions, thrownError) {
                        Swal(
                            'Ralat!',
                            'Sistem gagal untuk menyimpan rekod (E102).',
                            'error'
                        )
                    });

            //     }
            // })
        });

        $('#btn-form_ajaxstandard_reset').click(function () { //button reset event click
            $('.form-control').removeClass('form-control-danger');
            $('.input-group').removeClass('input-group-danger');
            $('.error_message').remove();
            $('#form_ajaxstandard')[0].reset();
        });

        $('#form_ajaxstandard').submit(function (event) {
            event.preventDefault();
            Swal({
                title: 'Perhatian!',
                text: 'Adakah anda pasti untuk simpan rekod?',
                type: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Tidak',
                confirmButtonText: 'Ya',

            }).then((result) => {
                if (result.value) {

                    $.ajax({
                        url: $('#form_ajaxstandard').attr("action"),
                        type: "post",
                        data: new FormData($("#form_ajaxstandard")[0]),
                        datatype: "json",
                        processData:false,
                        contentType:false,
                        cache:false,
                        async:false,
                        beforeSend: function () {
                            $('select').removeClass('form-control-danger');
                            $('input').removeClass('form-control-danger');
                            $('input-group').removeClass('input-group-danger');
                            $('.error_message').remove();
                        }
                    })

                    .done(function (result) {
                        var data = jQuery.parseJSON(result);
                        if (data.success == false) {
                            $.each(data.messages, function (key, value) {
                                var element = $('#' + key);

                                element
                                    .removeClass('form-control-danger')
                                    .removeClass('input-group-danger')
                                    .addClass(value.length > 0 ? 'form-control-danger' : '')
                                    .addClass(value.length > 0 ? 'input-group-danger' : '')
                                    .find('.text-danger')
                                    .remove();

                                element.after(value);
                            });
                        } else {
                            if (data.insert > 0) {
                                swal({
                                    title: 'Berjaya',
                                    text: 'Sistem berjaya menyimpan rekod.',
                                    type: 'success'
                                }).then(function() {
                                    window.location.href = data.finishedurl;
                                })
                            } else {
                                Swal(
                                    'Ralat!',
                                    'Sistem gagal untuk menyimpan rekod (E101).',
                                    'error'
                                )
                            }
                        }
                    })

                    .fail(function (jqXHR, ajaxOptions, thrownError) {
                        Swal(
                            'Ralat!',
                            'Sistem gagal untuk menyimpan rekod (E102).',
                            'error'
                        )
                    });

                }
            })
        });
    });


    function hapus(url) {
        Swal({
            title: 'Perhatian!',
            text: 'Adakah anda pasti untuk hapus rekod ini?',
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Tidak',
            confirmButtonText: 'Ya',

        }).then((result) => {
            if (result.value) {

             $.ajax({
                type: "GET",
                url: url,
                success: function (result) {
                    var data = jQuery.parseJSON(result);

                    if(data.success){
                        swal({
                            title: 'Berjaya',
                            text: 'Data berjaya dihapuskan.',
                            type: 'success'
                        }).then(function() {
                            if(data.finishedurl){
                            window.location.href = data.finishedurl;
                            }else{
                            location.reload();
                            }
                        })
                    }else{
                        Swal(
                            'Ralat!',
                            'Sistem gagal untuk hapus rekod (E104).',
                            'error'
                        )
                    }
                }
            });

            }
        })


    };