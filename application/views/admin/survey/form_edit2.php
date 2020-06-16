<section class="content-header">
	<h1>Survey <small>Edit Survey</small></h1>
	<ol class="breadcrumb">
		<li><i class="fa fa-home"></i> Home</li>
		<li><a href="<?=site_url();?>admin/survey"><i class="fa fa-table"></i> Survey</a></li>
		<li><a href="<?=site_url();?>admin/survey/create"><i class="fa fa-plus"></i> Edit Survey</a></li>
	</ol>
</section>

<section class="content">
	<form class="form-horizontal" method="post" action="#">

		<div class="row">
			<div class="col-sm-12">
				<div class="box box-default">
					<div class="box-header with-border">
						<h3 class="box-title">Templating Pertanyaan & Jawaban</h3>
						<div class="pull-right"><?=$id_master_survey;?></div>
					</div>
				</div>
			</div>
		</div>

		<div id="dynamic_question"></div>

		<div class="row">
			<div class="col-sm-12" style="margin-bottom: 10px;">
				<button type="button" class="btn btn-block btn-warning" id="add_question">
					<i class="fa fa-plus fa-fw"></i> Tambah Pertanyaan
				</button>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-3">
				<div class="box box-info">
					<div class="box-body">
						<div class="form-group">
							<label for="desc_survey" class="col-sm-8 control-label">Total Pertanyaan</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="total_question" name="total_question" value="0" readonly>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<div class="box box-primary">
					<div class="box-footer">
						<a href="<?=site_url();?>admin/survey/index" class="btn btn-default">Kembali ke List Survey</a>
						<a href="<?=site_url();?>admin/survey/create/back" class="btn btn-default">Kembali ke Master Survey</a>
						<input type="hidden" id="id_master_survey" name="id_master_survey" value="<?=$id_master_survey;?>">
						<a href="<?=site_url();?>admin/survey/index" class="btn btn-info pull-right">Update Survey</a>
					</div>
				</div>
			</div>
		</div>

	</form>
</section>