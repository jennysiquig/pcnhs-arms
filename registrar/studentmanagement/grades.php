<?php $base_url =  "http://".$_SERVER['SERVER_NAME']."/pcnhs.sis"; ?>
<?php require_once "../../resources/config.php"; ?>
<!DOCTYPE html>
<html>
	<head>
		<?php include "$base_url/resources/templates/registrar/header.php"; ?>
	</head>
	<body class="nav-md">
		<!-- Sidebar -->
		<?php include "$base_url/resources/templates/registrar/sidebar.php"; ?>
		<!-- Top Navigation -->
		<?php include "$base_url/resources/templates/registrar/top-nav.php"; ?>
		<div class="right_col" role="main">
			<div class="clearfix"></div>
			<div class="x_panel">
				<div class="x_title">
					<h2>Grades</h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					
				</div>
			</div>
		</div>
		<?php include "$base_url/resources/templates/registrar/footer.php"; ?>
		<?php include "$base_url/resources/templates/registrar/scripts.php"; ?>
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