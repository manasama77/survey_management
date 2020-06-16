<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Survey Anggota | Log in</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

	<link rel="stylesheet" href="<?= base_url(); ?>vendor/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>vendor/adminlte/css/AdminLTE.css">
	<link rel="stylesheet" href="<?= base_url(); ?>vendor/iCheck/square/blue.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition login-page">
	<div class="container-fluid">

		<form id="form" class="form" action="#" method="post">
			<div class="login-box">
				<div class="register-logo">
					<img src="<?=base_url();?>public/img/baik_logo3.png" width="100px">
					<b>Survey</b>Anggota
				</div>
				<div class="box box-solid box-warning">
					<div class="box-header with-border">
						<h3 class="box-title"><i class="fa fa-user-secret"></i> Login Anggota</h3>
					</div>
					<div class="box-body">
						<div class="form-group">
							<label class="control-label" for="username">No Anggota</label>
							<input type="text" class="form-control" id="nik" name="nik" placeholder="No Anggota" required>
						</div>
					</div>
					<div class="box-footer">
						<div class="form-group">
							<button type="submit" class="btn btn-primary btn-block" id="bsubmit" name="bsubmit" onclick="checkNIK(event);">Login</button>
						</div>
					</div>
				</div>
			</div>
		</form>

	</div>
</body>

</html>

<script src="<?= base_url(); ?>vendor/jquery/dist/jquery.min.js"></script>
<script src="<?= base_url(); ?>vendor/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?= base_url(); ?>vendor/iCheck/icheck.min.js"></script>
<script src="<?=base_url();?>vendor/blockui/jquery.blockUI.js"></script>
<script src="<?=base_url();?>vendor/jquery-inputmask/jquery.inputmask.bundle.min.js" type="text/javascript"></script>
<script>
	let nik = $('#nik');

	$(document).ready(function() {

	});

	function checkNIK(e)
	{
		e.preventDefault();

		if(nik.val().replace(/_/g, '').length == 0){
			alert('No Anggota Tidak boleh kosong');	
		}else{
			checkNIKSirkah(nik.val());
		}
	}

	function checkNIKSirkah(r_nik)
	{
		$.ajax({
			url         : '<?=site_url();?>anggota/check_nia',
			method      : 'GET',
			data        : { 
				cif_no : '402000200001018'
			},
			beforeSend  : function(){
				nik.animate({ opacity: '0.9' }).attr('readonly', true);
				$.blockUI({ message: '<i class="fa fa-spinner fa-spin"></i> Silahkan Tunggu...' });
			},
			statusCode  : {
				200: function(result) {

				},
				400: function() {
					$.unblockUI();
					alert('NIK Tidak ditemukan...');
					nik.animate({ opacity: '1' }).attr('readonly', false).focus();
				},
				404: function() {
					$.unblockUI();
					alert('Page Not Found');
				},
				500: function() {
					$.unblockUI();
					alert('Not connect with Database');
				}
			},
			error : function(res){
				alert('Koneksi bermasalah, silahkan cek koneksi kamu...');
				$.unblockUI();
			}
		})
		.done(function(result){
			console.log(result);
			$.unblockUI();
			// nik            = result.info.nik;
			// let nama       = result.info.nama;
			// let no_ktp     = result.info.no_ktp;
			// let umur       = result.info.umur;
			// let jk         = result.info.jk;
			// let pendidikan = result.info.pendidikan;
			// setSessionKaryawan(nik, nama, no_ktp, umur, jk, pendidikan);
		});
	}

	function setSessionKaryawan(nik, nama, no_ktp, umur, jk, pendidikan)
	{
		$.ajax({
			url: `<?=site_url();?>karyawan/set_session`,
			method: 'post',
			dataType: 'json',
			data: {
				nik: nik,
				nama: nama,
				no_ktp: no_ktp,
				umur: umur,
				jk: jk,
				pendidikan: pendidikan,
			},
			beforeSend: function(){
				$.blockUI();
			}
		})
		.done(function(res){
			if(res.code == 200){
				window.location.reload();
			}else{
				alert('Proses Set Sesi Login Gagal, silahkan coba kembali');
			}
		});
	}
</script>