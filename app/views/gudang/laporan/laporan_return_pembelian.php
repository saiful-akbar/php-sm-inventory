<?php 

if ( $data['filter']['no_return_pembelian'] != '0' ) {
	$no_transaksi = $data['filter']['no_return_pembelian'];	
}
else {
	$no_transaksi = '';	
}



if ( $data['filter']['item'] != '0' ) {		
	$item = $data['filter']['item'];
}
else {
	$item = '';
}



if ( empty($data['laporan_return_pembelian']) ) {
	$disabled = 'disabled';
}
else {
	$disabled = '';
}

?>



<div class="row">
	<div class="col s12">
		<div class="card">
			<div class="card-content">
				<div class="input-field">
					<i class="material-icons prefix teal-text">insert_chart</i>
					<select name="laporan" id="laporan">
						<option value="<?= BASEURL; ?>/Laporan_pembelian">Laporan Pembelian</option>
						<option value="<?= BASEURL; ?>/Laporan_penjualan">Laporan Penjualan</option>
						<option value="<?= BASEURL; ?>/Laporan_return_pembelian" selected>Laporan Return Pembelian</option>
						<option value="<?= BASEURL; ?>/Laporan_return_penjualan">Laporan Return Penjualan</option>
					</select>
					<label>Kategori Laporan</label>
				</div>
			</div>
		</div>
	</div>
</div>



<div class="row">
	<div id="man" class="col s12">
		<div class="card material-table">
			<div class="table-header">
				<span class="table-title">Data Laporan Return Pembelian</span>
				<div class="actions">
					<a href="<?= $data['url_cetak']; ?>" target="_BLANK" class="btn-flat waves-effect waves-light tooltipped <?= $disabled; ?>" data-delay="50" data-position="top" data-tooltip="Cetak">
						<i class="material-icons">print</i>
					</a>
					<a class="search-toggle waves-effect btn-flat tooltipped" data-delay="50" data-position="top" data-tooltip="Cari">
						<i class="material-icons">search</i>
					</a>
				</div>
			</div>
			<table class="datatable" width="100%">
				<thead>
					<tr>
						<th>No</th>
						<th>Tanggal</th>
						<th>No. Return Pembelian</th>
						<th>Keterangan</th>
						<th>Kode Item</th>
						<th>Deskripsi</th>
						<th>Harga Beli</th>
						<th class="center-align">Qty</th>
						<th>Sub-Total</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($data['laporan_return_pembelian'] as $index => $lap_rpm): ?>
						<tr>
							<td><?= $index + 1; ?></td>
							<td><?= $lap_rpm['tanggal']; ?></td>
							<td><?= $lap_rpm['no_return_pembelian']; ?></td>
							<td><?= $lap_rpm['keterangan']; ?></td>
							<td><?= $lap_rpm['item']; ?></td>
							<td><?= $lap_rpm['deskripsi']; ?></td>
							<td>Rp. <?= number_format($lap_rpm['harga_beli']); ?></td>
							<td class="center-align"><?= number_format($lap_rpm['qty']); ?></td>
							<td>Rp. <?= number_format($lap_rpm['subtotal']); ?></td>
						</tr>
					<?php endforeach ?>
				</tbody>
				<tfoot>
					<tr class="">
						<th colspan="7">Grand Total</th>								
						<th class="center-align"><?= number_format($data['total_qty']); ?></th>
						<th>Rp. <?= number_format($data['grand_total']); ?></th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>



<div class="fixed-action-btn">
	<a href="#modal-laporan" class="btn-floating btn-large teal waves-effect waves-light tooltipped modal-trigger" data-delay="50" data-position="left" data-tooltip="Filter">
		<i class="fas fa-filter"></i>
	</a>
</div>



<!-- Modal filter laporan -->
<div id="modal-laporan" class="modal modal-fixed-footer">	
	<form id="form-filter-laporan" action="<?= BASEURL; ?>/Laporan_return_pembelian" autocomplete="off">
		<div class="modal-content">
			<div class="row">
				<div class="col s12">
					<span class="title">Filter</span>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="input-field col s12">
					<input id="tanggal_awal" type="date" class="validate" value="<?= $data['filter']['tanggal_awal']; ?>" required>
					<label class="active" for="tanggal_awal">Tanggal Awal <span class="red-text">*</span></label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input id="tanggal_akhir" type="date" class="validate" value="<?= $data['filter']['tanggal_akhir']; ?>" required>
					<label class="active" for="tanggal_akhir">Tanggal Akhir <span class="red-text">*</span></label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input id="no_transaksi" type="text" class="validate text-uppercase" value="<?= $no_transaksi; ?>">
					<label class="" for="no_transaksi">No Return Pembelian</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input id="item" type="text" class="validate text-uppercase" value="<?= $item; ?>">
					<label class="" for="item">Item Kode</label>
				</div>
			</div>
		</div>	
		<div class="modal-footer">
			<button type="submit" name="filter" class="btn teal waves-effect waves-light">Tampilkan</button>
			<button type="button" class="modal-action modal-close waves-effect waves-light btn grey darken-1">Tutup</button>
		</div>
	</form>
</div>