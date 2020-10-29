<?php defined('BASEPATH') OR exit('No direct script access allowed');  ?>
               

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <a data-toggle="collapse" class=" customCollapse" href="#searchFilter" href="#" ><h5><?= gettext("Ruangan Carian");?></h5></a>
                            <div class="card-header-right">
                                <a data-toggle="collapse" class=" customCollapse" href="#searchFilter" href="#" ><i class="ti-angle-down"></i></a>
                            </div>
                        </div>

                        <div class="collapse in" id="searchFilter">
                            <div class="card-block">
                                <div class="col-lg-12">
                                    <form id="search_form" >
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label"><?= gettext("ID Pengguna") ?></label>
                                            <div class="col-sm-4">
                                                <input id="id_pengguna" type="text" class="form-control">
                                            </div>
                                        </div>                                          
                                        <hr>
                                        <div class="text-center">
                                            <button type="button" id="btn_reset_searchform" class="btn btn-danger"><i class="icofont icofont-undo"></i><?= gettext("Set Semula")?></button>
                                            <button type="button" id="btn_filter_searchform" class="btn btn-primary"><i class="icofont icofont-document-search"></i><?= gettext("Cari") ?></button>
                                        </div>
                                    </form>  
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5><?php echo $formtitle;?></h5>                            
                        </div>
                        <div class="card-block">
                            <div class="float-right">
                                <a data-toggle="collapse" class=" btn btn-danger" href="#searchFilter" href="#" ><i class="fa fa-sort"></i><?= gettext("Carian") ?></a>
                                <a href="<?php echo base_url('admin/profile/user_register') . url_akses() ?>" class="btn btn-primary"><i class="icofont icofont-ui-add"></i><?= gettext("Daftar") ?></a>
							</div>
                                <div class="dt-responsive table-responsive">
                                    <table id="list_table" class="table compact dt-responsive table-striped table-bordered table-hover" width='100%'>
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>ID Pengguna</th>                                                  
                                                <th>Nama</th>
                                                <th>Emel</th>
                                                <th>Status</th>
											</tr>
                                        </thead>
                                    </table>
                                </div>
                            <!-- </div> -->
                        </div>
                    </div>
                </div>
            </div>            
       

