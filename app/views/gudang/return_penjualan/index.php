<!-- button filter dan tambah return Penjualan -->
<div class="fixed-action-btn">
	<a href="<?= BASEURL; ?>/Return_penjualan/transaksi" class="btn-floating btn-large cyan darken-1 waves-effect waves-light tooltipped" data-delay="50" data-position="left" data-tooltip="Tambah Return Penjualan">
		<i class="large material-icons">add</i>
	</a>
</div>



<!-- form filter return penjualan -->
<div class="row">
	<div class="col s12">
		<div class="card">
			<form method="POST" action="<?= BASEURL; ?>/Return_penjualan" name="formTransaksi" autocomplete="off">
				<div class="card-content">
					<div class="row">
						<div class="col m6 s12">
							<label for="tanggal_awal">Tanggal awal <span class="red-text">*</span></label>
							<input type="date" name="tanggal_awal" class="validate" id="tanggal_awal" value="<?= $data['filter']['tanggal_awal']; ?>" required>
						</div>
						<div class="col m6 s12">
							<label for="tanggal_akhir">Tanggal Akhir <span class="red-text">*</span></label>
							<input type="date" name="tanggal_akhir" class="validate" id="tanggal_akhir" value="<?= $data['filter']['tanggal_akhir']; ?>" required>
						</div>
					</div>
				</div>
				<div class="card-action">
					<button type="submit" name="tampil" class="btn waves-effect waves-light">Tampilkan</button>
				</div>
			</form>
		</div>
	</div>
</div>



<!-- tabel data return Penjualan -->
<div class="row">
	<div id="man" class="col s12">
		<div class="card material-table">
			<div class="table-header">
				<span class="table-title">Data Transaksi Return Penjualan</span>
				<div class="actions">
					<a class="search-toggle waves-effect btn-flat tooltipped" data-delay="50" data-position="top" data-tooltip="Cari">
						<i class="material-icons">search</i>
					</a>
				</div>
			</div>
			<table class="datatable" width="100%">
				<thead>
					<tr>
						<th>No.</th>
						<th>Tanggal</th>
						<th>No. Return Penjualan</th>
						<th>Keterangan</th>
						<th>Total Harga</th>
						<th class="center-align">Cetak</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($data['return_penjualan'] as $index => $rpj): ?>
						<tr>
							<td><?= $index + 1; ?></td>
							<td><?= $rpj['tanggal']; ?></td>
							<td><?= $rpj['no_return_penjualan']; ?></td>
							<td><?= $rpj['keterangan']; ?></td>
							<td>Rp. <?= number_format($rpj['grand_total']); ?></td>
							<td class="center-align">
								<a href="<?= BASEURL; ?>/Return_penjualan/cetak/<?= $rpj['no_return_penjualan']; ?>" target="_BLANK" class="btn-floating blue darken-2 waves-effect waves-light">
									<i class="material-icons">print</i>
								</a>
							</td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
