<?php

foreach ($data['pembelian'] as $pem) :
	$tanggal = $pem['tanggal'];
	$supplier = $pem['nama'];
	$grand_total = $pem['grand_total'];
	$user = $pem['nama_user'];
endforeach;

$mpdf = $data['mpdf'];
$stylesheet = file_get_contents(BASEURL.'/assets/custom/pdf.css');



$mpdf->SetTitle($data["judul"]);



$mpdf->SetHTMLHeader('
	<div class="header">
	    <table class="table" border="0">
			<tr>
				<td colspan="3">
					<h2>NOTA PEMBELIAN</h2>
				</td>
				<td align="right">
					<img src="'. BASEURL .'/assets/img/logo.png" alt="LOGO" height="40">
					<br>
					Serua, Tangerang Selatan
				</td>
			</tr>
			<tr>
				<td width="15%">No Pembelian</td>
				<td width="1">:</td>
				<td>'. $data["no_pembelian"] .'</td>
			</tr>
			<tr>
				<td width="15%">Tanggal</td>
				<td width="1">:</td>
				<td>'. $tanggal .'</td>
			</tr>
			<tr>
				<td width="15%">Supplier</td>
				<td width="1">:</td>
				<td>'. $supplier .'</td>
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
					<td>Harga Beli</td>
					<td align="center">Qty</td>
					<td>Subtotal</td>
				</tr>
			</thead>
			<tbody>
';



$i = 1;
foreach ($data['pembelian'] as $pem) {
	$html .= '
		<tr class"tbody">
			<td>'. $i++ .'</td>
			<td>'. $pem["item"] .'</td>
			<td>'. $pem["deskripsi"] .'</td>
			<td>'. $pem["unit"] .'</td>
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
			<td colspan="5">Grand Total</td>
			<td>'. $data["sum_qty"] .'</td>
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
$mpdf->Output('nota-pembelian-'. $data["no_pembelian"] .'.pdf', \Mpdf\Output\Destination::INLINE);

?>