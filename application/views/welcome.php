<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>SURVEY BAIK APP</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

	<link rel="stylesheet" href="<?= base_url(); ?>vendor/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>vendor/adminlte/css/AdminLTE.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition login-page">
	<div class="container-fluid">

		<form class="form" method="post" action="<?= site_url(); ?>login/admin">
			<div class="login-box">
				<div class="register-logo">
					<b>SURVEY</b>BAIK<small>app</small>
				</div>
				<div class="box box-solid box-warning">
					<div class="box-header with-border">
						<h3 class="box-title"><i class="fa fa-user-secret"></i> Login Admin</h3>
					</div>
					<div class="box-body">
						<div class="form-group">
							<label class="control-label" for="username">Username</label>
							<input type="text" class="form-control" id="username" name="username" value="<?= set_value('username'); ?>" placeholder="Username" required>
							<?php echo form_error('username'); ?>
						</div>
						<div class="form-group">
							<label class="control-label" for="password">Password</label>
							<input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
							<?php echo form_error('password'); ?>
						</div>
					</div>
					<div class="box-footer">
						<div class="form-group">
							<button type="submit" class="btn btn-primary btn-block" id="bsubmit" name="bsubmit">Login</button>
							<a href="<?= site_url(); ?>/" class="btn bg-black-active btn-block" id="bback">Kembali</a>
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
<script>
	$(document).ready(function() {

	});
</script>