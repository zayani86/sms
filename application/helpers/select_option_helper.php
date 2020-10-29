<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

/**
 * retrieve from database example.
 * askim follow this one. Every category optional record.. needed to be config by database. Put it as konf_kod table.
 */
if (!function_exists('generate_option_konf_kod_by_kategory')) {
	function generate_option_konf_kod_by_kategory($kategori, $selected_value = null)
	{
		$_ci = get_instance();
		$_ci->load->model('mastercode_model');

		$result = $_ci->mastercode_model->get_all_data_konf_kod($kategori);
		$htmlstring = '';
		if ($result) {
			foreach ($result as $key => $item) {
				if ($item->id == $selected_value) {
					$htmlstring .= '<option data-kod=' . $item->kod . ' value=' . $item->id . ' selected >' .  $item->kod . ' - ' . $item->keterangan . '</option>';
				} else {
					$htmlstring .= '<option data-kod=' . $item->kod . ' value=' . $item->id . '>' . $item->kod . ' - ' . $item->keterangan . '</option>';
				}
			}
		}
		return $htmlstring;
	}
}

if (!function_exists('generate_option_12months')) {
	function generate_option_12months($selected_value = null)
	{
		$htmlstring = '
			<option value="1">(01) - ' . gettext('Januari') . '</option>
			<option value="2">(02) - ' . gettext('Februari') . '</option>
			<option value="3">(03) - ' . gettext('Mac') . '</option>
			<option value="4">(04) - ' . gettext('April') . '</option>
			<option value="5">(05) - ' . gettext('Mei') . '</option>
			<option value="6">(06) - ' . gettext('Jun') . '</option>
			<option value="7">(07) - ' . gettext('Julai') . '</option>
			<option value="8">(08) - ' . gettext('Ogos') . '</option>
			<option value="9">(09) - ' . gettext('September') . '</option>
			<option value="10">(10) - ' . gettext('Oktober') . '</option>
			<option value="11">(11) - ' . gettext('November') . '</option>
			<option value="12">(12) - ' . gettext('Disember') . '</option>';
		return $htmlstring;
	}
}

