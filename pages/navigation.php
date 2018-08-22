<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="sr-only">切換頂端列</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="/run/admin/pages/index.php">清大電機新創營 全員逃走中</a>
	</div>
	<!-- /.navbar-header -->

	<ul class="nav navbar-top-links navbar-right">
		<?php if(MemberReadAllNotification()['valid_area'] == 0){ ?>
		<li class="dropdown">
			<a href="/run/admin/pages/member/index.php" class="text-danger"><span class="animated infinite flash"><i class="fa fa-exclamation"></i>&nbsp;越界警告</span></a>
		</li>
		<?php } ?>
		<?php if(MemberReadAllNotification()['help_status'] == 1){ ?>
		<li class="dropdown">
			<a href="/run/admin/pages/member/index.php" class="text-danger"><span class="animated infinite flash"><i class="fa fa-exclamation"></i>&nbsp;求救請求</span></a>
		</li>
		<?php } ?>
		<li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#">
				<i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
			</a>
			<ul class="dropdown-menu dropdown-user">
				<li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
				</li>
				<li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
				</li>
				<li class="divider"></li>
				<li><a href="/run/admin/pages/login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
				</li>
			</ul>
			<!-- /.dropdown-user -->
		</li>
		<!-- /.dropdown -->
	</ul>
	<!-- /.navbar-top-links -->

	<div class="navbar-default sidebar" role="navigation">
		<div class="sidebar-nav navbar-collapse">
			<ul class="nav" id="side-menu">
				<li>
					<a href="/run/admin/pages/index.php"><i class="fa fa-dashboard fa-fw"></i> 系統總覽</a>
				</li>
				<li>
					<a href="#"><i class="fa fa-users fa-fw"></i> 隊員管理 <span class="fa arrow"></span></a>
					<ul class="nav nav-second-level">
						<li>
							<a href="/run/admin/pages/member/map.php"><i class="fa fa-map-marker fa-fw"></i> 地圖瀏覽</a>
						</li>
						<li>
							<a href="/run/admin/pages/member/index.php"><i class="fa fa-th-list fa-fw"></i> 名冊清單</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="/run/admin/pages/mission/index.php"><i class="fa fa-tasks fa-fw"></i> 任務管理</a>
				</li>
				<li>
					<a href="#"><i class="fa fa-tasks fa-fw"></i> 任務回報管理 <span class="fa arrow"></span></a>
					<ul class="nav nav-second-level">
						<li>
							<a href="/run/admin/pages/report/index.php"><i class="fa fa-question-circle fa-fw"></i> 未審回報</a>
						</li>
						<li>
							<a href="/run/admin/pages/report/finished.php"><i class="fa fa-check-circle fa-fw"></i> 已審回報</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="/run/admin/pages/tool/index.php"><i class="fa fa-wrench fa-fw"></i> 道具管理</a>
				</li>
				<li>
					<a href="/run/admin/pages/clue/index.php"><i class="fa fa-wrench fa-fw"></i> 線索管理</a>
				</li>
			</ul>
		</div>
		<!-- /.sidebar-collapse -->
	</div>
	<!-- /.navbar-static-side -->
</nav>