<?php
 $base_url =  "http://".$_SERVER['SERVER_NAME']."/pcnhs.sis";
	echo <<<SB

		<div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="$base_url/systemadmin/index.php" class="site_title"><i class="fa fa-wrench"></i> <span>PCNHS System</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile">
              <div class="profile_pic">
                <img src="$base_url/images/icon-user-default.png" alt="admin" class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>System Administrator</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-user"></i> Account Management <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="$base_url/systemadmin/index.php"> Manage Personnel Accounts </a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-desktop"></i> Activity Log<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="$base_url/systemadmin/activitylog.php">Review Personnel Activity</a></li>
                    </ul>
                  </li>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

          </div>
        </div>

        
SB;

?>