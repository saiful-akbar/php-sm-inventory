<?php 

if ( empty($data['filter']['tanggal_awal']) && empty($data['filter']['tanggal_akhir']) ) {
	$disabled = 'disabled';
}
else {
	$disabled = '';
}

?>



<!-- form filter -->
<div class="row">
	<div class="col s12">
		<form id="form-summary" action="<?= BASEURL; ?>/Summary" autocomplete="off">
			<div class="card">
				<div class="card-content">
					<div class="row">
						<div class="input-field col l4 s12">
							<input id="tanggal_awal" type="date" class="validate" value="<?= $data['filter']['tanggal_awal']; ?>" required>
							<label class="active" for="tanggal_awal">Tanggal Awal <span class="red-text">*</span></label>
						</div>
						<div class="input-field col l4 s12">
							<input id="tanggal_akhir" type="date" class="validate" value="<?= $data['filter']['tanggal_akhir']; ?>" required>
							<label class="active" for="tanggal_akhir">Tanggal Akhir <span class="red-text">*</span></label>
						</div>
						<div class="input-field col l4 s12">
							<a href="#modal-barang" class="material-icons input-icon teal-text waves-effect waves-dark modal-trigger tooltipped" data-delay="50" data-position="top" data-tooltip="Cari Tabel">
								insert_invitation
							</a>
							<input id="item" type="text" class="validate text-uppercase" value="<?= $data['filter']['item']; ?>">
							<label for="item">Item Kode</label>
						</div>
					</div>
				</div>
				<div class="card-action">
					<button type="submit" name="filter" class="btn teal waves-effect waves-light">Tampilkan</button>
				</div>
			</div>
		</form>
	</div>
</div>



<!-- data summary -->
<div class="row">
	<div id="man" class="col s12">
		<div class="card material-table">
			<div class="table-header">
				<span class="table-title">Data Laporan Summary</span>
				<div class="actions">
					<a href="<?= $data['url']; ?>" target="_BLANK" class="btn-flat waves-effect tooltipped <?= $disabled; ?>" data-delay="50" data-position="top" data-tooltip="Cetak">
						<i class="large material-icons">print</i>
					</a>
					<a class="search-toggle waves-effect btn-flat tooltipped" data-delay="50" data-position="top" data-tooltip="Cari">
						<i class="material-icons">search</i>
					</a>
				</div>
			</div>
			<table class="datatable" width="100%">
				<thead>
					<tr>
						<th>No. </th>
						<th>Kode Item</th>
						<th>Deskripsi</th>
						<th>Unit</th>
						<th class="center-align">Pembelian</th>
						<th class="center-align">Return Penjualan</th>
						<th class="center-align">Penjualan</th>
						<th class="center-align">Return Pembelian</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($data['barang'] as $index => $brg): ?>
						<tr>
							<td><?= $index + 1; ?></td>
							<td><?= $brg['item']; ?></td>
							<td><?= $brg['deskripsi']; ?></td>
							<td><?= $brg['unit']; ?></td>
							<td class="center-align"><?= number_format($data[ 'pembelian'.$brg['item'] ]); ?></td>
							<td class="center-align"><?= number_format($data[ 'return_penjualan'.$brg['item'] ]); ?></td>
							<td class="center-align"><?= number_format($data[ 'penjualan'.$brg['item'] ]); ?></td>
							<td class="center-align"><?= number_format($data[ 'return_pembelian'.$brg['item'] ]); ?></td>
						</tr>
					<?php endforeach ?>
				</tbody>
				<tfoot>
					<tr>
						<th colspan="4">Grand Total</th>
						<th class="center-align"><?= number_format($data['total_pembelian']); ?></th>
						<th class="center-align"><?= number_format($data['total_return_penjualan']); ?></th>
						<th class="center-align"><?= number_format($data['total_penjualan']); ?></th>
						<th class="center-align"><?= number_format($data['total_return_pembelian']); ?></th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>
