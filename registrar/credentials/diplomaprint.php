<!DOCTYPE html>
<?php require_once "../../resources/config.php"; ?>
<?php ob_start(); ?>
<?php session_start(); ?>
<?php $stud_id = htmlspecialchars($_GET['stud_id'], ENT_QUOTES) ?>
<?php
    if(!isset($_SESSION['generated_diploma'])) {
      $_SESSION['generated_diploma'] = true;
    }else {
        if($_SESSION['generated_diploma']) {
          unset($_SESSION['generated_diploma']);
          header("location: ../index.php");
          die();
        }
    }
    $stud_id = $_GET['stud_id'];
    $query = "SELECT * FROM students where stud_id = '$stud_id'";

    $result = $conn->query($query);
    if ($result->num_rows>0 ) {
    	while($row = $result->fetch_assoc()) {
    		$stud_name = $row['first_name']." ".$row['mid_name']." ".$row['last_name'];
    	}
    }
	date_default_timezone_set('Asia/Manila');
    $curr_day = date("d");
    $curr_month = date("M");
    $curr_month2 = date("F");
    $curr_year = date("Y");

    $curr_month = str_replace('Jan','Enero',$curr_month);
    $curr_month = str_replace('Feb','Pebrero',$curr_month);
    $curr_month = str_replace('Mar','Marso',$curr_month);
    $curr_month = str_replace('Apr','Abril',$curr_month);
    $curr_month = str_replace('May','Mayo',$curr_month);
    $curr_month = str_replace('Jun','Hunyo',$curr_month);
    $curr_month = str_replace('Jul','Hulyo',$curr_month);
    $curr_month = str_replace('Aug','Agosto',$curr_month);
    $curr_month = str_replace('Sep','Setyembre',$curr_month);
    $curr_month = str_replace('Oct','Oktubre',$curr_month);
    $curr_month = str_replace('Nov','Nobyembre',$curr_month);
    $curr_month = str_replace('Dec','Disyembre',$curr_month);
	
// 	Insert request to DB
    
    $stud_id = $_GET['stud_id'];
	   $cred_id = htmlspecialchars($_POST['credential'], ENT_QUOTES);
    $request_type = htmlspecialchars($_POST['request_type'], ENT_QUOTES);
    $signatory_1 = htmlspecialchars($_POST['signatory_principal'], ENT_QUOTES);
    $signatory_2 = htmlspecialchars($_POST['signatory_superintendent'], ENT_QUOTES);
    $personnel_id = htmlspecialchars($_SESSION['per_id'], ENT_QUOTES);
    $date = htmlspecialchars($_POST['date'], ENT_QUOTES);
    $admitted_to = htmlspecialchars($_POST['admitted_to'], ENT_QUOTES);
    $request_purpose = strtoupper(htmlspecialchars($_POST['request_purpose']));
    //$remarks = htmlspecialchars($_POST['remarks'], ENT_QUOTES);
    
    if(isset($_POST['admitted_to'])) {
        $admitted_to = htmlspecialchars($_POST['admitted_to'], ENT_QUOTES);
    }else {
        $admitted_to = "";
    }
    
    if(empty($admitted_to)) {
        $admitted_to = "N/A";
    }
    
	
	$checkpending = "SELECT * FROM pcnhsdb.requests where status = 'p' and stud_id = '$stud_id' and cred_id = '$cred_id' order by req_id desc limit 1;";
    $result = $conn->query($checkpending);
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $req_id = $row['req_id'];
            $update = "UPDATE `pcnhsdb`.`requests` SET `request_type`='$request_type', `status`='u' ,`admitted_to` = '$admitted_to' , `sign_id`='$signatory_1', `second_sign_id`='$signatory_2' WHERE `req_id`='$req_id';";

            mysqli_query($conn, $update);
        }
    }else {
         $statement1 = "INSERT INTO `pcnhsdb`.`requests` (`cred_id`, `stud_id`, `request_type`, `status`, `date_processed`, `admitted_to`, `request_purpose`, `sign_id`, second_sign_id, `per_id`) VALUES ('$cred_id', '$stud_id', '$request_type', 'u', '$date', '$admitted_to', '$request_purpose' ,'$signatory_1','$signatory_2', '$personnel_id');";
         echo $statement1;
        mysqli_query($conn, $statement1);
    }
 
?>
    

<html>

<head>
      <title>Preview Credential</title>
      <link rel="shortcut icon" href="../../assets/images/ico/fav.png" type="image/x-icon" />
      <link rel="stylesheet" href="../../assets/css/diploma.css">
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <link href="../../assets/css/diploma.css" rel="stylesheet">
    
      <style type="text/css" media="print">
       .no-print { display: none; }
      </style>

</head>
<body class="nav-md">
<div id="outer">
      

      <br/><br/>
       <span class="text1"> REPUBLIKA NG PILIPINAS </span>
       <br/>
       <span class="subtext"> Republic of the Philippines </span><br/><br/>
       <span class="text1"> KAGAWARAN NG EDUKASYON </span><br/>
       <span class="subtext"> Department of Education </span>
       <br/><br/>
       <span class="text1"> CORDILLERA ADMINISTRATIVE REGION <br/> REHIYON (Region)</span><br/><br/>
       <span class="text1"> SANGAY NG LUNGSOD NG BAGUIO <br/> BAGUIO CITY DIVISION </span><br/>

      <span id="big"> PINES CITY NATIONAL HIGH SCHOOL </span><br/>
      <span class="text1"> PAARALAN (School) </span><br/>
      <span class="text3"> Pinatutunayan nito na si </span><br/>
      <span class="text2"> This certifies that </span><br/><br/>
      
    	<span class="text3"> <?php echo "$stud_name";?></span><br/><br/>
       <span class="text3">ay kasiya-siyang nakatupad sa mga kinakailangan sa pagtatapas sa kurikulum ng</span><br/>
       <span class="text2"> has satisfactorily completed the requirements for graduation from the</span><br/>
        <span class="text3">Edukasyong Sekundarya na itinakda para sa Mataas na Paaralan ng Republika ng</span><br/>
        <span class="text2"> Secondary Education Curriculum prescribed for High Schools of the Republic of</span><br/>
         <span class="text3">Pilipinas kaya siya'y karapat-dapat na tumanggap nitong</span><br/>
        <span class="text2">The Philippines and is therefore entitled to receive this</span><br/>
        <br/>
        <img src="../../assets/images/katunayan.png" id="img3"> <br/>

        <span class="text3"> Nilagdaan sa Lungsod ng Baguio, Pilipinas ngayong ika-
        <span id="dd" name="date"><?php echo "$curr_day";?></span> ng 
        <span="text" id="mm" name="month"><?php echo "$curr_month";?>, 
    	</span><span type="text" id="dd" name="year"><?php echo "$curr_year";?></span>
    	</span><br/>
        <span class="text2"> Signed in Baguio City, Philippines this <span id="dd1" name="date"></span> day of 
        <span id="mm1" name="month"><?php echo "$curr_month2";?> <?php echo "$curr_day";?> </span>,
        <span="text" id="dd1" name="year"><?php echo "$curr_year";?></span></span><br/><br/>
			</div>
		</div>
	</body>

	 <div class="row no-print">
        <div class="col-md-8">
          <a href="../../registrar" class="btn btn-success pull-right"><i class="fa fa-home"></i> Back to Home</a>
          <button class="btn btn-success pull-right" onclick="window.print()"><i class="fa fa-print"></i>  Print</button>
        </div>
      </div>

</html>