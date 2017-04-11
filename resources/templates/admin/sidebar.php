<?php
  require_once "pathconfig.php";

?>
<?php
echo <<<SB
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="$base_url/systemadmin/index.php" class="site_title"><i class="fa fa-book"></i> <span>PCNHS-ARMS</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile">
              <div class="profile_pic">
                <img src="$base_url/assets/images/icon-user-default.png" alt="admin" class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>Administrator</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                
                  <li><a><i class="fa fa-desktop"></i> System Logs <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="$base_url/systemadmin/index.php">View Activity Logs</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-users"></i>Personnel Accounts <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="$base_url/systemadmin/personnelmanagement/personnels.php">View Personnel Accounts</a></li>
                      <li><a href="$base_url/systemadmin/personnelmanagement/personnel_add.php">Add Personnel Account</a></li>
                    </ul>
                  </li>
                  
                  <li><a><i class="fa fa-edit"></i>Signatory Management<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="$base_url/systemadmin/schoolmanagement/signatories.php">View Signatories</a></li>
                      <li><a href="$base_url/systemadmin/schoolmanagement/signatory_add.php">Add Signatory</a></li>
                    </ul>
                  </li>
                  
                </ul>
              </div>

            </div>
            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="System Logs" href="$base_url/systemadmin/index.php">
                <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Add Personnel" href="$base_url/systemadmin/personnelmanagement/personnel_add.php">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Add Signatory" href="$base_url/systemadmin/schoolmanagement/signatory_add.php">
                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="$base_url/logout.php">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
<!-- /sidebar menu -->
        </div>
    </div>
SB;
?>
