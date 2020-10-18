<!-- button kategori -->
<div class="row">
	<div class="col s12">
		<a href="<?= BASEURL; ?>/Kategori" class="btn right waves-effect waves-light">
			Kategori
			<i class="material-icons right">arrow_forward</i>
		</a>
	</div>
</div>


<form name="formTable" method="POST" action="<?= BASEURL; ?>/Barang/hapus">
	<div class="row">
		<div class="col s12">
			<div class="card material-table">
				<div class="table-header">
					<span class="table-title">Data Barang</span>
					<div class="actions">
						<a class="btn-flat waves-effect tooltipped" data-delay="50" data-position="top" data-tooltip="Hapus" id="multi-hapus-data">
							<i class="material-icons">delete</i>
						</a>
						<a href="<?= BASEURL; ?>/Barang/cetak" target="_blank" class="btn-flat waves-effect tooltipped" data-delay="50" data-position="top" data-tooltip="Cetak">
							<i class="large material-icons">print</i>
						</a>
						<a class="search-toggle waves-effect btn-flat tooltipped"  data-delay="50" data-position="top" data-tooltip="Cari">
							<i class="material-icons">search</i>
						</a>
					</div>
				</div>
				<table class="datatable">
					<thead>
						<tr>
							<th>
								<input type="checkbox" class="filled-in check-all" id="check-all" />
								<label for="check-all"></label>
							</th>
							<th>No</th>
							<th>Kategori</th>
							<th>Kode Item</th>
							<th>Deskripsi</th>
							<th>Unit</th>
							<th>Harga Beli</th>
							<th>Harga Jual</th>
							<th class="center-align">Stok</th>
							<th class="center-align">Ubah</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($data['barang'] as $index => $brg) : ?>
							<tr>
								<td>
									<input type="checkbox" name="data[]" value="<?= $brg['id'] ?>" class="filled-in check-item" id="<?= $brg['id']; ?>" />
									<label for="<?= $brg['id']; ?>"></label>
								</td>
								<td><?= $index + 1; ?></td>
								<td><?= $brg['nama_kategori']; ?></td>
								<td><?= $brg['item']; ?></td>
								<td><?= $brg['deskripsi']; ?></td>
								<td><?= $brg['unit']; ?></td>
								<td>Rp. <?= number_format($brg['harga_beli']); ?></td>
								<td>Rp. <?= number_format($brg['harga_jual']); ?></td>
								<td class="center-align"><?= number_format($brg['stok']); ?></td>
								<td class="center-align">
									<a href="<?= BASEURL; ?>/Barang/ubah/<?= base64_encode($brg['id']); ?>" class="btn-floating waves-effect waves-light">
										<i class="material-icons">edit</i>
									</a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</form>



<!-- button tambah, hapus dan cetak -->
<div class="fixed-action-btn">
	<a href="#modalTambahBarang" class="btn-floating btn-large cyan darken-1 waves-effect waves-light tooltipped modal-trigger" data-delay="50" data-position="left" data-tooltip="Tambah">
		<i class="large material-icons">add</i>
	</a>
</div>



<!-- Modal tambah barang -->
<div id="modalTambahBarang" class="modal modal-fixed-footer">	
	<form name="formTambah" method="POST" action="<?= BASEURL; ?>/Barang/tambah" autocomplete="off">
		<div class="modal-content">
			<div class="row">
				<div class="col s12">					
					<span class="title">Tambah Data barang</span>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="input-field col s12">
					<select name="kategori" id="kategori" required>
						<option value="pilih" selected disabled>== Pilih ==</option>
						<?php foreach ($data['kategori'] as $kategori) : ?>
							<option value="<?= $kategori['id_kategori']; ?>"><?= $kategori['nama_kategori']; ?></option>
						<?php endforeach; ?>
					</select>
					<label>Kategori <span class="red-text">*</span></label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input type="text" name="item" class="validate text-uppercase" id="item" required="" value="">
					<label for="item">Kode Item <span class="red-text">*</span></label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input type="text" name="deskripsi" class="validate" id="deskripsi" required="">
					<label for="deskripsi">Deskripsi <span class="red-text">*</span></label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<select name="unit" id="unit" required="">
						<option value="pilih" disabled="" selected="">== Pilih ==</option>
						<option value="PCS">PCS</option>
						<option value="SET">SET</option>
						<option value="BOX">BOX</option>
					</select>
					<label>Unit <span class="red-text">*</span></label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input type="number" name="harga_beli" class="validate" id="harga_beli" required="">
					<label for="harga_beli">Harga Beli <span class="red-text">*</span></label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input type="number" name="harga_jual" class="validate" id="harga_jual" required="">
					<label for="harga_jual">Harga Jual <span class="red-text">*</span></label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input type="number" name="stok" class="validate" id="stok" value="0" disabled>
					<label for="stok">Stok</label>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="submit" name="simpan" class="btn teal waves-effect waves-light">Tambah</button>
			<button type="button" class="modal-action modal-close waves-effect waves-light btn grey darken-1">Tutup</button>
		</div>
	</form>
</div>