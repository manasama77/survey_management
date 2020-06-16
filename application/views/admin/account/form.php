<section class="content-header">
	<h1>Akun <small>Tambah Akun</small></h1>
	<ol class="breadcrumb">
		<li><i class="fa fa-home"></i> Home</li>
		<li><a href="<?=site_url();?>admin/account/index"><i class="fa fa-users"></i> Akun</a></li>
			<li><a href="<?=site_url();?>admin/account/create"><i class="fa fa-plus"></i> Tambah Akun</a></li>
		</ol>
	</section>

	<section class="content">

		<?php
		if($this->session->flashdata('success') === TRUE){
		?>
			<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>Akun berhasil dibuat</strong>
			</div>
		<?php } ?>

		<?php
		if($this->session->flashdata('error') === TRUE){
		?>
			<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong><?=GA_KONEK;?></strong>
			</div>
		<?php } ?>

		<div class="row">
			<div class="col-xs-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title">Data Akun</h3>
					</div>

					<form class="form-horizontal" method="post" action="<?=site_url();?>admin/account/create">
						<div class="box-body">

							<div class="form-group">
								<label for="username" class="col-sm-2 control-label">Username</label>
								<div class="col-sm-6">
									<input type="text" class="form-control" id="username" name="username" placeholder="Username" minlength="3" maxlength="100" value="<?=set_value('username');?>" required>
									<?=form_error('username');?>
								</div>
							</div>

							<div class="form-group">
								<label for="username" class="col-sm-2 control-label">Password</label>
								<div class="col-sm-6">
									<input type="password" class="form-control" id="password" name="password" placeholder="Password" minlength="3" maxlength="100" value="<?=set_value('password');?>" required>
									<?=form_error('password');?>
								</div>
							</div>

							<div class="form-group">
								<label for="username" class="col-sm-2 control-label">Verify Password</label>
								<div class="col-sm-6">
									<input type="password" class="form-control" id="verify_password" name="verify_password" placeholder="Verify Password" minlength="3" maxlength="100" required>
									<?=form_error('verify_password');?>
								</div>
							</div>

						</div>
						<!-- /.box-body -->
						<div class="box-footer">
							<button type="submit" class="btn btn-info">Simpan</button>
							<a href="<?=site_url();?>admin/account/index" class="btn btn-default pull-right">Kembali ke List Akun</a>
						</div>
						<!-- /.box-footer -->
					</form>
				</div>
			</div>
		</div>

	</section>