<?='<pre>'.print_r($this->session->all_userdata(), 1).'</pre>';?>
<section class="content-header">
	<h1>Dashboard</h1>
	<ol class="breadcrumb">
		<li><i class="fa fa-home"></i> Home</li>
		<li><a href="<?=site_url();?>admin/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
	</ol>
</section>

<section class="content">

	<div class="row">

		<div class="col-lg-3 col-xs-6">
			<div class="small-box bg-aqua">
				<div class="inner">
					<h3><?=number_format($admin_count, 0, ',', '.');?></h3>
					<p>Admin</p>
				</div>
				<div class="icon">
					<i class="fa fa-users"></i>
				</div>
				<a href="<?=site_url();?>admin/account/index" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>

		<div class="col-lg-3 col-xs-6">
			<div class="small-box bg-green">
				<div class="inner">
					<h3><?=number_format($survey_aktif_count, 0, ',', '.');?></h3>
					<p>Survey Aktif</p>
				</div>
				<div class="icon">
					<i class="fa fa-bar-chart"></i>
				</div>
				<a href="<?=site_url();?>admin/survey/index" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>

		<div class="col-lg-3 col-xs-6">
			<div class="small-box bg-yellow">
				<div class="inner">
					<h3><?=number_format($survey_close_count, 0, ',', '.');?></h3>
					<p>Survey Close</p>
				</div>
				<div class="icon">
					<i class="fa fa-bar-chart"></i>
				</div>
				<a href="<?=site_url();?>admin/survey/index" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>

	</div>

</section>