<!-- tabel data supplier -->
<form name="formTable" method="POST" action="<?= BASEURL; ?>/supplier/hapus">
	<div class="row">
		<div id="man" class="col s12">
			<div class="card material-table">
				<div class="table-header">
					<span class="table-title">Data Supplier</span>
					<div class="actions">
						<a class="btn-flat waves-effect tooltipped" data-delay="50" data-position="top" data-tooltip="Hapus" id="multi-hapus-data">
							<i class="material-icons">delete</i>
						</a>
						<a href="<?= BASEURL; ?>/Supplier/cetak" target="_blank" class="btn-flat waves-effect tooltipped" data-delay="50" data-position="top" data-tooltip="Cetak">
							<i class="large material-icons">print</i>
						</a>
						<a class="search-toggle waves-effect btn-flat tooltipped" ata-delay="50" data-position="top" data-tooltip="Cari">
							<i class="material-icons">search</i>
						</a>
					</div>
				</div>
				<table class="datatable" width="100%">
					<thead>
						<tr>
							<th>
								<input type="checkbox" class="filled-in check-all" id="check-all" />
								<label for="check-all"></label>
							</th>
							<th>No.</th>
							<th>Kode</th>
							<th>Nama</th>
							<th>Kota</th>
							<th>Alamat</th>
							<th class="center-align">Kontak</th>
							<th class="center-align">Ubah</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($data['spl'] as $index => $spl) : ?>
							<tr>
								<td>
									<input type="checkbox" name="data[]" value="<?= $spl['id'] ?>" class="filled-in check-item" id="<?= $spl['kode']; ?>" />
									<label for="<?= $spl['kode']; ?>"></label>
								</td>
								<th><?= $index + 1; ?></th>
								<td><?= $spl['kode']; ?></td>
								<td><?= $spl['nama']; ?></td>
								<td><?= $spl['kota']; ?></td>
								<td><?= $spl['alamat']; ?></td>
								<td class="center-align"><?= $spl['kontak']; ?></td>
								<td class="center-align">
									<a href="#modal-spl" class="modal-trigger btn-floating waves-effect waves-light ubah-data-spl" data-action="<?= BASEURL; ?>/supplier/ubah" data-url="<?= BASEURL; ?>/supplier/get_ubah" data-id="<?= $spl['id']; ?>">
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
	<a href="#modal-spl" class="btn-floating btn-large cyan darken-1 tooltipped modal-trigger tambah-data-spl" data-delay="50" data-position="top" data-tooltip="Tambah" data-action="<?= BASEURL; ?>/supplier/tambah">
		<i class="material-icons">add</i>
	</a>
</div>



<!-- modal supplier -->
<div id="modal-spl" class="modal modal-fixed-footer">	
	<form id="form-spl" method="POST" action="" autocomplete="off">
		<div class="modal-content">
			<div class="row">
				<div class="col s12">					
					<span class="title">Tambah Data Supplier</span>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="input-field col s12">
					<input type="hidden" name="id" id="id" class="validate">
					<input type="text" name="kode" id="kode" class="validate text-uppercase" value="<?= $data['kode']; ?>" required readonly>
					<label class="active" for="kode">Kode</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input type="text" name="nama" id="nama" class="validate text-capitalize" required>
					<label class="label" for="nama" class="active">Nama <span class="red-text">*</span></label>
				</div>
			</div>
			<div class="row">				
				<div class="input-field col s12">
					<input type="text" name="kontak" id="kontak" class="validate" required>
					<label class="label" for="kontak">kontak / No.Tlp <span class="red-text">*</span></label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input type="text" name="kota" id="kota" class="validate text-capitalize" required>
					<label class="label" for="kota">Kota <span class="red-text">*</span></label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<textarea name="alamat" id="alamat" class="materialize-textarea" required></textarea>
					<label class="label" for="alamat">Alamat <span class="red-text">*</span></label>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="submit" name="simpan" class="btn teal waves-effect waves-light"></button>
			<button type="button" class="modal-action modal-close waves-effect waves-light btn grey darken-1">Tutup</button>
		</div>
	</form>
</div>