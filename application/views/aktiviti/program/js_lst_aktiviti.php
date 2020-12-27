<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<script type="text/javascript">
    'use strict';

    var table;

    $(document).ready(function() {
        $("#ptj_query").select2();
        
        $("#id_pengguna").inputmask({
            mask: "999999-99-9999"
        });

        // BUG: not working in IE browser
        var urlParams = new URLSearchParams(window.location.search);
        var type = "";

        if (urlParams.has('q'))
            type = urlParams.get('q');

        //datatables
        table = $('#list_table').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": false, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo base_url('aktiviti/program/program_controller/dt_senarai_aktiviti') ?><?php echo url_akses() ?>",
                "type": "POST",
                "data": function(data) {
            
                }
            },

            language: {
                "url": "<?php echo assets_url() . 'js/data-tables.ms_my.js' ?>"
            },

            // Set column definition initialisation properties.
            "columnDefs": [{
                    targets: [0], //first column / numbering column
                    orderable: false, //set not orderable
                    className: "text-center", //set center data column
                    width: "2%",
                },
                {
                    targets: [1], //first column / numbering column
                    className: "text-center", //set center data column
                    render: function(data, type, full, meta) {
                            return data;
                    }
                },
                {
                    targets: [4],
                    className: "text-center", //set center data column
                    width: "10%",
                    render: function(data, type, row) {
                        return data;
                    }
                },
                {
                    targets: [5],
                    className: "text-center",
                    width: "10%",
                    render: function(data, type, row){

                        let template = "";
                        template += '<a id="btn_edit" href="<?php echo base_url('aktiviti/program/program_controller/kemaskini/') ?>' + row[5] + '<?php echo url_akses() ?>" title="Kemaskini"><i class="ti-pencil-alt"></i></a>';
                        return template;
                    }
                }

            ],
            fixedcolumns: true,
        });

        $('#btn_reset_searchform').click(function() { //button reset event click
            $('#search_form')[0].reset();
            $('#ptj_query').val("").trigger('change')
            table.columns().search('').draw();

            table.ajax.reload();  //just reload table
        });

        $('#btn_filter_searchform').click(function(){ //button filter event click
            table.ajax.reload();  //just reload table
        });

        table.on('order.dt search.dt', function() {
            table.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();

    });

    function confirmDelete(id) {
        var id = id;
        var link = "<?php echo base_url('sistem/hapus_pengguna/') ?>" + id + "<?php echo url_akses() ?>";
        swal({
            html: "Anda pasti untuk hapus maklumat pengguna ini?",
            type: "warning",
            showCancelButton: true,
            allowOutsideClick: false
        }).then((result) => {
            if (result.value) {
                window.location.href = link;
            }
        })

    };
</script>
