<?php 

$mpdf = $data['mpdf'];
$stylesheet = file_get_contents(BASEURL.'/assets/custom/pdf.css');



$mpdf->SetTitle('Cetak - Laporan Data User');



$mpdf->SetHTMLHeader('
	<div class="header">
	    <table class="table">
			<tr>
				<td>
					<h2>'. $data["judul"] .'</h2>
				</td>
				<td align="right"><img src="'. BASEURL .'/assets/img/logo.png" alt="LOGO" height="40"></td>
			</tr>
			<tr>
				<td align="right" colspan="2">Serua, Tangerang Selatan</td>
			</tr>
		</table>
	</div>
');



$html = '
	<div class="body">
		<table class="table" cellpadding="5" cellspacing="0" border="1">
			<thead>
				<tr class="thead">
					<td align="center">No</td>
					<td align="center">Nama</td>
					<td align="center">Username</td>
					<td align="center">Password</td>
					<td align="center">Level</td>
				</tr>
			</thead>
			<tbody>
';



$i = 1;
foreach ($data['user'] as $user) {
	$html .= '
		<tr class="tbody">
			<td align="center">'. $i++ .'</td>
			<td>'. $user["nama_user"] .'</td>
			<td>'. $user["username"] .'</td>
			<td>'. $user["password"] .'</td>
			<td>'. $user["level"] .'</td>
		</tr>
	';
}



$html .= '
			</tbody>
		</table>
	</div>
';



$mpdf->SetHTMLFooter('
	<table class="table" cellpadding="20">
	    <tr>
	        <td align="center" colspan="2">Dibuat Oleh,</td>
	        <td align="center" colspan="2">Mengetahui,</td>
	    </tr>
	    <tr>
	        <td align="center">[</td>
	        <td align="center">]</td>
	        <td align="center">[</td>
	        <td align="center">]</td>
	    </tr>
	</table>
	<table class="table table-footer" cellpadding="5">
	    <tr>
	    	<td align="left">Waktu Cetak : '. date("d-m-Y") .' | '. date("H:i:s") .'</td>
	        <td align="right">{PAGENO}/{nbpg}</td>
	    </tr>
	</table>
');



$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->Output('data-user.pdf', \Mpdf\Output\Destination::INLINE);

?>