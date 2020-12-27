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

/**
 * retrieve from database example.
 * askim follow this one. Every category optional record.. needed to be config by database. Put it as konf_kod table.
 */
if (!function_exists('generate_option_group')) {
	function generate_option_group($selected_value = null)
	{
		$_ci = get_instance();
		$_ci->load->model('mastercode_model');

		$result = $_ci->mastercode_model->get_all_data_konf_group();
		$htmlstring = '';
		if ($result) {
			foreach ($result as $key => $item) {
				if ($item->id == $selected_value) {
					$htmlstring .= '<option data-kod=' . $item->kod . ' value=' . $item->id . ' selected >' .  $item->kod . ' - ' . $item->nama . '</option>';
				} else {
					$htmlstring .= '<option data-kod=' . $item->kod . ' value=' . $item->id . '>' . $item->kod . ' - ' . $item->nama . '</option>';
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

if (!function_exists('generate_bil_waktu')) {
	function generate_bil_waktu($selected_value = null)
	{

		$htmlstring = '';
		for($i = 1; $i <= 10; $i++)
		{
			if($i == $selected_value)
			{
				$htmlstring .= "<option value=".$i." selected='true'>". $i ."</option>";
			}
			else
			{
				$htmlstring .= "<option value=".$i.">". $i ."</option>";
			}
			
		}

		return $htmlstring;
	}
}

if (!function_exists('generate_guru_terlibat')) {
	function generate_guru_terlibat($selected_value = null)
	{

		$htmlstring = '';
		for($i = 0; $i <= 10; $i++)
		{
			if($i == $selected_value)
			{
				$htmlstring .= "<option value=".$i." selected='true'>". $i ."</option>";
			}
			else
			{
				$htmlstring .= "<option value=".$i.">". $i ."</option>";
			}
			
		}

		return $htmlstring;
	}
}

/**
 * retrieve from database example.
 * askim follow this one. Every category optional record.. needed to be config by database. Put it as konf_kod table.
 */
if (!function_exists('generate_tingkatan_tahun')) {
	function generate_tingkatan_tahun($selected_value = null, $session_konf_sekolah)
	{
		$_ci = get_instance();
		$_ci->load->model('mastercode_model');

		$result = $_ci->mastercode_model->get_tingkatan_tahun($session_konf_sekolah);
		$htmlstring = '';
		if ($result) {
			foreach ($result as $key => $item) {
				if ($item->nama_tingkatan == $selected_value) {
					$htmlstring .= '<option data-kod="' . $item->nama_tingkatan . '" value="' . $item->nama_tingkatan . '" selected >' .  $item->nama_tingkatan . '</option>';
				} else {
					$htmlstring .= '<option data-kod="' . $item->nama_tingkatan . '" value="' . $item->nama_tingkatan . '">' . $item->nama_tingkatan . '</option>';
				}
			}
		}
		return $htmlstring;
	}
}

