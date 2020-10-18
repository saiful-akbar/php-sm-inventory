<?php 

$mpdf = $data['mpdf'];
$stylesheet = file_get_contents(BASEURL.'/assets/custom/pdf.css');



$mpdf->SetTitle($data["judul"]);



$mpdf->SetHTMLHeader('
	<div class="header">
	    <table class="table">
			<tr>
				<td>
					<h2>LAPORAN DATA BARANG</h2>
				</td>
				<td align="right"><img src="'. BASEURL .'/assets/img/logo.png" alt="LOGO" height="40"></td>
			</tr>
			<tr>
				<td align="right" colspan="2">Serua, Tangerang Selatan</td>
			</tr>
		</table>
	</div>
');



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



$html = '
	<div class="body">
		<table class="table" cellpadding="5" cellspacing="0" border="1">
			<thead>
				<tr class="thead">
					<td align="center">No</td>
					<td align="center">Kategori</td>
					<td align="center">Item</td>
					<td align="center">Deskripsi</td>
					<td align="center">Unit</td>
					<td align="center">Harga Beli</td>
					<td align="center">Harga Jual</td>
					<td align="center">Stok</td>
				</tr>
			</thead>
			<tbody>
';



$i = 1;
foreach ($data['barang'] as $brg) {
	$html .= '
		<tr class="tbody">
			<td align="center">'. $i++ .'</td>
			<td>'. $brg["nama_kategori"] .'</td>
			<td>'. $brg["item"] .'</td>
			<td>'. $brg["deskripsi"] .'</td>
			<td>'. $brg["unit"] .'</td>
			<td>Rp. '. number_format($brg["harga_beli"]) .'</td>
			<td>Rp. '. number_format($brg["harga_jual"]) .'</td>
			<td align="center">'. number_format($brg["stok"]) .'</td>
		</tr>
	';
}



$html .= '
			</tbody>
		</table>
	</div>
';



$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->Output('data-barang.pdf', \Mpdf\Output\Destination::INLINE);

?>