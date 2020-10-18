<?php


$mpdf = $data['mpdf'];
$stylesheet = file_get_contents(BASEURL.'/assets/custom/pdf.css');



$mpdf->SetTitle($data["judul"]);



foreach ($data['return_penjualan'] as $rpj) {
	$tanggal = $rpj['tanggal'];
	$grand_total = $rpj['grand_total'];
	$user = $rpj['nama_user'];
	$keterangan = $rpj['keterangan'];
}



$mpdf->SetHTMLHeader('
	<div class="header">
	    <table class="table" border="0">
			<tr>
				<td colspan="3">
					<h2>NOTA RETURN PENJUALAN</h2>
				</td>
				<td align="right">
					<img src="'. BASEURL .'/assets/img/logo.png" alt="LOGO" height="40">
					<br>
					Serua, Tangerang Selatan
				</td>
			</tr>
			<tr>
				<td width="20%">No Return Penjualan</td>
				<td width="1">:</td>
				<td>'. $data["no_return_penjualan"] .'</td>
			</tr>
			<tr>
				<td width="20%">Tanggal</td>
				<td width="1">:</td>
				<td>'. $tanggal .'</td>
			</tr>
			<tr>
				<td width="20%">Keterangan</td>
				<td width="1">:</td>
				<td>'. $keterangan .'</td>
			</tr>
		</table>
	</div>
');



$html = '
	<div class="body">
		<table class="table" cellpadding="5" cellspacing="0">
			<thead>
				<tr class="thead">
					<td>No</td>
					<td>Item</td>
					<td>Deskripsi</td>
					<td>Unit</td>
					<td>Harga Jual</td>
					<td align="center">Qty</td>
					<td>Subtotal</td>
				</tr>
			</thead>
			<tbody>			
';



$i = 1;
foreach ($data['return_penjualan'] as $rpj) {
	$html .= '
		<tr class"tbody">
			<td>'. $i++ .'</td>
			<td>'. $rpj["item"] .'</td>
			<td>'. $rpj["deskripsi"] .'</td>
			<td>'. $rpj["unit"] .'</td>
			<td>Rp. '. number_format($rpj["harga_jual"]) .'</td>
			<td align="center">'. number_format($rpj["qty"]) .'</td>
			<td>Rp. '. number_format($rpj["subtotal"]) .'</td>
		</tr>
	';
}



$html .= '
	</tbody>
	<tfoot>
		<tr class="tfoot">
			<td colspan="5">Grand Total</td>
			<td align="center">'. number_format($data["sum_qty"]) .'</td>
			<td>Rp. '. number_format($grand_total) .'</td>
		</tr>
	</tfoot>
';



$html .= '
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
	<table class="table table-footer" cellpadding="5" border="0">
	    <tr>
	        <td width="15%">User</td>
	        <td width="1%">:</td>
	        <td>'. $user .'</td>
	        <td align="right" rowspan="2">{PAGENO}/{nbpg}</td>
	    </tr>
	    <tr>
		    <td>Waktu Cetak</td>
	        <td>:</td>
			<td>'. date("d-m-Y") .' | '. date("H:i:s") .'</td>
	    </tr>
	</table>
');



$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->Output('nota-return-penjualan-'. $data["no_return_penjualan"] .'.pdf', \Mpdf\Output\Destination::INLINE);

?>