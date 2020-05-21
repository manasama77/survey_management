<header class="main-header">
	<!-- Logo -->
	<a href="javascript:;" class="logo">
		<!-- mini logo for sidebar mini 50x50 pixels -->
		<span class="logo-mini"><img src="<?=base_url();?>public/img/baik_logo3.png" width="50px"></span>
		<!-- logo for regular state and mobile devices -->
		<span class="logo-lg"><b>Survey</b>Management</span>
	</a>
	<!-- Header Navbar: style can be found in header.less -->
	<nav class="navbar navbar-static-top">
		<!-- Sidebar toggle button-->
		<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</a>

		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
				<!-- User Account: style can be found in dropdown.less -->
				<li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<img src="<?=base_url();?>vendor/adminlte/img/user2-160x160.jpg" class="user-image" alt="User Image">
						<span class="hidden-xs"><?=strtoupper($this->session->userdata(SESS.'username'));?></span>
					</a>
					<ul class="dropdown-menu">
						<!-- User image -->
						<li class="user-header">
							<img src="<?=base_url();?>vendor/adminlte/img/user2-160x160.jpg" class="img-circle" alt="User Image">
							<p>
								<?=strtoupper($this->session->userdata(SESS.'username'));?>
							</p>
						</li>
						<!-- Menu Footer-->
						<li class="user-footer">
							<div class="pull-left">
								<a href="#" class="btn btn-default btn-flat">Profile</a>
							</div>
							<div class="pull-right">
								<a href="<?=site_url();?>logout/admin" class="btn btn-default btn-flat">Sign out</a>
							</div>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>
</header>