<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

/*
| Konfigurasi untuk tetapan standard html breadcrumb template
|
| MF - 20181023
*/

$config['tag_open'] = ' <div class="p-b-20"><div class="btn-group btn-breadcrumb breadcrumb-default">';
$config['tag_close'] = '</div></div>';
$config['crumb_home'] = '<a href="' . homepage() . '" class="btn btn-default"><i class="ti-home text-black"></i></a>';

?>