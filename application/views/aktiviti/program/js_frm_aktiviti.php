<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<script type="text/javascript">
    'use strict';
    window.onload = function magicStick(){
        magicPress();
    };  

    function magicPress(){
        $('#kategori_id').trigger("change");

        let kategori_id = $("#kategori_id_edit").val();
     
        if(kategori_id == 7176)
        {
            $('.hide_first_section').attr('style', 'display:none');
            $('.open_first_section').removeAttr('open_first_section');
        } 
        else if( kategori_id == 7177)
        {
            $('.hide_first_section').removeAttr('style');
            $('.hide_second_section').removeAttr('style');
        }
        else if( kategori_id == 7178)
        {
            $('.hide_second_section').attr('style', 'display:none');
        }
    }

    $(document).on('change', '#kategori_id', function() {
        let kategori_id = $(this).val();  
        
        if(kategori_id == 7176)
        {
            $('.hide_first_section').attr('style', 'display:none');
            $('.open_first_section').removeAttr('open_first_section');
        } 
        else if( kategori_id == 7177)
        {
            $('.hide_first_section').removeAttr('style');
            $('.hide_second_section').removeAttr('style');
        }
        else if( kategori_id == 7178)
        {
            $('.hide_second_section').attr('style', 'display:none');
        }
    });
</script>

