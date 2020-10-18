<div id="modal-barang" class="modal modal-fixed-footer">
	<div class="modal-content material-table">
		<div class="table-header">
			<span class="table-title"></span>
			<div class="actions">
				<a class="search-toggle waves-effect btn-flat nopadding">
					<i class="material-icons">search</i>
				</a>
			</div>
		</div>
		<table class="modal-table responsive-table">
			<thead>
				<tr>
					<th>No</th>
					<th>Item</th>
					<th>Deskripsi</th>
					<th class="center-align">Stok</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($data['brg'] as $index => $brg): ?>
					<tr onclick="sendValue('<?= $brg["item"] ?>', '<?= BASEURL; ?>/barang/get_barang_json');" style="cursor: pointer;">
						<td><?= $index + 1; ?></td>
						<td><?= $brg['item']; ?></td>
						<td><?= $brg['deskripsi']; ?></td>
						<td class="center-align"><?= $brg['stok']; ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<div class="modal-footer">
		<button class="modal-action modal-close btn grey darken-1 waves-effect waves-light">Tutup</button>
	</div>
</div>