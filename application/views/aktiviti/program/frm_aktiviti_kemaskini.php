<?php defined('BASEPATH') or exit('No direct script access allowed');  ?>

<?php echo form_open_multipart(site_url($actionform) . url_akses(), array('method' => 'post', 'name' => 'add', 'id' => 'form_entry')); ?>
<div class="row">
    <div class="col-sm-12">
        <?php $this->view('aktiviti/program/frm_aktiviti_kemaskini_main'); ?>
    </div>
</div>
</form>

