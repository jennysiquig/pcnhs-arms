<?php require_once "../../resources/config.php"; ?>
<!DOCTYPE html>
<?php $stud_id = $_GET['stud_id'] ?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		
		
		<!-- Bootstrap -->
		<link href="../../resources/libraries/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
		<!-- Font Awesome -->
		<link href="../../resources/libraries/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		
		<!-- Datatables -->
		<link href="../../resources/libraries/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
		
		<!-- Custom Theme Style -->
		<link href="../../css/custom.min.css" rel="stylesheet">
		<link href="../../css/tstheme/style.css" rel="stylesheet">
		
		<!--[if lt IE 9]>
		<script src="../js/ie8-responsive-file-warning.js"></script>
		<![endif]-->
		
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body class="nav-md">
		<!-- Sidebar -->
		<?php include "../../resources/templates/registrar/sidebar.php"; ?>
		<!-- Top Navigation -->
		<?php include "../../resources/templates/registrar/top-nav.php"; ?>
		<div class="right_col" role="main">
			<div class="clearfix"></div>
			<div class="x_panel">
				<div class="x_title">
					<h2>Grades</h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
				<!-- First Sample -->
					<div class="col-md-6 col-sm-6 col-xs-12">
		                <div class="x_panel">
		                  <div class="x_title">
		                    <h2>Year Level: 1<small>School Year: 2010-2011</small></h2>
		                    <div class="clearfix"></div>
		                  </div>
		                  <div class="x_content">
		                  	
		                    <table class="table table-bordered">
		                      <thead>
		                        <tr>
		                          <th>Subject</th>
		                          <th>Subject Level</th>
		                          <th>Final Grade</th>
		                          <th>Unit</th>
		                          <th>Remarks</th>
		                        </tr>
		                      </thead>
		                      <tbody>
		                        <tr>
		                          <th scope="row">Filipino</th>
		                          <td>1</td>
		                          <td>89</td>
		                          <td></td>
		                          <td></td>
		                        </tr>
		                      </tbody>
		                    </table>
		                    <h2>Average Grade:</h2>
		                  </div>
		                </div>
		              </div>
				<!-- First Sample -->
				<!-- First Sample -->
					<div class="col-md-6 col-sm-6 col-xs-12">
		                <div class="x_panel">
		                  <div class="x_title">
		                    <h2>Year Level: 2<small>School Year: 2011-2012</small></h2>
		                    <div class="clearfix"></div>
		                  </div>
		                  <div class="x_content">
		                  	
		                    <table class="table table-bordered">
		                      <thead>
		                        <tr>
		                          <th>Subject</th>
		                          <th>Subject Level</th>
		                          <th>Final Grade</th>
		                          <th>Unit</th>
		                          <th>Remarks</th>
		                        </tr>
		                      </thead>
		                      <tbody>
		                        <tr>
		                          <th scope="row">Filipino</th>
		                          <td>1</td>
		                          <td>89</td>
		                          <td></td>
		                          <td></td>
		                        </tr>
		                      </tbody>
		                    </table>
		                    <h2>Average Grade:</h2>
		                  </div>
		                </div>
		              </div>
				<!-- First Sample -->
				<!-- First Sample -->
					<div class="col-md-6 col-sm-6 col-xs-12">
		                <div class="x_panel">
		                  <div class="x_title">
		                    <h2>Year Level: 3<small>School Year: 2012-2013</small></h2>
		                    <div class="clearfix"></div>
		                  </div>
		                  <div class="x_content">
		                  	
		                    <table class="table table-bordered">
		                      <thead>
		                        <tr>
		                          <th>Subject</th>
		                          <th>Subject Level</th>
		                          <th>Final Grade</th>
		                          <th>Unit</th>
		                          <th>Remarks</th>
		                        </tr>
		                      </thead>
		                      <tbody>
		                        <tr>
		                          <th scope="row">Filipino</th>
		                          <td>1</td>
		                          <td>89</td>
		                          <td></td>
		                          <td></td>
		                        </tr>
		                      </tbody>
		                    </table>
		                    <h2>Average Grade:</h2>
		                  </div>
		                </div>
		              </div>
				<!-- First Sample -->
				<!-- First Sample -->
					<div class="col-md-6 col-sm-6 col-xs-12">
		                <div class="x_panel">
		                  <div class="x_title">
		                    <h2>Year Level: 4<small>School Year: 2013-2014</small></h2>
		                    <div class="clearfix"></div>
		                  </div>
		                  <div class="x_content">
		                  	
		                    <table class="table table-bordered">
		                      <thead>
		                        <tr>
		                          <th>Subject</th>
		                          <th>Subject Level</th>
		                          <th>Final Grade</th>
		                          <th>Unit</th>
		                          <th>Remarks</th>
		                        </tr>
		                      </thead>
		                      <tbody>
		                        <tr>
		                          <th scope="row">Filipino</th>
		                          <td>1</td>
		                          <td>89</td>
		                          <td></td>
		                          <td></td>
		                        </tr>
		                      </tbody>
		                    </table>
		                    <h2>Average Grade:</h2>
		                  </div>
		                </div>
		              </div>
				<!-- First Sample -->
              		<div class="clearfix"></div>
              		<a class="btn btn-success pull-right" href=<?php echo "../../registrar/studentmanagement/add_grades.php?stud_id=$stud_id" ?>><i class="fa fa-plus m-right-xs"></i> Add Grades</a>
				</div>
			</div>
		</div>
		<?php include "../../resources/templates/registrar/footer.php"; ?>
		<!-- Scripts -->
		<!-- jQuery -->
		<script src="../../resources/libraries/jquery/dist/jquery.min.js" ></script>
		<!-- Bootstrap -->
		<script src="../../resources/libraries/bootstrap/dist/js/bootstrap.min.js"></script>
		<!-- FastClick -->
		<script src= "../../resources/libraries/fastclick/lib/fastclick.js"></script>
		<!-- input mask -->
		<script src= "../../resources/libraries/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
		<script src= "../../resources/libraries/parsleyjs/dist/parsley.min.js"></script>
		<!-- Custom Theme Scripts -->
		<script src= "../../js/custom.min.js"></script>
		<!-- Scripts -->
		<!-- validator -->
		<script>
		// initialize the validator function
		validator.message.date = 'not a real date';
		// validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
		$('form')
		.on('blur', 'input[required], input.optional, select.required', validator.checkField)
		.on('change', 'select.required', validator.checkField)
		.on('keypress', 'input[required][pattern]', validator.keypress);
		$('.multi.required').on('keyup blur', 'input', function() {
		validator.checkField.apply($(this).siblings().last()[0]);
		});
		$('form').submit(function(e) {
		e.preventDefault();
		var submit = true;
		// evaluate the form using generic validaing
		if (!validator.checkAll($(this))) {
		submit = false;
		}
		if (submit)
		this.submit();
		return false;
		});
		</script>
		<!-- /validator -->
		<!-- jquery.inputmask -->
		<script>
		$(document).ready(function() {
		$(":input").inputmask();
		});
		</script>
		<!-- /jquery.inputmask -->
		<!-- <script type="text/javascript">
			// function showSubjects(base_url) {
								// 	var curriculum = document.getElementById("curriculum").value;
								// 	alert(base_url+"?curr_id="+curriculum);
								// 	document.getElementById("subj1").innerHTML = "";
			// }
		</script> -->
		<script>
		function showSubjects() {
		var xhttp = new XMLHttpRequest();
		var curriculum = document.getElementById("curriculum").value;
		xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
		document.getElementById("subj1").innerHTML =
		this.responseText;
		}
		};
		xhttp.open("GET", "showsubjects.php?curr_id="+curriculum, true);
		xhttp.send();
		}
		</script>
	</body>
</html>