<?php
  require_once "pathconfig.php";
	echo <<<TN
<!-- top navigation -->
<div class="top_nav">
	<div class="nav_menu no-print">
		<nav class="navbar">
			<div class="col-md-2">
				<div class="nav toggle">
					<a id="menu_toggle"><i class="fa fa-bars"></i></a>
				</div>
			</div>
			<div class="search-bar col-md-7">
				<form class="" action="$base_url/registrar/studentmanagement/student_list.php" method="GET">
					<div class="form-group">
						<div class="input-group">
							<input id="search_key" type="text" class="form-control" name="search_key" placeholder="Search Student...">
							<span class="input-group-btn">
								<button class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
							</span>
						</div>
					</div>
				</form>
			</div>
			
			<ul class="nav navbar-nav pull-right">
				<li class="">

					<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
						<img src="$base_url/assets/images/icon-user-default.png" alt="">Registrar
						<span class=" fa fa-angle-down"></span>
					</a>
					<ul class="dropdown-menu dropdown-usermenu pull-right">
						<li><a href="$base_url/help.php" target="_blank">Help</a></li>
						<li><a href="https://goo.gl/forms/Db1YtGkquWuIIEeB3" target="_blank">Report an Issue</a></li>
						<li><a href="$base_url/logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
					</ul>
				</li>
				
			</ul>
		</li>
	</ul>
	
</nav>
</div>
</div>
<!-- /top navigation -->
TN;
?>