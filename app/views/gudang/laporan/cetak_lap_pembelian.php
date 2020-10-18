<?php

$mpdf = $data['mpdf'];
$stylesheet = file_get_contents(BASEURL.'/assets/custom/pdf.css');



$mpdf->SetTitle("Cetak - Laporan Pembelian");



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
					<td align="center">Supplier</td>
					<td align="center">No. Pembelian</td>
					<td align="center">Item</td>
					<td align="center">Deskripsi</td>
					<td align="center">Harga Beli</td>
					<td align="center">Qty</td>
					<td align="center">Subtotal</td>
				</tr>
			</thead>
			<tbody>
';



$i = 1;
foreach ($data['laporan_pembelian'] as $pem) {
	$html .= '
		<tr class"tbody">
			<td align="center">'. $i++ .'</td>
			<td>'. $pem["tanggal"] .'</td>
			<td>'. $pem["nama"] .'</td>
			<td>'. $pem["no_pembelian"] .'</td>
			<td>'. $pem["item"] .'</td>
			<td>'. $pem["deskripsi"] .'</td>
			<td>Rp. '. number_format($pem["harga_beli"]) .'</td>
			<td align="center">'. number_format($pem["qty"]) .'</td>
			<td>Rp. '. number_format($pem["subtotal"]) .'</td>
		</tr>
	';
}



$html .= '
	</tbody>
	<tfoot>
		<tr class="tfoot">
			<td colspan="7">Grand Total</td>
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
$mpdf->Output('laporan-pembelian.pdf', \Mpdf\Output\Destination::INLINE);

?>