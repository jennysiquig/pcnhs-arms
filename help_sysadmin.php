<!DOCTYPE html>
<?php
    session_start();
    // Session Timeout
    $time = time();
    $session_timeout = 1800; //seconds
    
    if(isset($_SESSION['last_activity']) && ($time - $_SESSION['last_activity']) > $session_timeout) {
      session_unset();
      session_destroy();
      session_start();
    }

   if(isset($_SESSION['logged_in']) && isset($_SESSION['account_type'])){

    }else {
        header('Location: ../../login.php');
    }
    
 ?>
<html>
    <head>
        <title>System Admin Help</title>
        <link rel="shortcut icon" href="assets/images/pines.png" type="image/x-icon" />
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
        <!-- Date Range Picker -->
        <link href="resources/libraries/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
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
            <?php include "resources/templates/admin/sidebar.php"; ?>
            <?php include "resources/templates/admin/top-nav.php"; ?>
            <!-- Content Start -->
 
        <div class="right_col" role="main">
        <!-- Content -->
            <div id="pdf1">

            </div>
                <!-- Content -->
                <div class="clearfix"></div>
        </div>
            <!-- Content End -->
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
    <!-- Date Range Picker -->
    <script src="resources/libraries/moment/min/moment.min.js"></script>
    <script src="resources/libraries/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- Custom Theme Scripts -->
    <script src= "assets/js/custom.min.js"></script>
    <!-- Scripts -->
    <script type="text/javascript">
        PDFObject.embed("resources/files/ebook.pdf", "#pdf1");
    </script>
    </body>
</html>