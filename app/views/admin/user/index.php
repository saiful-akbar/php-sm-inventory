<form name="formTable" method="POST" action="<?= BASEURL; ?>/User/hapus">
	<div class="row">
		<div id="man" class="col s12">
			<div class="card material-table">
				<div class="table-header">
					<span class="table-title">Data User</span>
					<div class="actions">
						<a class="btn-flat waves-effect tooltipped" data-delay="50" data-position="top" data-tooltip="Hapus" id="multi-hapus-data">
							<i class="material-icons">delete</i>
						</a>
						<a href="<?= BASEURL; ?>/User/cetak" target="_blank" class="btn-flat waves-effect tooltipped" data-delay="50" data-position="top" data-tooltip="Cetak">
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
							<th>
								<input type="checkbox" class="filled-in check-all" id="check-all" />
								<label for="check-all"></label>
							</th>
							<th>No</th>
							<th>Nama User</th>
							<th class="center-align">Detail</th>
							<th class="center-align">Ubah</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($data['user'] as $index => $user): ?>
							<tr>
								<td>
									<input type="checkbox" name="data[]" value="<?= $user['id_user'] ?>" class="filled-in check-item" id="<?= $user['id_user']; ?>" />
									<label for="<?= $user['id_user']; ?>"></label>
								</td>
								<td><?= $index + 1; ?></td>
								<td><?= $user['nama_user']; ?></td>
								<td class="center-align">
									<a href="#modal-detail" class="modal-trigger btn-floating blue darken-2 waves-effect waves-light detail-user" data-id="<?= base64_encode($user['id_user']); ?>" data-url="<?= BASEURL; ?>/User/get_user">
										<i class="material-icons">visibility</i>
									</a>
								</td>
								<td class="center-align">
									<a href="<?= BASEURL; ?>/User/ubah/<?= base64_encode($user['id_user']); ?>" class="btn-floating waves-effect waves-light">
										<i class="material-icons">edit</i>
									</a>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</form>



<!-- button tambah, hapus dan cetak -->
<div class="fixed-action-btn">
	<a href="#modal-tambah" class="btn-floating btn-large cyan darken-1 waves-effect waves-light tooltipped modal-trigger" data-delay="50" data-position="left" data-tooltip="Tambah">
		<i class="large material-icons">add</i>
	</a>
</div>



<!-- Modal tambah barang -->
<div id="modal-tambah" class="modal modal-fixed-footer">	
	<form id="form-user" method="POST" action="<?= BASEURL; ?>/User/tambah" autocomplete="off">
		<div class="modal-content">
			<div class="row">
				<div class="col s12">					
					<span class="title">tambah data user</span>
				</div>
			</div>
			<br>
			<div class="row">				
				<div class="input-field col s12">
					<input type="text" name="nama" id="nama" class="validate text-capitalize" required="">
					<label for="nama">Nama <span class="red-text">*</span></label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input type="text" name="username" id="username" class="validate" required="">
					<label for="username">Username <span class="red-text">*</span></label>
				</div>
			</div>
			<div class="row">				
				<div class="input-field col s12">
					<i class="material-icons input-icon" id="show-password">visibility_off</i>
					<input type="password" name="password" id="password" class="validate" required="">
					<label for="password">Password <span class="red-text">*</span></label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<select name="level" id="level" required>
						<option value="pilih" disabled selected>== Pilih ==</option>
						<option value="admin">Admin</option>
						<option value="gudang">Gudang</option>
					</select>
					<label for="level">Level <span class="red-text">*</span></label>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="submit" name="simpan" class="btn teal white-text waves-effect waves-light">Tambah</button>
			<button type="button" class="modal-action modal-close waves-effect waves-light btn grey darken-1 white-text">Tutup</button>
		</div>
	</form>
</div>



<!-- modal detail data user -->
<div id="modal-detail" class="modal modal-fixed-footer">
	<form id="form-user" method="POST" action="<?= BASEURL; ?>/User/tambah" autocomplete="off">
		<div class="modal-content">
			<div class="row">
				<div class="co s12">
					<span class="title">Detail User</span>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="co s12">
					<table class="bordered highlight" width="100%" cellpadding="20">
						<tbody>
							<tr>
								<th width="20%">Nama</th>
								<th>:</th>
								<td><span id="detail-nama"></span></td>
							</tr>
							<tr>
								<th width="20%">Username</th>
								<th>:</th>
								<td><span id="detail-username"></span></td>
							</tr>
							<tr>
								<th width="20%">Password</th>
								<th>:</th>
								<td class="input-field"><span id="detail-password"></span></td>
							</tr>
							<tr>
								<th width="20%">Level</th>
								<th>:</th>
								<td><span id="detail-level"></span></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="modal-action modal-close waves-effect waves-light btn grey darken-1 white-text">
				Tutup
			</button>
		</div>
	</form>
</div>