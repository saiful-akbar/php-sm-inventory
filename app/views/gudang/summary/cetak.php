<?php

$mpdf = $data['mpdf'];
$stylesheet = file_get_contents(BASEURL.'/assets/custom/pdf.css');



$mpdf->SetTitle('Cetak - Laporan Summary');



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
				<tr>
					<td align="center">No. </td>
					<td align="center">Kode Item</td>
					<td align="center">Deskripsi</td>
					<td align="center">Unit</td>
					<td align="center">Pembelian</td>
					<td align="center">Return Penjualan</td>
					<td align="center">Penjualan</td>
					<td align="center">Return Pembelian</td>
				</tr>
			</thead>
			<tbody>
';



$i = 1;
foreach ($data['barang'] as $brg) {
	$html .= '
		<tr>
			<td align="center">'. $i++ .'</td>
			<td>'. $brg["item"] .'</td>
			<td>'. $brg["deskripsi"] .'</td>
			<td>'. $brg["unit"] .'</td>
			<td align="center">'. number_format($data["pembelian".$brg["item"]]) .'</td>
			<td align="center">'. number_format($data["return_penjualan".$brg["item"]]) .'</td>
			<td align="center">'. number_format($data["penjualan".$brg["item"]]) .'</td>
			<td align="center">'. number_format($data["return_pembelian".$brg["item"]]) .'</td>
		</tr>
	';
}



$html .= '
	</tbody>
	<tfoot>
		<tr class="tfoot">
			<td colspan="4">Grand Total</td>
			<td align="center">'. number_format($data["total_pembelian"]) .'</td>
			<td align="center">'. number_format($data["total_return_penjualan"]) .'</td>
			<td align="center">'. number_format($data["total_penjualan"]) .'</td>
			<td align="center">'. number_format($data["total_return_pembelian"]) .'</td>
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
$mpdf->Output('laporan-summary.pdf', \Mpdf\Output\Destination::INLINE);

?>