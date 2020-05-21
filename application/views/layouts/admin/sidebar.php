<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">

		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu" data-widget="tree">
			<li class="header">MAIN NAVIGATION</li>
			<li>
				<a href="#">
					<i class="fa fa-dashboard"></i> <span>Dashboard</span>
				</a>
			</li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-table"></i> <span>Survey</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="<?=site_url();?>admin/survey/create"><i class="fa fa-plus"></i> Buat Survey</a></li>
					<li><a href="<?=site_url();?>admin/survey"><i class="fa fa-circle-o"></i> List Survey</a></li>
				</ul>
			</li>
		</ul>
	</section>
	<!-- /.sidebar -->
</aside>