<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

if (!function_exists('mpr')) {
	function mpr($d, $echo = TRUE)
	{
		if ($echo) {
			echo '<pre>' . print_r($d, true) . '</pre>';
		} else {
			return '<pre>' . print_r($d, true) . '</pre>';
		}
	}
}

if (!function_exists('pr')) {
	function pr($d)
	{
		mpr($d);
		$debug = debug_backtrace();
		echo 'DEBUG <b>File : </b>' . @$debug[0]['file'] . ' <b>Line : </b>' . @$debug[0]['line'];
		die;
	}
}

if (!function_exists('get_user_profile')) {
	function get_user_profile($id)
	{
		$_ci = get_instance();

		$_ci->db->where('id', $id);
		$_ci->db->limit(1);
		$query = $_ci->db->get('vw_users');

		return $query->result_array()[0];
	}
}

if (!function_exists('get_active_module')) {
	function get_active_module()
	{
		$_ci = get_instance();

		$_ci->db->select('id, name');
		$_ci->db->where('is_active', 1);
		// $_ci->db->limit(1);
		$_ci->db->order_by('module_sort', 'ASC');
		$query = $_ci->db->get('konf_module');

		return $query->result_array();
	}
}

/**
	$menu_ids = konf_menu_access.konf_menu_id
 **/
if (!function_exists('get_users_by_menu_access')) {
	function get_users_by_menu_access($menu_ids = array())
	{
		$_ci = get_instance();

		if (count($menu_ids) > 0) {

			// $_ci->db->select('konf_role_id');
			// $_ci->db->where_in('konf_menu_id', $menu_ids);
			// $_ci->db->group_by("konf_role_id");
			// $query = $_ci->db->get('konf_menu_access');

			// $role_ids = array();
			// foreach ($query->result() as $row) {
			// 	$role_ids[] = $row->konf_role_id;
			// }


			// $_ci->db->select('profile_konf_ptj_id');
			// $_ci->db->where_in('konf_role_id', $role_ids);
			// $query2 = $_ci->db->get('profile_ptj_role');

			// $profile_ptj_ids = array();
			// foreach ($query2->result() as $row) {
			// 	$profile_ptj_ids[] = $row->profile_konf_ptj_id;
			// }


			// $_ci->db->select('user_id');
			// $_ci->db->where_in('id', $profile_ptj_ids);
			// $query3 = $_ci->db->get('profile_konf_ptj');

			// $profile_ids = array();
			// foreach ($query3->result() as $row) {
			// 	$profile_ids[] = $row->user_id;
			// }

			// $_ci->db->select('id, name, unit_nama');
			// $_ci->db->where_in('id', $profile_ids);
			// $query4 = $_ci->db->get('vw_users');

			$users = array();

			$_ci->db->select('unit.nama as nama_unit, ptj.nama as nama_ptj, u.*, kma.access_right');
			$_ci->db->from('users u');
			$_ci->db->join('profile_konf_ptj pkp', 'pkp.user_id = u.id');
			$_ci->db->join('profile_ptj_role ppr', 'ppr.profile_konf_ptj_id = pkp.id');
			$_ci->db->join('konf_menu_access kma', 'kma.konf_role_id = ppr.konf_role_id');
			$_ci->db->join('konf_menu km', 'km.id = kma.konf_menu_id');
			$_ci->db->join('konf_ptj ptj', 'ptj.id = pkp.konf_ptj_id');
			$_ci->db->join('konf_unit unit', 'unit.id = u.konf_unit_id', 'LEFT');

			$_ci->db->where_in('km.id', $menu_ids);
			$_ci->db->where('JSON_EXTRACT(access_right, "$.l") = 1');
			$_ci->db->where('JSON_EXTRACT(access_right, "$.t") = 1');
			$_ci->db->where('JSON_EXTRACT(access_right, "$.s") = 1');
			$_ci->db->where('JSON_EXTRACT(access_right, "$.h") = 1');
			$_ci->db->where('JSON_EXTRACT(access_right, "$.c") = 1');
			$query = $_ci->db->get();

			foreach ($query->result() as $row) {
				// $users[$row->id] = $row->name . ' | ' . $row->unit_nama;
				$users[$row->id] = $row->name . ' | ' . ($row->nama_unit != '' ? $row->nama_unit : '(Unit Tidak Ditetapkan)') . ' | ' . ucwords(strtolower($row->nama_ptj));
			}

			return $users;
		}

		return false;
	}
}

if (!function_exists('get_users')) {
	function get_users()
	{
		$_ci = get_instance();


		$_ci->db->select('id, name, unit_nama');
		$query4 = $_ci->db->get('vw_users');

		$users = array();
		foreach ($query4->result() as $row) {
			$users[$row->id] = $row->name . ' | ' . $row->unit_nama;
		}


		return $users;
	}
}

if (!function_exists('pdf_create')) {
	/**
	  	$html 			Html code to render PDF output
	  	$filename 		File name for page to render or download/.
	  	$orientation 	P = Potrait, L = Landscape. Default P.
	  	$page_format 	Page format. Default A4
	  	$unit 			size unit. Default MM.
	  	$unicode		To support unicode. True / False . Default true.
	  	$encoding		Page encoding. Default 'UTF-8'
	  	$stream			Output to browser or force download. Default I = Inline browser.
	 **/
	function pdf_create($html, $filename, $orientation = 'P', $page_format = 'A4', $unit = 'mm', $unicode = true, $encoding = 'UTF-8', $stream = 'I')
	{
		ob_start();
		$_ci = get_instance();
		$_ci->load->library('Tcpdflib');

		// setlocale(LC_MONETARY, 'en_US');

		$pdf = new TCPDF($orientation, $unit, $page_format, true, $encoding, false);
		$pdf->SetCreator('JTS-PDF');
		$pdf->SetLeftMargin(9);
		$pdf->SetRightMargin(9);
		$pdf->SetPrintHeader(false);
		$pdf->SetPrintFooter(false);
		$pdf->AddPage();

		$pdf->writeHTML($html, true, true, false, false, '');
		$pdf->lastPage();

		$pdf->Output($filename . '.pdf', $stream);
	}

	function get_month_desc($id)
	{
		switch ($id) {
			case 1:
				return gettext('Januari');
				break;
			case 2:
				return gettext('Februari');
				break;
			case 3:
				return gettext('Mac');
				break;
			case 4:
				return gettext('April');
				break;
			case 5:
				return gettext('Mei');
				break;
			case 6:
				return gettext('Jun');
				break;
			case 7:
				return gettext('Julai');
				break;
			case 8:
				return gettext('Ogos');
				break;
			case 9:
				return gettext('September');
				break;
			case 10:
				return gettext('Oktober');
				break;
			case 11:
				return gettext('November');
				break;
			case 12:
				return gettext('Disember');
				break;
		}
	}

	function get_month_desc_short($id)
	{
		switch ($id) {
			case 1:
				return gettext('JAN');
				break;
			case 2:
				return gettext('FEB');
				break;
			case 3:
				return gettext('MAC');
				break;
			case 4:
				return gettext('APR');
				break;
			case 5:
				return gettext('MEI');
				break;
			case 6:
				return gettext('JUN');
				break;
			case 7:
				return gettext('JUL');
				break;
			case 8:
				return gettext('OGOS');
				break;
			case 9:
				return gettext('SEPT');
				break;
			case 10:
				return gettext('OKT');
				break;
			case 11:
				return gettext('NOV');
				break;
			case 12:
				return gettext('DIS');
				break;
		}
	}

	function format_thedate($str_date, $format = "d-m-Y")
	{
		if (strtotime($str_date) != -62170008406) {
			return date($format, strtotime($str_date));
		} else {
			return '-';
		}
	}

	function fail_ptj_jabatan($fp_ptj_id)
	{
		$_ci = get_instance();
		$_ci->load->model('sistem_model');
		$data = [];
		$data['ptj'] = $_ci->sistem_model->get_ptj_byid($fp_ptj_id);
		$data['ptj_jabatan'] = $_ci->sistem_model->get_ptj_byid($data['ptj']->parent_ptj_id);
		return $data;
	}

	function month_malay($datetext)
	{
		$ser = array("january", "february", "april", "may", "june", "july", "august", "september", "october", "november", "december");
		$rep = array("januari", "februari", "april", "mei", "jun", "julai", "ogos", "september", "oktober", "november", "disember");
		return ucwords(str_replace($ser, $rep, strtolower($datetext)));
	}

	function nospace_clean($str = '')
	{
		return trim(str_replace(' ', '', $str));
	}

	if (!function_exists("numtowords")) {
		function numtowords($num)
		{

			$decones = array(
				'01' => "satu",
				'02' => "dua",
				'03' => "tiga",
				'04' => "empat",
				'05' => "lima",
				'06' => "enam",
				'07' => "tujuh",
				'08' => "lapan",
				'09' => "sembilan",
				'10' => "sepuluh",
				'11' => "sebelas",
				'12' => "dua belas",
				'13' => "tiga belas",
				'14' => "empat belas",
				'15' => "lima belas",
				'16' => "enam belas",
				'17' => "tujuh belas",
				'18' => "lapan belas",
				'19' => "sembilan belas",
			);
			$ones = array(
				'0' => " ",
				'1' => "satu",
				'2' => "dua",
				'3' => "tiga",
				'4' => "empat",
				'5' => "lima",
				'6' => "enam",
				'7' => "tujuh",
				'8' => "lapan",
				'9' => "sembilan",
				'10' => "sepuluh",
				'11' => "sebelas",
				'12' => "dua belas",
				'13' => "tiga belas",
				'14' => "empat belas",
				'15' => "lima belas",
				'16' => "enam belas",
				'17' => "tujuh belas",
				'18' => "lapan belas",
				'19' => "sembilan belas",
			);
			$tens = array(
				'0' => "",
				'1' => "sepuluh",
				'2' => "dua puluh",
				'3' => "tiga puluh",
				'4' => "empat puluh",
				'5' => "lima puluh",
				'6' => "enam puluh",
				'7' => "tujuh puluh",
				'8' => "lapan puluh",
				'9' => "sembilan puluh",
			);
			$hundreds = array(
				"ratus",
				"ribu",
				"juta",
				"bilion",
				"trilion",
				"Quadrilion",
			); //limit t quadrillion

			$num = number_format($num, 2, ".", ",");
			$num_arr = explode(".", $num);
			$wholenum = $num_arr[0];
			$decnum = $num_arr[1];
			$whole_arr = array_reverse(explode(",", $wholenum));
			krsort($whole_arr);
			$rettxt = "";
			foreach ($whole_arr as $key => $i) {
				if ($i < 20) {
					$rettxt .= $ones[$i];
				} elseif ($i < 100) {
					$rettxt .= $tens[substr($i, 0, 1)];
					$rettxt .= " " . $ones[substr($i, 1, 1)];
				} else {
					$rettxt .= $ones[substr($i, 0, 1)] . " " . $hundreds[0];

					if(substr($i, 1, 1) == 1 AND substr($i, 2, 1) != 0){
						$rettxt .= " " . $ones[substr($i, 1, 2)];
					}else{
						$rettxt .= " " . $tens[substr($i, 1, 1)];

						$rettxt .= " " . $ones[substr($i, 2, 1)];
					}

				}
				if ($key > 0) {
					$rettxt .= " " . $hundreds[$key] . " ";
				}
			}
			//$rettxt = $rettxt." peso/s";

			if ($decnum > 0) {
				$rettxt .= " dan ";
				if ($decnum < 20) {
					$rettxt .= $decones[$decnum];
				} elseif ($decnum < 100) {
					$rettxt .= $tens[substr($decnum, 0, 1)];
					$rettxt .= " " . $ones[substr($decnum, 1, 1)];
				}
				$rettxt = $rettxt . " sen";
			}
			return $rettxt;
		}
	}
}

function get_day_desc($id)
{
	switch ($id) {
		case 1:
			return gettext('Isnin');
			break;
		case 2:
			return gettext('Selasa');
			break;
		case 3:
			return gettext('Rabu');
			break;
		case 4:
			return gettext('Khamis');
			break;
		case 5:
			return gettext('Jumaat');
			break;
		case 6:
			return gettext('Sabtu');
			break;
		case 7:
			return gettext('Ahad');
			break;
	}
}

function pdf_gen($html, $filename, $orientation = 'P', $page_format = 'A4', $unit = 'mm', $unicode = true, $encoding = 'UTF-8', $stream = 'I', $margin = false, $footer = true)
{
	ob_start();
	$_ci = get_instance();
	$_ci->load->library('Tcpdflib');
	$_ci->load->library('session');

	// pr($filename);

	// setlocale(LC_MONETARY, 'en_US');
	class MYPDF extends TCPDF
	{

		//Page header
		public function Header()
		{
		}

		// Page footer
		public function Footer()
		{

			$image_file = "e-Perbendaharaan";
			// $html_foot = '<table width="100%" border="0" style="font-size:9px;color:#929292;">
			// 				<tr>
			// 					<td width="80%"></td>
			// 					<td width="20%" align="right"></td>
			// 				</tr>
			// 				<tr>
			// 					<td width="80%"><div><b>e-Perbendaharaan | '.$_SESSION['username'].' | '.get_day_desc(date('w', strtotime(date('Y-m-d')))).' '.date('d-m-Y H:i:s A').'</b><br/>
			// 						<i>Cetakan ini adalah sulit</i></div>
			// 					</td>
			// 					<td width="20%" align="right">'.$this->getAliasNumPage().'</td>
			// 				</tr>
			// 			   </table>';
			if($_SESSION['fp-cetakan']){
				$cetakan_komputer = '<div style="text-align:center;color:#000000;"><b>'.$_SESSION['fp-cetakan'].'</b></div>';
			}else{
				$cetakan_komputer = '';//Ini adalah cetakan berkomputer. Tandatangan tidak diperlukan.
			}
			
			$html_foot = '<table width="100%" border="0" style="font-size:9px;color:#929292;">
	        				<tr>
	        					<td width="100%" colspan=2>'.$cetakan_komputer.'</td>
	        				</tr>
	        				<tr>
								<td width="80%">
									<div><b>e-Perbendaharaan | ' . get_day_desc(date('w', strtotime(date('Y-m-d')))) . ' ' . date('d-m-Y H:i:s A') . '</b><br/>' . ($_SESSION['fp-status']) . '</div>
	        					</td>
	        					<td width="20%" align="right">' . $this->getAliasNumPage() . ' / ' . $this->getAliasNbPages() . '</td>
	        				</tr>
	        			   </table>';
			// $this->SetY(-40);
			$this->writeHTML($html_foot, true, false, false, false, '');
			$this->SetY(-15);
			$this->SetFont('helvetica', '', 12);
		}
	}

	$pdf = new MYPDF($orientation, $unit, $page_format, true, $encoding, false);
	$pdf->SetCreator('JTS-PDF');
	$pdf->SetLeftMargin(15);
	$pdf->SetRightMargin(15);
	$pdf->SetPrintHeader(false);
	if ($footer == false)
		$pdf->SetPrintFooter(false);
	else
		$pdf->SetPrintFooter(true);

	$pdf->setFooterMargin(20);
	if ($margin == true)
		$pdf->SetMargins(25, 25, 25, 25, true);
	$pdf->AddPage();

	$pdf->writeHTML($html, true, true, false, false, '');
	$pdf->lastPage();

	$pdf->Output($filename . '.pdf', $stream);
}

function pdf_gen_surat($html, $filename, $orientation = 'P', $page_format = 'A4', $unit = 'mm', $unicode = true, $encoding = 'UTF-8', $stream = 'I', $margin_top = 25)
{
	ob_start();
	$_ci = get_instance();
	$_ci->load->library('Tcpdflib');
	$_ci->load->library('session');
	// pr($filename);

	// setlocale(LC_MONETARY, 'en_US');
	class MYPDF_2 extends TCPDF
	{
		//Page header
		public function Header()
		{
		}

		// Page footer
		public function Footer()
		{
			$image_file = "e-Perbendaharaan";
			// $html_foot = '<table width="100%" border="0" style="font-size:9px;color:#929292;">
			// 				<tr>
			// 					<td width="80%"></td>
			// 					<td width="20%" align="right"></td>
			// 				</tr>
			// 				<tr>
			// 					<td width="80%"><div><b>e-Perbendaharaan | '.$_SESSION['username'].' | '.get_day_desc(date('w', strtotime(date('Y-m-d')))).' '.date('d-m-Y H:i:s A').'</b><br/>
			// 						<i>Cetakan ini adalah sulit</i></div>
			// 					</td>
			// 					<td width="20%" align="right">'.$this->getAliasNumPage().'</td>
			// 				</tr>
			// 			   </table>';
			// $html_foot = '<table width="100%" border="0" style="font-size:9px;color:#929292;">
			// 				<tr>
			// 					<td width="80%"></td>
			// 					<td width="20%" align="right"></td>
			// 				</tr>
			// 				<tr>
			// 					<td width="80%">
			// 					</td>
			// 					<td width="20%" align="right">' . $this->getAliasNumPage() . ' / ' . $this->getAliasNbPages() . '</td>
			// 				</tr>
			// 			   </table>';
			// if (!in_array(($this->pages + 1), $this->page_no_foot))
			$html_foot = '<p align="center"><b><i>Ini adalah cetakan berkomputer. Tandatangan tidak diperlukan.</i></b></p>';
			// $this->SetY(-40);
			$this->writeHTML($html_foot, true, false, false, false, '');
			$this->SetY(-15);
			$this->SetFont('helvetica', '', 12);
		}
	}

	$pdf = new MYPDF_2($orientation, $unit, $page_format, true, $encoding, false);
	$pdf->SetCreator('JTS-PDF');
	// $pdf->SetLeftMargin(9);
	// $pdf->SetRightMargin(9);
	$pdf->SetPrintHeader(false);
	$pdf->SetPrintFooter(true);
	$pdf->setFooterMargin(20);
	$pdf->SetMargins(25, $margin_top, 25, 25, true);
	$pdf->AddPage();

	$pdf->writeHTML($html, true, true, false, false, '');
	$pdf->lastPage();

	$pdf->Output($filename . '.pdf', $stream);
}


	function pdf_gen_without_footer($html, $filename, $orientation = 'P', $page_format = 'A4', $unit = 'mm', $unicode = true, $encoding = 'UTF-8', $stream = 'I', $margin_top = 30, $margin_left = 25, $margin_right = 25, $keepmargin = 25)
{
	ob_start();
	$_ci = get_instance();
	$_ci->load->library('Tcpdflib');
	$_ci->load->library('session');

	// pr($filename);

	// setlocale(LC_MONETARY, 'en_US');
	class MYPDF_3 extends TCPDF
	{

		//Page header
		public function Header()
		{
		}

		// Page footer
		public function Footer()
		{
		}
	}

	$pdf = new MYPDF_3($orientation, $unit, $page_format, true, $encoding, false);
	$pdf->SetCreator('JTS-PDF');
	// $pdf->SetLeftMargin(9);
	// $pdf->SetRightMargin(9);
	$pdf->SetPrintHeader(false);
	$pdf->SetPrintFooter(false);
	$pdf->setFooterMargin(20);
	$pdf->SetMargins($margin_left, $margin_top, $margin_right, $keepmargin, true);
	$pdf->AddPage();

	$pdf->writeHTML($html, true, true, false, false, '');
	$pdf->lastPage();

	$pdf->Output($filename . '.pdf', $stream);
}

if (!function_exists('dom_pdf_gen')) {
	function dom_pdf_gen($html, $filename, $header = 'default', $footer = 'default', $orientation = 'potrait', $font = 'Arial', $page_format = 'A4')
	{

		$_ci = get_instance();
		$_ci->load->library('Pdf');

		// setlocale(LC_MONETARY, 'en_US');
		class MY_DOMPDF extends Pdf
		{
			function footer($dompdf, $footer)
			{
				$canvas = $dompdf->get_canvas();
				// $font = $dompdf->getFontMetrics()->get_font("arial");
				$font = $dompdf->getFontMetrics()->get_font("helvetica", "bold_italic");
				if ($footer == 'default') $canvas->page_text(570, 815, "{PAGE_NUM}/{PAGE_COUNT}", $font, 12, array(0, 0, 0));

				if ($footer == 'cetakan_komputer') {
					$html_foot = 'Ini adalah cetakan berkomputer. Tandatangan tidak diperlukan.';
					$canvas->page_text(
						120,
						813,
						$html_foot,
						$font,
						12,
						array(0, 0, 0)
					);
				}
			}
		}

		$pdf = new MY_DOMPDF();
		$pdf->setPaper($page_format, $orientation);
		$pdf->set_option('defaultFont', $font);

		$pdf->loadHtml($html);
		$pdf->render();

		$pdf->footer($pdf, $footer);

		$pdf->stream($filename . ".pdf", array("Attachment" => 0));
	}

	if (!function_exists('array_url_str')) {
		function array_url_str($post = array())
		{
			$string = "";
			foreach ($post as $key => $value) {
				$string .= "&" . $key . "=" . $value;
			}

			return $string;
		}
	}
}

if (!function_exists('dom_pdf_gen_manual_footer')) {
	function dom_pdf_gen_manual_footer($html, $filename, $header = 'default', $footer = 'default', $orientation = 'potrait', $font = 'helvetica', $page_format = 'A4', $save = '')
	{

		$_ci = get_instance();
		$_ci->load->library('Pdf');

		// setlocale(LC_MONETARY, 'en_US');
		class MY_DOMPDF extends Pdf
		{
			function footer($dompdf, $footer)
			{
				// $canvas = $dompdf->get_canvas();
				// $font = $dompdf->getFontMetrics()->get_font("arial");
				// if($footer == 'default') $canvas->page_text(570, 815, "{PAGE_NUM}/{PAGE_COUNT}", $font, 12, array(0,0,0));

				// if($footer == 'cetakan_komputer')
				// {
				// 	$html_foot = 'Ini adalah cetakan berkomputer. Tandatangan tidak diperlukan.';
				// 	$canvas->page_text(570, 815, "{PAGE_NUM}/{PAGE_COUNT}", $font, 12, array(0,0,0));
				// 	$canvas->page_text(
				// 		120, 
				// 		813, 
				// 		$html_foot, 
				// 		$font, 
				// 		12, 
				// 		array(0,0,0)
				// 	);

				// }

			}
		}

		$pdf = new MY_DOMPDF();
		$pdf->setPaper($page_format, $orientation);
		$pdf->set_option('defaultFont', $font);

		$pdf->loadHtml($html);
		$pdf->render();

		$pdf->footer($pdf, $footer);

		if ($save == '')
			$pdf->stream($filename . ".pdf", array("Attachment" => 0));
		else {
			$pdf_string =   $pdf->output();
			file_put_contents($save . '.pdf', $pdf_string);
		}
	}
}
