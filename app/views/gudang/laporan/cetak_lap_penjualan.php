<?php

$mpdf = $data['mpdf'];
$stylesheet = file_get_contents(BASEURL.'/assets/custom/pdf.css');



$mpdf->SetTitle('Cetak - Laporan Penjualan');



$mpdf->SetHTMLHeader('
	<div class="header">
	    <table class="table" border="0">
			<tr>
				<td colspan="0">
					<h2>'. $data["judul"] .'</h2>
				</td>
				<td align="right">
					<img src="'. BASEURL .'/assets/img/logo.png" alt="LOGO" height="40">
					<br>
					Serua, Tangerang Selatan
				</td>
			</tr>
			<tr>
				<td colspan="2">Periode : '. $data["filter"]["tanggal_awal"] .' ~ '. $data["filter"]["tanggal_akhir"] .'</td>
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
					<td align="center">Tanggal</td>
					<td align="center">No. Penjualan</td>
					<td align="center">Item</td>
					<td align="center">Deskripsi</td>
					<td>Harga Jual</td>
					<td align="center">Qty</td>
					<td>Subtotal</td>
				</tr>
			</thead>
			<tbody>
';



$i = 1;
foreach ($data['laporan_penjualan'] as $pen) {
	$html .= '
		<tr class"tbody">
			<td align="center">'. $i++ .'</td>
			<td>'. $pen["tanggal"] .'</td>
			<td>'. $pen["no_penjualan"] .'</td>
			<td>'. $pen["item"] .'</td>
			<td>'. $pen["deskripsi"] .'</td>
			<td>Rp. '. number_format($pen["harga_jual"]) .'</td>
			<td align="center">'. number_format($pen["qty"]) .'</td>
			<td>Rp. '. number_format($pen["subtotal"]) .'</td>
		</tr>
	';
}



$html .= '
	</tbody>
	<tfoot>
		<tr class="tfoot">
			<td colspan="6">Grand Total</td>
			<td align="center">'. number_format($data["total_qty"]) .'</td>
			<td>Rp. '. number_format($data["grand_total"]) .'</td>
		</tr>
	<tfoot>
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
		    <td align="left">Waktu Cetak : '. date("d-m-Y") .' | '. date("H:i:s") .'</td>
	        <td align="right">{PAGENO}/{nbpg}</td>
	    </tr>
	</table>
');



$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->Output('laporan-penjualan.pdf', \Mpdf\Output\Destination::INLINE);

?>