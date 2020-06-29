<section class="content-header">
	<h1><?=$title;?></h1>
	<ol class="breadcrumb">
		<li><i class="fa fa-home"></i> Home</li>
		<li><a href="<?=site_url();?>admin/account/index"><i class="fa fa-table"></i> List Akun</a></li>
	</ol>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-6">
			<div class="box box-info">
				<div class="box-body">
					<div class="table-responsive">
						<table id="datatables" class="table table-bordered small" style="width: 100%;">
							<thead>
								<tr>
									<th>Username</th>
									<th class="text-center" style="min-width: 200px;"><i class="fa fa-cogs"></i></th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<form id="form_reset" action="#" method="post">
	<div class="modal fade" id="modal-reset">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Reset Password</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="reset_username_text">Username</label>
						<input type="text" class="form-control" id="reset_username_text" name="reset_username_text" disabled>
					</div>
					<div class="form-group">
						<label for="reset_password">New Password</label>
						<input type="password" class="form-control" id="reset_password" name="reset_password" required>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" id="reset_id" name="reset_id">
					<input type="hidden" id="reset_username" name="reset_username">
					<button type="submit" id="reset_submit" class="btn btn-primary">Reset</button>
					<button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</form>