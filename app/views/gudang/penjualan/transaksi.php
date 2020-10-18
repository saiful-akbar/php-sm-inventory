<!-- form tambah data penjualan -->
<div class="row container">
	<div class="col s12">
		<ul class="collapsible popout" data-collapsible="accordion">

			<!-- form tambah list barang -->
			<li>
				<div class="collapsible-header active cyan darken-1 white-text">
					<i class="fa fa-plus-square"></i> Barang
				</div>
				<div class="collapsible-body white">
					<form method="POST" action="<?= BASEURL; ?>/Penjualan/tambah" autocomplete="off">
						<div class="row">
							<div class='input-field col s12'>
								<a href="#modal-barang" class="material-icons input-icon cyan-text text-darken-1 waves-effect waves-dark modal-trigger tooltipped" data-delay="50" data-position="top" data-tooltip="Cari Tabel">
									insert_invitation
								</a>
								<input type="text" name="item" id="item" class="validate text-uppercase" data-url="<?= BASEURL; ?>/barang/get_barang_json" required=""/>
								<label for="item">Kode Item <span class="red-text">*</span></label>
							</div>
						</div>
						<div class="row">			
							<div class="input-field col s12 m6">
								<input type="text" name="deskripsi" id="deskripsi" class="validate" readonly=""/>
								<label for="deskripsi">Deskripsi</label>
							</div>
							<div class="input-field col s12 m6">
								<input type="number" name="harga_jual" id="harga_jual" class="validate" readonly=""/>
								<label for="harga_beli">Harga Jual</label>
							</div>
						</div>
						<div class="row">
							<div class='input-field col m12 s12'>
								<input type="number" name="qty" id="qty" class="validate" required="" />
								<label for="qty">Qty <span class="red-text">*</span></label>
							</div>
						</div>
						<div class="row">
							<button type="submit" name="tambah" class="col s12 m4 offset btn waves-effect waves-light cyan darken-1">Tambah</button>
						</div>
					</form>
				</div>
			</li>

			<!-- form transaksi -->
			<li>
				<div class="collapsible-header teal white-text">
					<i class="fas fa-handshake"></i> Transaksi
				</div>
				<div class="collapsible-body white">
					<form method="POST" action="<?= BASEURL; ?>/Penjualan/simpan">
						<div class="row">
							<div class="input-field col s12 m12">
								<label for="no_transaksi">No. Penjualan</label>
								<input type="text" name="no_penjualan" id="no_penjualan" class="validate" value="<?= $data['no_penjualan']; ?>" readonly="" required="">
							</div>
						</div>
						<div class="row">
							<div class="col s12 m12">
								<label for="tanggal">Tanggal <span class="red-text">*</span></label>
								<input type="date" name="tanggal" id="tanggal" class="validate" required="">
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12 m12">
								<input type="number" name="pembayaran" id="pembayaran" class="validate" required="">
								<label for="pembayaran">Pembayaran <span class="red-text">*</span></label>
							</div>
						</div>
						<div class="row">
							<button type="submit" name="simpan" class="col s12 m4 offset btn teal waves-effect waves-light">Simpan</button>
						</div>
					</form>
				</div>
			</li>
		</ul>
	</div>
</div>



<!-- tabel list barang penjualan -->
<form name="formTable" method="POST" action="<?= BASEURL; ?>/Penjualan/hapus">
	<div class="row">
		<div id="man" class="col s12">
			<div class="card material-table">
				<div class="table-header">
					<span class="table-title">List Penjualan Barang</span>
					<div class="actions">
						<a class="waves-effect btn-flat nopadding tooltipped" data-delay="50" data-position="top" data-tooltip="Hapus" id="multi-hapus-data">
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
							<th width="1">
								<input type="checkbox" class="filled-in check-all" id="check-all" />
								<label for="check-all"></label>
							</th>
							<th>No</th>
							<th>Kode Item</th>
							<th>Deskripsi</th>
							<th>Harga Jual</th>
							<th class="center-align">Qty</th>
							<th>Sub-Total</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($data['penjualan_list'] as $index => $list): ?>
							<tr>
								<td>
									<input type="checkbox" name="data[]" value="<?= $list['id'] ?>" class="filled-in check-item" id="<?= $list['id']; ?>" />
									<label for="<?= $list['id']; ?>"></label>
								</td>
								<td><?= $index + 1; ?></td>
								<td><?= $list['item']; ?></td>
								<td><?= $list['deskripsi']; ?></td>
								<td>Rp. <?= number_format($list['harga_jual']); ?></td>
								<td class="center-align"><?= number_format($list['qty']); ?></td>
								<td>Rp. <?= number_format($list['subtotal']); ?></td>
							</tr>
						<?php endforeach ?>
					</tbody>
					<tfoot>
						<tr>
							<th colspan="5">Grand Total</th>
							<th class="center-align"><?= number_format($data['sum_qty']); ?></th>
							<th>Rp. <?= number_format($data['grand_total']); ?></th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</form>



<div class="fixed-action-btn">
	<button onclick="history.go(-1);" class="btn-floating btn-large indigo darken-1 waves-effect waves-light tooltipped" data-delay="50" data-position="left" data-tooltip="Kembali">
		<i class="material-icons right">keyboard_return</i>
	</button>
</div>