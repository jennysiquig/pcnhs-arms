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
    		$stud_name = $row['first_name']." ".$row['mid_name'].".  ".$row['last_name'];
    	}
    }

    $school_year = "SELECT max(schl_year) as schl_year from studentsubjects where stud_id = '$stud_id'";
    $ans = $conn->query($school_year);
    if ($ans->num_rows>0) {
      while ($row = $ans->fetch_assoc()) {
        $last_yr_attended = $row['schl_year'];
      }
    }

    $grad_year = explode(" ",$last_yr_attended);
    $yr_ended = $grad_year[2];

    $grad_month = $_POST['grad_month'];
    $grad_day = $_POST['grad_day'];

    $principal = $_POST['signatory_principal'];
    $prin = "SELECT * FROM signatories where sign_id = '$principal'";
    $ans_prin = $conn->query($prin);
    if ($ans_prin->num_rows>0) {
      while ($row = $ans_prin->fetch_assoc()) {
        $prin_name =$row['first_name']." ".$row['mname'].".  ".$row['last_name'];
      }
    }

    $superintendent = $_POST['signatory_superintendent'];
    $super_int = "SELECT * FROM signatories where sign_id = '$superintendent'";
    $ans_sn = $conn->query($super_int);
    if ($ans_sn->num_rows>0) {
      while ($row = $ans_sn->fetch_assoc()) {
        $si_name =$row['first_name']." ".$row['mname'].".  ".$row['last_name'];
      }
    }

    $curr_year = date("Y");

    $curr_principal = "SELECT * FROM SIGNATORIES WHERE yr_ended = '$curr_year'
                        AND position LIKE 'PRINCIPAL';"; 
    $curr_p = $conn->query($curr_principal);
    if ($curr_p->num_rows>0) {
        while ($row = $curr_p->fetch_assoc()) {
          $current_principal = $row['first_name']." ".$row['mname'].".  ".$row['last_name'];
        }
    }

    if ($grad_month === "January") {
          $grad_month_fil = str_replace('January','Enero',$grad_month);
    }else if ($grad_month === "February") {
          $grad_month_fil = str_replace('February','Pebrero',$grad_month);
    }else if ($grad_month === "March")    {
          $grad_month_fil = str_replace('March','Marso',$grad_month);
    }else if ($grad_month === "April")    {
          $grad_month_fil = str_replace('April','Abril',$grad_month);
    }else if ($grad_month === "May")      {
          $grad_month_fil = str_replace('May','Mayo',$grad_month);
    }else if ($grad_month === "June")     {
          $grad_month_fil = str_replace('June','Hunyo',$grad_month);
    }else if ($grad_month === "July")     {
          $grad_month_fil = str_replace('July','Hulyo',$grad_month);
    }else if ($grad_month === "August")   {
          $grad_month_fil = str_replace('August','Agosto',$grad_month);
    }else if ($grad_month === "September"){
          $grad_month_fil = str_replace('September','Setyembre',$grad_month);
    }else if ($grad_month === "October")  {  
          $grad_month_fil = str_replace('October','Oktubre',$grad_month);
    }else if ($grad_month === "November") {
          $grad_month_fil = str_replace('November','Nobyembre',$grad_month);
    }else if ($grad_month === "December") {
          $grad_month_fil = str_replace('December','Disyembre',$grad_month);
    }
	
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

<title>Preview Credential</title>
<head>
    <link href="../../assets/css/diploma.css" rel="stylesheet" >
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
      <style type="text/css" media="print">
       .no-print { display: none; }
      </style>

</head>
<body> 
<page>
<div id="outer">

      <img id="img1" src="../../assets/images/deped.png"> 
      <img id="img2" src="../../assets/images/pines.png"> 

      <br/><br/>
       <span class="text1"> REPUBLIKA NG PILIPINAS </span>
       <br/>
       <span class="subtext"> Republic of the Philippines </span><br/><br/>
       <span class="text1"> KAGAWARAN NG EDUKASYON </span><br/>
       <span class="subtext"> Department of Education </span>
       <br/><br/>
       <span class="text1"> CORDILLERA ADMINISTRATIVE REGION <br/> REHIYON (Region)</span><br/><br/>
       <span class="text1"> SANGAY NG LUNGSOD NG BAGUIO <br/>
                         BAGUIO CITY DIVISION </span><br>

      <span id="big"> PINES CITY NATIONAL HIGH SCHOOL </span><br/>
      <span class="text1"> PAARALAN (School) </span><br/>
      <span class="text3"> Pinatutunayan nito na si </span><br/>
      <span class="text2"> This certifies that </span><br/><br/>
      
       <span id="big2"> <?php echo "$stud_name";?> </span><br/>
    
       <span class="text3">ay kasiya-siyang nakatupad sa mga kinakailangan sa pagtatapas sa kurikulum ng</span><br/>
       <span class="text2"> has satisfactorily completed the requirements for graduation from the</span><br/>
        <span class="text3">Edukasyong Sekundarya na itinakda para sa Mataas na Paaralan ng Republika ng</span><br/>
        <span class="text2"> Secondary Education Curriculum prescribed for High Schools of the Republic of</span><br/>
         <span class="text3">Pilipinas kaya siya'y karapat-dapat na tumanggap nitong</span><br/>
        <span class="text2">The Philippines and is therefore entitled to receive this</span><br/>
        <br/>
        <img src="../../assets/images/katunayan.png" id="img3"> <br/>

        <span class="text3"> Nilagdaan sa Lungsod ng Baguio,Pilipinas ngayong ika- <span id="dd2" name="date"><?php echo "$grad_day";?></span> ng <?php echo "$grad_month_fil";?>, <?php echo "$yr_ended";?> <span="text" id="mm" name="month"></span><span type="text" id="dd" name="year"></span></span><br/>
        <span class="text2"> Signed in Baguio City, Philippines this <span id="dd1" name="date"></span> day of <?php echo "$grad_day";?> <span id="mm1" name="month"><?php echo "$grad_month";?> </span>, <span="text" id="dd1" name="year"><?php echo "$yr_ended";?></span></span><br/><br/>


            <div id="parent">
              <div id="mid"><?php echo "$si_name";?> <br>Superintendent</div>
            </div>
            
            <div id="parent">
              <div id="mid"><?php echo "$prin_name";?> Principal</div>
            </div>
            
            <div id="parent">
              <div id="mid"><?php echo "$current_principal";?> Principal</div>
            </div>


</div>
</div>
</page>      
</body>
</html>