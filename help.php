<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">



    <!-- Bootstrap -->
    <link href="resources/libraries/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="resources/libraries/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
		<link href="resources/libraries/nprogress/nprogress.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="resources/libraries/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="assets/css/custom.min.css" rel="stylesheet">
    <link href="assets/css/tstheme/style.css" rel="stylesheet">
    <!-- PDFObject -->
    <script src="resources/libraries/PDFObject/pdfobject.min.js"></script>

    <style>
    .pdfobject-container { height: 600px;}
    </style>
  </head>
  <body class="nav-md">
    <!-- Sidebar -->
        <div class="container body">
        <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="help.php" class="site_title"><i class="fa fa-question-circle-o"></i> <span>Help Page</span></a>
                </div>
                <div class="clearfix"></div>
                <!-- menu profile quick info -->
                <!-- /menu profile quick info -->
                <br>
                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section active">
                        <h3>Menu</h3>
                        <ul class="nav side-menu">
                            <li><a href="login.php"><i class="fa fa-home"></i> Back to Main Site</a></li>
                            
                            
                        </ul>
                    </div>
                </div>
                <!-- /sidebar menu -->
            </div>
        </div>
        <!-- Top Navigation -->
        <div class="top_nav">
        <div class="nav_menu no-print">
            <nav>
                <div class="nav toggle">
                    <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <li class="">
                        <a class="user-profile">PCNHS ARMS</a>
                        
                    </li>
                    
                </ul>
            </li>
        </ul>
    </nav>
    </div>
    </div>
    <div class="right_col" role="main">
      <!-- Content -->
      <div id="pdf1">

      </div>



      <!-- Content -->
      <div class="clearfix"></div>
    </div>
    <!-- Footer -->
    <?php include "resources/templates/registrar/footer.php"; ?>

    <!-- Scripts -->
    <!-- jQuery -->
    <script src="resources/libraries/jquery/dist/jquery.min.js" ></script>
    <!-- Bootstrap -->
    <script src="resources/libraries/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src= "resources/libraries/fastclick/lib/fastclick.js"></script>
    <!-- input mask -->
    <script src= "resources/libraries/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
    <script src= "resources/libraries/parsleyjs/dist/parsley.min.js"></script>
    <!-- NProgress -->
    <script src="resources/libraries/nprogress/nprogress.js"></script>
    <!-- Custom Theme Scripts -->
    <script src= "assets/js/custom.min.js"></script>
    <!-- Scripts -->
    <script type="text/javascript">
        PDFObject.embed("resources/files/MANUAL.pdf", "#pdf1");
    </script>
  </body>
</html>
