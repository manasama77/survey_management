<section class="content-header">
	<h1><?=$title;?></h1>
	<ol class="breadcrumb">
		<li><i class="fa fa-home"></i> Home</li>
		<li><a href="<?=site_url();?>admin/survey/index"><i class="fa fa-table"></i> List Survey</a></li>
	</ol>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-info">
				<div class="box-body">
					<div class="table-responsive">
						<table id="datatables" class="table table-bordered">
							<thead>
								<tr>
									<th style="width: 150px;">Survey</th>
									<th style="width: 150px;">Periode</th>
									<th>Status</th>
									<th>Responden</th>
									<th style="width: 200px;">URL</th>
									<th class="text-center" style="width: 300px;"><i class="fa fa-cogs"></i></th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>