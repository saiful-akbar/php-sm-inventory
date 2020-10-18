$(document).ready(function() {

	/*
	*  PRELOADER
	*/	
	$('.preloader').fadeOut('slow',function(){
		$(this).hide();
	});	
	/*
	*  AKHIR PRELOADER
	*/




	/*
	*  DATA TABLE
	*/
	$('.table-scrol').DataTable( {
		responsive: true,
		"scrollY": 400,
		"scrollX": true,
		"scrollCollapse": true,
		"paging": false
	});

	$('.table-all').DataTable({
		responsive: true,
		"lengthMenu": ["All"],
		"paging": false
	});

	$('.datatable').dataTable({
		"scrollX": true,
		"scrollCollapse": true,
		responsive: true,
		"language": {
			"search": "",
			"searchPlaceholder": "Masukan Pencarian...",
			"info": "_START_ - _END_ of _TOTAL_",
			"infoEmpty": "0 - 0 of 0",
			"lengthMenu": 'Rows <select>'+
			'<option value="10">10</option>'+
			'<option value="20">20</option>'+
			'<option value="50">50</option>'+
			'<option value="100">100</option>'+
			'<option value="-1">All</option>'+
			'</select>'
		}
	})

	$('.modal-table').dataTable({
		responsive: true,
		"language": {
			"search": "",
			"searchPlaceholder": "Masukan Pencarian...",
			"info": "_START_ - _END_ of _TOTAL_",
			"infoEmpty": "0 - 0 of 0",
			"lengthMenu": 'Rows <select>'+
			'<option value="10">10</option>'+
			'<option value="20">20</option>'+
			'<option value="50">50</option>'+
			'<option value="100">100</option>'+
			'<option value="-1">All</option>'+
			'</select>'
		}
	})

    /*
	*  AKHIR DATA TABLE
	*/





    /*
	*  MATERIALIZE JS
	*/
	$('.button-collapse').sideNav({
		menuWidth: 270, // Default is 300
		edge: 'left', // Choose the horizontal origin
		closeOnClick: true, // Closes side-nav on <a> clicks, useful for Angular/Meteor
		draggable: false, // Choose whether you can drag to open on touch screens,
		onOpen: function(el) { /* Do Stuff*/ }, // A function to be called when sideNav is opened
		onClose: function(el) { /* Do Stuff*/ }, // A function to be called when sideNav is closed
	});

	$('select').material_select();

	$('.modal').modal({
		dismissible: false, // Modal can be dismissed by clicking outside of the modal
		opacity: .6, // Opacity of modal background
		inDuration: 350, // Transition in duration
		outDuration: 350, // Transition out duration
		startingTop: '10%', // Starting top style attribute
		endingTop: '10%' // Ending top style attribute
	});

	$('.collapsible').collapsible();

	Materialize.updateTextFields();

	$('.dropdown-button').dropdown({
		inDuration: 300,
		outDuration: 225,
		constrainWidth: false, // Does not change width of dropdown to that of the activator
		hover: false, // Activate on hover
		gutter: 0, // Spacing from edge
		belowOrigin: false, // Displays dropdown below the button
		alignment: 'left', // Displays dropdown with edge aligned to the left of button
		stopPropagation: false // Stops event propagation
	});

	$('.dropdown-navbar').dropdown({
		constrainWidth: false,
		hover: true
	});
	/*
	* AKHIR MATERIALIZE JS 
	*/




	/*
	* FLASH MASSAGE ATAU NOTIFIKASI 
	*/
	var flash_pesan = $('.flash-data').data('flashpesan'),
	flash_url   = $('.flash-data').data('flashurl'),
	flash_tipe  = $('.flash-data').data('flashtipe'),
	toastAction = '<i class="material-icons toast-close">close</i>';
	
	if ( flash_url ) {
		Swal.fire({
			title: 'Transaksi Berhasil',
			text: flash_pesan,
			type: flash_tipe,
			showCancelButton: true,
			confirmButtonColor: 'teal',
			cancelButtonColor: '#d33',
			cancelButtonText: 'Batal',
			confirmButtonText: 'Cetak'
		}).then((result) => {
			if (result.value) {				
				window.open(flash_url, '_BLANK');
			}
		})
	}
	else if ( flash_pesan && flash_tipe ) {		
		
		if ( flash_tipe == 'success' ) {
			var toastContent = $('<i class="fas fa-check-circle green-text left toast-icon"></i><span>'+flash_pesan+'</span>').add($(toastAction));
		}
		else if ( flash_tipe == 'error' ){
			var toastContent = $('<i class="fas fa-times-circle red-text left toast-icon"></i><span>'+flash_pesan+'</span>').add($(toastAction));
		}
		else if ( flash_tipe == 'info' ){
			var toastContent = $('<i class="fas fa-info-circle cyan-text left toast-icon"></i><span>'+flash_pesan+'</span>').add($(toastAction));
		}
		else if ( flash_tipe == 'warning' ){
			var toastContent = $('<i class="fas fa-exclamation-triangle orange-text left toast-icon"></i><span>'+flash_pesan+'</span>').add($(toastAction));
		}		
		Materialize.toast(toastContent, 5000);
	}

	$('.toast-close').click(function(e){
		Materialize.Toast.removeAll();
	});
	/*
	* AKHIR  FLASH MESSAGE ATAU NOTIFIKASI
	*/




	/*
	*  CHECK ALL OTOMATIS
	*/
	$("#check-all").click(function(){
		if( $(this).is(":checked") )
			$(".check-item").prop("checked", true);
		else
			$(".check-item").prop("checked", false);
	});
	/*
	*  AKHIR CHECK ALL OTOMATIS
	*/




	/*
	*  SWEET ALERT ATAU NOTIFIKASI KONFIRMASI
	*/
	$('#multi-hapus-data').on('click', function(e) {
		e.preventDefault();

		var chkd = document.getElementsByName('data[]');
		var hascheked = false;
		for ( var i = 0;  i < chkd.length; i++ ) {
			if ( chkd[i].checked ) {
				hascheked = true;
				break;
			}
		}
		if ( hascheked == true ) {
			Swal.fire({
				title: 'Hapus ?',
				text: "Data yang dihapus tidak dapat dikembalikan!",
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: 'teal',
				cancelButtonColor: '#d33',
				cancelButtonText: 'Batal',
				confirmButtonText: 'Hapus'
			}).then((result) => {
				if (result.value) {				
					document.formTable.submit();
				}
			})
		}
		else {
			e.preventDefault();
		}
	});

	$('.hapus-data').on('click', function(e) {
		e.preventDefault();
		var href = $(this).attr('href');
		console.log(href);
		Swal.fire({
			title: 'Yakin hapus data ini?',
			text: "Data yang dihapus tidak dapat dikembalikan!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: 'teal',
			cancelButtonColor: '#d33',
			cancelButtonText: 'Batal',
			confirmButtonText: 'Hapus'
		}).then((result) => {
			if (result.value) {				
				document.location.href = href;
			}
		})
	});

	$('.logout').on('click', function(e) {
		e.preventDefault();
		var href = $(this).attr('href');
		console.log(href);
		Swal.fire({
			title: 'Keluar?',
			text: '',
			type: 'info',
			showCancelButton: true,
			confirmButtonColor: 'teal',
			cancelButtonColor: '#d33',
			cancelButtonText: 'Batal',
			confirmButtonText: 'Ya'
		}).then((result) => {
			if (result.value) {				
				document.location.href = href;
			}
		})
	});
	
	/*
	*  AKHIR SWEET ALERT ATAU NOTIFIKASI KONFIRMASI
	*/





	/*
	*  KATEGORI BARANG
	*/
	$('.tambah-data-kategori').on('click', function() {
		var action = $(this).data('action');

		$('.label').removeClass('active');
		$('#form-kategori').attr('action', action);
		$('#form-kategori')[0].reset();
		$('.modal-content span[class="title"]').html('Tambah Data Kategori');
		$('.modal-footer button[type=submit]').html('Tambah');
	});

	$('.ubah-data-kategori').on('click', function() {
		var action = $(this).data('action'),
		id = $(this).data('id');

		$('.label').addClass('active');
		$('#form-kategori').attr('action', action);
		$('.modal-content span[class="title"]').html('Ubah Data Kategori');
		$('.modal-footer button[type=submit]').html('Ubah');
		
		$.ajax({
			url: $(this).data('url'),
			method: 'POST',
			data: {id : id},
			dataType: 'json',
			success: function(data) {
				$('#id_kategori').val(data.id_kategori);
				$('#nama_kategori').val(data.nama_kategori);
			}
		});
	});
	/*
	* AKHIR KATEGORI BARANG
	*/





	/*
	* SUPPLIER
	*/
	$('.tambah-data-spl').on('click', function(e) {
		e.preventDefault();
		var action = $(this).data('action');

		$('.label').removeClass('active');
		$('#form-spl')[0].reset();
		$('#form-spl').attr('action', action);
		$('#form-spl button[type=submit]').html('Tambah');
		$('.modal-content span[class=title]').html('Tambah Data Supplier');
	});

	$('.ubah-data-spl').on('click', function(e) {
		e.preventDefault();
		var id = $(this).data('id');
		var action = $(this).data('action');
		
		$('.label').addClass('active');
		$('#form-spl').attr('action', action);
		$('#form-spl button[type=submit]').html('Ubah');
		$('.modal-content span[class=title]').html('Ubah Data Supplier');

		$.ajax({
			url: $(this).data('url'),
			method: 'POST',
			data: {id : id},
			dataType: 'json',
			success: function(data) {
				$('#id').val(data.id);
				$('#kode').val(data.kode);
				$('#nama').val(data.nama);
				$('#kota').val(data.kota);
				$('#alamat').val(data.alamat);
				$('#kontak').val(data.kontak);
			}
		});
	});

	/*
	* AKHIR SUPPLIER
	*/





	/*
	* FILTER TRANSAKSI
	*/
	$('form[name=formTransaksi]').submit(function(e){
		e.preventDefault();
		var tanggal_awal = $('input[name=tanggal_awal]').val(),
		tanggal_akhir = $('input[name=tanggal_akhir]').val(),
		action = $(this).attr('action'),
		url = action+'/'+tanggal_awal+'/'+tanggal_akhir;

		window.location.href = url;
	})
	/*
	* AKHIR FILTER TRANSAKSI
	*/





	/*
	*  LAPORAN TRANSAKSI 
	*/
	$('select[name=laporan]').on('change', function (e) {
		e.preventDefault();
		var link = $(this.options[this.selectedIndex]).val();			
		window.location.href = link;
	});

	$('#form-filter-laporan').on('submit', function (e) {
		e.preventDefault();
		var action = $(this).attr('action'),
		tanggal_awal = $('#tanggal_awal').val(),
		tanggal_akhir = $('#tanggal_akhir').val(),
		no_transaksi = $('#no_transaksi').val(),
		item = $('#item').val();

		if ( no_transaksi && item ) {
			var link = action+'/'+tanggal_awal+'/'+tanggal_akhir+'/'+no_transaksi+'/'+item;
		}
		else if (no_transaksi) {
			var link = action+'/'+tanggal_awal+'/'+tanggal_akhir+'/'+no_transaksi+'/0';
		}
		else if (item) {
			var link = action+'/'+tanggal_awal+'/'+tanggal_akhir+'/0/'+item;
		}
		else {
			var link = action+'/'+tanggal_awal+'/'+tanggal_akhir+'/0/0';
		}

		window.location.href= link;
	});
	/*
	*  AKHIR LAPORAN
	*/




	/*
	*  SUMMARY
	*/
	$('#form-summary').on('submit', function (e) {
		e.preventDefault();
		var action = $(this).attr('action'),
		tanggal_awal = $('#tanggal_awal').val(),
		tanggal_akhir = $('#tanggal_akhir').val(),
		item = $('#item').val();

		if (item) {
			var	link = action+'/'+tanggal_awal+'/'+tanggal_akhir+'/'+item;
		}
		else {
			var	link = action+'/'+tanggal_awal+'/'+tanggal_akhir;			
		}
		
		window.location.href = link;
	});
	/*
	*  AKHIR SUMMARY
	*/




	/*
	*  FORM AUTOFILL ATAU ISI FORM OTOMATIS
	*/
	$('#item').on('keyup', function (e) {
		e.preventDefault();
		const item = $(this).val();

		$.ajax({
			url: $('#item').data('url'),
			method: 'POST',
			data: {item : item},
			dataType: 'json',
			success: function (data) {
				$('#deskripsi').val(data.deskripsi);
				$('#harga_beli').val(data.harga_beli);
				$('#harga_jual').val(data.harga_jual);

				if ( data != '' ) {
					$('label[for=deskripsi]').addClass('active');
					$('label[for=harga_beli]').addClass('active');
					$('label[for=harga_jual]').addClass('active');
				}
				else {
					$('label[for=deskripsi]').removeClass('active');
					$('label[for=harga_beli]').removeClass('active');
					$('label[for=harga_jual]').removeClass('active');
				}
			}		
		});
	});
	/*
	*  AKHIR ISI FORM OTOMATIS
	*/




	/*
	*  SEND VALUE MODAL VIEW BARANG
	*/
	// $('.send-value').on('click', function() {
	// 	const item = $(this).data('item');
	// 	$.ajax({
	// 		url: $(this).data('url'),
	// 		method: 'POST',
	// 		data: {item : item},
	// 		dataType: 'json',
	// 		success: function(data) {
	// 			$('#item').val(data.item);
	// 			$('#deskripsi').val(data.deskripsi);
	// 			$('#harga_beli').val(data.harga_beli);
	// 			$('#harga_jual').val(data.harga_jual);
	// 			$('#modal-barang').modal('close');

	// 			if ( data != '' ) {
	// 				$('label[for=item]').addClass('active');
	// 				$('label[for=deskripsi]').addClass('active');
	// 				$('label[for=harga_beli]').addClass('active');
	// 				$('label[for=harga_jual]').addClass('active');
	// 			}
	// 			else {
	// 				$('label[for=item]').removeClass('active');
	// 				$('label[for=deskripsi]').removeClass('active');
	// 				$('label[for=harga_beli]').removeClass('active');
	// 				$('label[for=harga_jual]').removeClass('active');
	// 			}
	// 		}
	// 	});
	// });
	/*
	*  AKHIR SEND VALUE MODAL VIEW BARANG
	*/





	/*
	* TAMPIL DAN SEMBINYIKAN PASSWORD
	*/
	$('#show-password').on('click', function () {
		var type = $('#password').attr('type');
		if ( type === 'password' ) {
			$('#password').attr('type','text');
			$(this).html('visibility')
		}
		else {
			$('#password').attr('type','password');			
			$(this).html('visibility_off');
		}
	});
	
	$('#show-detail-pass').on('click', function () {
		var type = $('#detail-password').attr('type');
		if ( type === 'password' ) {
			$('#detail-password').attr('type','text');
			$(this).html('visibility')
		}
		else {
			$('#detail-password').attr('type','password');			
			$(this).html('visibility_off');
		}
	});
	/*
	*  AKHIR TAMPIL DAN SEMBUNYIKAN PASSWORD
	*/





	/*
	*  USER
	*/
	$('.detail-user').on('click', function (e) {
		e.preventDefault();
		var id = $(this).data('id');

		$.ajax({
			url: $(this).data('url'),
			method: 'POST',
			data: {id : id},
			dataType: 'json',
			success: function(data) {
				$('#detail-nama').html(data.nama_user);
				$('#detail-username').html(data.username);
				$('#detail-password').html(data.password);
				$('#detail-level').html(data.level);
			}
		});
	});
	/*
	*  USER
	*/





	/*
	*  FORMAT NO TLP
	*/
	$("input[name=kontak]").keypress(function (e) {
		
		if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
			return false;
		}
		else {
			var val = $(this).val(),
			panjang = val.length;

			if ( panjang == 4 ) {
				$(this).val(val + '-');
			}
			else if ( panjang == 9 ) {
				$(this).val(val + '-');
			}

			$(this).attr('maxlength', '14');
		}
	});
	/*
	*  AKHIR FORMAT NO TLP
	*/
});



/*
*  SEND VALUE MODAL VIEW BARANG
*/
function sendValue(item = null, link = null) {
	$.ajax({
		url: link,
		method: 'POST',
		data: {item : item},
		dataType: 'json',
		success: function(data) {
			$('#item').val(data.item);
			$('#deskripsi').val(data.deskripsi);
			$('#harga_beli').val(data.harga_beli);
			$('#harga_jual').val(data.harga_jual);
			$('#modal-barang').modal('close');

			if ( data != '' ) {
				$('label[for=item]').addClass('active');
				$('label[for=deskripsi]').addClass('active');
				$('label[for=harga_beli]').addClass('active');
				$('label[for=harga_jual]').addClass('active');
			}
			else {
				$('label[for=item]').removeClass('active');
				$('label[for=deskripsi]').removeClass('active');
				$('label[for=harga_beli]').removeClass('active');
				$('label[for=harga_jual]').removeClass('active');
			}
		}
	});
}
/*
*  SEND VALUE MODAL VIEW BARANG
*/