<?php
   //$base_url =  "http://".$_SERVER['SERVER_NAME']."/pcnhs.sis";
    $base_url = dirname(__file__);
	echo <<<SC
	<!-- jQuery -->
    <script src="$base_url/resources/libraries/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="$base_url/resources/libraries/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="$base_url/resources/libraries/fastclick/lib/fastclick.js"></script>
   

    <!-- input mask -->
    <script src="$base_url/resources/libraries/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>

   
    <script src="$base_url/resources/libraries/parsleyjs/dist/parsley.min.js"></script>
    

    <!-- Custom Theme Scripts -->
    <script src="$base_url/js/custom.min.js"></script>


SC;

?>