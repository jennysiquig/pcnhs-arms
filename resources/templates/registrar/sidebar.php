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
              <a href="$base_url/registrar/index.php" class="site_title"><i class="fa fa-book"></i> <span>PCNHS SIS</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile">
              <div class="profile_pic">
                <img src="$base_url/images/icon-user-default.png" alt="Registrar" class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>Registrar</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="$base_url/registrar/index.php">Dashboard</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i>Student Management<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="$base_url/registrar/studentmanagement/student_add.php">Add Student Record</a></li>
                      <li><a href="$base_url/registrar/studentmanagement/student_list.php">Student List</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-university"></i>School Management<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="$base_url/registrar/schoolmanagement/curriculum.php">Curriculum</a></li>
                      <li><a href="$base_url/registrar/schoolmanagement/credentials.php">Credentials</a></li>
                      <li><a href="$base_url/registrar/schoolmanagement/student_subjects.php">Student Subjects</a></li>
                      <li><a href="$base_url/registrar/schoolmanagement/student_programs.php">Student Programs</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-check"></i>Credential Status<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="$base_url/registrar/credentials/credential_status.php?status=uc">Unclaimed Credentials</a></li>
                      <li><a href="$base_url/registrar/credentials/released.php">Released Credentials</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-desktop"></i>Reports<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="$base_url/registrar/reports/transaction.php">Transaction Reports</a></li>
                      <li><a href="$base_url/registrar/reports/accomplishment.php">Accomplishment Reports</a></li>
                    </ul>
                  </li>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a href="../registrar" data-toggle="tooltip" data-placement="top" title="Home">
                <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
              </a>
              <a href="../registrar/studentmanagement/student_list.php" data-toggle="tooltip" data-placement="top" title="Search">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Reports">
                <span class="fa fa-desktop" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>
SB;
?>
