<form name="formTable" method="POST" action="<?= BASEURL; ?>/Kategori/hapus">
	<div class="row">
		<div id="man" class="col s12">
			<div class="card material-table">
				<div class="table-header">
					<span class="table-title">Data Kategori Barang</span>
					<div class="actions">
						<a class="btn-flat waves-effect tooltipped" data-delay="50" data-position="top" data-tooltip="Hapus" id="multi-hapus-data">
							<i class="material-icons">delete</i>
						</a>
						<a class="search-toggle waves-effect btn-flat tooltipped" data-delay="50" data-position="top" data-tooltip="Cari">
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
							<th>Nama Kategori</th>
							<th class="center-align">Ubah</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($data['kategori'] as $kategori) : ?>					
							<tr>
								<td>
									<input type="checkbox" name="data[]" value="<?= $kategori['id_kategori']; ?>" class="filled-in check-item" id="<?= $kategori['nama_kategori']; ?>" />
									<label for="<?= $kategori['nama_kategori']; ?>"></label>
								</td>
								<td><?= $kategori['nama_kategori']; ?></td>
								<td class="center-align">
									<a href="#modalKategori" class="btn-floating modal-trigger ubah-data-kategori waves-effect waves-light" data-action="<?= BASEURL; ?>/Kategori/ubah" data-id="<?= $kategori['id_kategori']; ?>" data-url="<?= BASEURL; ?>/Kategori/get_ubah">
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



<!-- button kembali -->
<div class="fixed-action-btn">
	<a href="#modalKategori" class="btn-floating btn-large cyan darken-1 waves-effect waves-light tooltipped modal-trigger tambah-data-kategori" data-delay="50" data-position="left" data-tooltip="Tambah" data-action="<?= BASEURL; ?>/Kategori/tambah">
		<i class="large material-icons">add</i>
	</a>
	<br><br>
	<button onclick="history.go(-1);" class="btn-floating btn-large indigo darken-1 waves-effect waves-light tooltipped" data-delay="50" data-position="left" data-tooltip="Kembali">
		<i class="material-icons right">keyboard_return</i>
	</button>
</div>



<!-- Modal Kategori -->
<div id="modalKategori" class="modal modal-fixed-footer">	
	<form id="form-kategori" method="POST" action="" autocomplete="off">
		<div class="modal-content">
			<div class="row">
				<div class="col s12">					
					<span class="title">Tambah Data Kategori</span>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="input-field col s12">
					<input type="hidden" name="id_kategori" value="" class="validate" id="id_kategori">
					<input type="text" name="nama_kategori" value="" class="validate text-uppercase" id="nama_kategori" required="">
					<label class="label" for="nama_kategori">Masukan Kategori <span class="red-text">*</span></label>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="submit" name="simpan" class="btn teal waves-effect waves-light">Tambah</button>
			<button type="button" class="modal-action modal-close waves-effect waves-light btn grey darken-1">Tutup</button>
		</div>
	</form>
</div>