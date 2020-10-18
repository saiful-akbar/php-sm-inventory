<div class="row">
	<div class="col s12">
		<div class="card">
			<form name="formUbahDataUser" action="<?= BASEURL; ?>/User/ubah" method="POST" id="form-ubah-user" autocomplete="off">
				<div class="card-header">
					<span class="card-title">Form ubah data user</span>
				</div>
				<div class="divider"></div>
				<div class="card-content">					
					<div class="row">
						<div class="input-field col s12 m10 offset-m1">
							<input type="hidden" name="id_user" id="id_user" value="<?= $data['user']['id_user']; ?>" class="validate" readonly>
							<input type="text" name="nama_user" id="nama_user" class="validate text-capitalize" value="<?= $data['user']['nama_user']; ?>" required="">
							<label class="active" for="nama_user">Nama <span class="red-text">*</span></label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12 m10 offset-m1">
							<input type="text" name="username" id="username" class="validate" value="<?= $data['user']['username']; ?>" required="">
							<label class="active" for="username">Username <span class="red-text">*</span></label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12 m10 offset-m1">
							<i class="material-icons input-icon" id="show-password">visibility_off</i>
							<input type="password" name="password" id="password" class="validate" value="<?= $data['user']['password']; ?>" required="">
							<label class="active" for="password">Password <span class="red-text">*</span></label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12 m10 offset-m1">
							<select name="level" id="level" required="">
								<option value="admin" <?php if( $data['user']['level']=='admin' ){echo'selected';} ?> >Admin</option>
								<option value="gudang" <?php if( $data['user']['level']=='gudang' ){echo'selected';} ?> >Gudang</option>
							</select>
							<label for="level">Level <span class="red-text">*</span></label>
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