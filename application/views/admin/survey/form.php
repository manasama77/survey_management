<section class="content-header">
	<h1>Survey <small>Buat Survey</small></h1>
	<ol class="breadcrumb">
		<li><i class="fa fa-home"></i> Home</li>
		<li><a href="<?=site_url();?>admin/survey"><i class="fa fa-table"></i> Survey</a></li>
			<li><a href="<?=site_url();?>admin/survey/create"><i class="fa fa-plus"></i> Buat Survey</a></li>
		</ol>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-xs-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title">Master Survey</h3>
						<div class="pull-right"><?=$temp_id_master_survey;?></div>
					</div>
					<!-- /.box-header -->
					<!-- form start -->
					<form class="form-horizontal" method="post" action="<?=site_url();?>admin/survey/create">
						<div class="box-body">

							<div class="form-group">
								<label for="nama_survey" class="col-sm-2 control-label">Nama Survey</label>
								<div class="col-sm-6">
									<input type="text" class="form-control" id="nama_survey" name="nama_survey" placeholder="Nama Survey" minlength="3" maxlength="100" required autofocus>
								</div>
							</div>

							<div class="form-group">
								<label for="desc_survey" class="col-sm-2 control-label">Deskripsi Survey</label>
								<div class="col-sm-6">
									<textarea id="desc_survey" name="desc_survey" class="form-control" placeholder="Deskripsi Survey"></textarea>
								</div>
							</div>

							<div class="form-group">
								<label for="periode_survey_1" class="col-sm-2 control-label">Periode</label>
								<div class="col-sm-4">
									<div class="input-group">
										<input type="date" class="form-control" id="periode_survey_1" name="periode_survey_1" required>
										<span class="input-group-addon" style="background-color: #ccc;">s/d</span>
										<input type="date" class="form-control" id="periode_survey_2" name="periode_survey_2" required>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label for="jenis_responden" class="col-sm-2 control-label">Jenis Responden</label>
								<div class="col-sm-2">
									<select class="form-control" id="jenis_responden" name="jenis_responden" required>
										<option value=""></option>
										<option value="anggota">Anggota</option>
										<option value="karyawan">Karyawan</option>
										<option value="umum">Umum</option>
									</select>
								</div>
							</div>

						</div>
						<!-- /.box-body -->
						<div class="box-footer">
							<a href="<?=site_url();?>admin/survey" class="btn btn-default">Kembali ke List Survey</a>
							<button type="submit" class="btn btn-info pull-right">Berikutnya</button>
						</div>
						<!-- /.box-footer -->
					</form>
				</div>
			</div>
		</div>

	</section>