<div class="row">
	<div class="col s12">
		<div class="card">
			<form name="formUbahDataBarang" action="<?= BASEURL; ?>/Barang/ubah" method="POST" id="form-ubah-barang" autocomplete="off">
				<div class="card-header">
					<span class="card-title">Form ubah data barang</span>
				</div>
				<div class="divider"></div>
				<div class="card-content">
					<div class="row">
						<div class="input-field col s12 m10 offset-m1">
							<input type="hidden" name="id" class="validate" id="id" required="" value="<?= $data['barang']['id']; ?>">
							<select name="kategori" id="kategori" required>
								<?php foreach ($data['kategori'] as $kategori) : ?>
									<option value="<?= $kategori['id_kategori']; ?>"  <?php if( $data['barang']['nama_kategori'] == $kategori['nama_kategori'] ) { echo "selected"; } ?> ><?= $kategori['nama_kategori']; ?></option>
								<?php endforeach; ?>
							</select>
							<label>Kategori <span class="red-text">*</span></label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12 m10 offset-m1">
							<input type="text" name="item" class="validate text-uppercase" id="item" required="" value="<?= $data['barang']['item']; ?>">
							<label class="active" for="item">Kode Item <span class="red-text">*</span></label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12 m10 offset-m1">
							<input type="text" name="deskripsi" class="validate" id="deskripsi" value="<?= $data['barang']['deskripsi']; ?>" required="">
							<label class="active" for="deskripsi">Deskripsi <span class="red-text">*</span></label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12 m10 offset-m1">
							<select name="unit" id="unit" required="">
								<option value="BOX" <?php if($data['barang']['unit'] == 'BOX') {echo "selected";} ?> >BOX</option>
								<option value="PCS" <?php if($data['barang']['unit'] == 'PCS') {echo 'selected';} ?> >PCS</option>
								<option value="SET" <?php if($data['barang']['unit'] == 'SET') {echo 'selected';} ?> >SET</option>
							</select>
							<label>Unit <span class="red-text">*</span></label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12 m10 offset-m1">
							<input type="number" name="harga_beli" class="validate" id="harga_beli" value="<?= $data['barang']['harga_beli']; ?>" required="">
							<label class="active" for="harga_beli">Harga Beli <span class="red-text">*</span></label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12 m10 offset-m1">
							<input type="number" name="harga_jual" class="validate" id="harga_jual" value="<?= $data['barang']['harga_jual']; ?>" required="">
							<label class="active" for="harga_jual">Harga Jual <span class="red-text">*</span></label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12 m10 offset-m1">
							<input type="number" name="stok" class="validate" value="<?= $data['barang']['stok']; ?>" id="stok" disabled>
							<label class="active" for="stok">Stok</label>
						</div>
					</div>
				</div>
				<div class="fixed-action-btn">
					<button type="submit" name="submit" class="btn-floating btn-large waves-effect waves-light tooltipped" data-delay="50" data-position="left" data-tooltip="Simpan Perubahan">
						<i class="material-icons">save</i>
					</button>
					<br><br>
					<button onclick="history.go(-1);" class="btn-floating btn-large indigo darken-1 waves-effect waves-light tooltipped" data-delay="50" data-position="left" data-tooltip="Kembali">
						<i class="material-icons right">keyboard_return</i>
					</button>	
				</div>
			</form>
		</div>
	</div>
</div>