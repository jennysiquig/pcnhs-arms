<!DOCTYPE html>
<?php include('include_files/session_check.php'); ?>
<?php require_once "../../resources/config.php"; ?>
<?php
    $r_fm = "";
    $fm = "";
    $ot = "";
    $personnel_id = $_SESSION['per_id'];
    $signatory1 = "";
    $signatory2 = "";
    if (isset($_POST['r_fm'])){
        $r_fm = $_POST['r_fm'];
    }
    if (isset($_POST['fm'])){
        $fm = $_POST['fm'];
    }
    if (isset($_POST['ot'])){
        $ot = $_POST['ot'];
    }
    if (isset($_POST['personnel_id'])){
        $personnel_id = $_POST['fm'];
    }
    if (isset($_POST['signatory1'])){
        $signatory1 = $_POST['signatory1'];
    }
    if (isset($_POST['signatory2'])){
        $signatory2 = $_POST['signatory2'];
    }


        if(isset($_GET['accomplishment_date'])){
        $statement = "SELECT count(date_processed) as 'date_processed_count', count(date_released) as 'date_released_count' FROM pcnhsdb.requests natural join credentials where (date_released is null or date_released is not null) and date_processed between '$from' and '$to';";
                                        }
            else {
                $accomplishment_date = date('m/d/y').'-'.date('m/d/y');
                $statement = "SELECT count(date_processed) as 'date_processed_count', count(date_released) as 'date_released_count' FROM pcnhsdb.requests natural join credentials where date_released is null or date_released is not null;";
    }


?>

 <?php

             $statement = "SELECT * FROM personnel WHERE per_id='$personnel_id'";
             $result = $conn->query($statement);
             if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $registrar_id = $row['per_id'];
                        $registrar_name = $row['first_name'].' '.substr($row['mname'], 0, 1).'. '.$row['last_name'];
                        $registrar_name = strtoupper($registrar_name);
                        $position_reg = $row['position'];
                        $position_reg = strtolower($position_reg);
                        $position_reg = ucfirst($position_reg);

                        echo $position_reg;
                    }
             }
             ?>

             <?php

             $statement = "SELECT * FROM signatories WHERE sign_id='$signatory1'";
             $result = $conn->query($statement);
             if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $sign_id1 = $row['sign_id'];
                        $sign_name1 = $row['first_name'].' '.substr($row['mname'], 0, 1).'. '.$row['last_name'];
                        $sign_name1 = strtoupper($sign_name1);
                        $position1 = $row['position'];
                        $position1 = strtolower($position1);
                        $position1 = ucfirst($position1);
                    }
             }
             ?>

                          <?php

             $statement = "SELECT * FROM signatories WHERE sign_id='$signatory2'";
             $result = $conn->query($statement);
             if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $sign_id2 = $row['sign_id'];
                        $sign_name2 = $row['first_name'].' '.substr($row['mname'], 0, 1).'. '.$row['last_name'];
                        $sign_name2 = strtoupper($sign_name2);
                        $position2 = $row['position'];
                        $position2 = strtolower($position2);
                        $position2 = ucfirst($position2);
                    }
             }
             ?>

<html>
  <head>

    <link rel="stylesheet" href="../../assets/css/accreport.css">
    <title>Accomplishment Report</title>
    <link rel="shortcut icon" href="../../assets/images/ico/fav.png" type="image/x-icon" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    
    <!-- Datatables -->
    <!-- Custom Theme Style -->
    <link href="../../assets/css/custom.min.css" rel="stylesheet">
    <link href="../../assets/css/tstheme/style.css" rel="stylesheet">

    </head>

    <body>

        <div class = "container">
        <div class = "content">
            <div class = "main">

            <div id = heading-1>

            <h4 class="inst">PINES CITY NATIONAL HIGH SCHOOL</h4>
            <h4 class="inst">REGISTRAR'S ACCOMPLISHMENT REPORT</h4>



            <?php $accomplishment_date = $_SESSION['accomplishment_date'];

                $accomplishment_date = explode("/", $accomplishment_date);

                $a_month = $accomplishment_date[0];
                $a_year = substr($accomplishment_date[2], 0, 4);
                
                if($a_month < 10) {
                    $a_month = substr($a_month, 1, 1);
                }

                $month_array = array('January','February','March','April','May','June','July','August','September','October','November','December');
                    $monthstr = $month_array[$a_month-1]; ?>

            <div id="month"> <?php echo $monthstr; ?> </div>
            <div id="year"> <?php echo $a_year; ?> </div>

            <div id ="report">
                
              <table id="acc-t">
                                
                                <tr id="b1-head">  
                                <th class="b1">AREAS</th>
                                <th class="b1">ACCOMPLISHMENTS</th>
                                </tr>

                                <tr id="b6-r1">
                                    <td class="col">

                                        <p class="td-p1">Records and Files Management</p>

                                        <p class="td-p2">Good records management is essential for the registrar's office to function effectively. Efficiency, effectiveness and less time consuming are some of the benefits of organized records and files (especially that the registrar's office is using the manual filing).</p>

                                    </td>

                                    <td class="col">

                                        <div id="r_fm">
                                    
                                        <?php echo $r_fm; ?>

                                        </div>

                                    </td>

                                </tr>

                                <tr id="b6-r2">
                                    <td class="col">

                                        <p class="td-p1">Registrar's Services</p>

                                        <p class="td-p2">The registrar's office is responsible in the maintenance of students' permanent academic records, receiving of incoming correspondence, processing of requests and issuance/releasing of school credentials.</p>
                                    
                                    </td>


                                    <td class="col">

                                        <p class="td-p">Below is the summary of accomplished and released credentials</p>

                                            <table id="item-t">
                                            <thead>
                                            <th class="item-t-col">ITEM</th>
                                            <th class="item-t-col">PROCESSED</th>
                                            <th class="item-t-col">RELEASED</th>
                                            </thead>

                                    <?php

                                        if(isset($_GET['accomplishment_date'])) {
                                        $accomplishment_date = $_GET['accomplishment_date'];
                

                                        $statement = "SELECT cred_id, count(date_processed) as 'date_processed_count', count(date_released) as 'date_released_count' FROM pcnhsdb.requests natural join credentials where date_released is null or date_released is not null;
";                

                                        }


                                    $result = $conn->query($statement);
                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                            
                                            $processed = $row['date_processed_count'];
                                            $released = $row['date_released_count'];
                                            
                                            }
                                        }

                                        echo  <<<REQ
                                            <tr class="td-4-t">
                                                <td class="name"></td>   
                                                <td class="pro">$processed</td>
                                                <td class="rel">$released</td>
                                                
                                            </tr>
REQ;
?>

                                            
                                            </table>
                                    </td>
                                </tr>

                                <tr id="b6-r3">
                                    <td class="col">

                                        <p class="td-p1">FINANCIAL MANAGEMENT</p>

                                        <p class="td-p2">Payments are received in the registrar's office upon request or issuance of school credentials except for school to school transaction.</p>

                                    </td>

                                    <td class="col">

                                        <div id="fm">
                                    
                                        <?php echo $fm; ?>

                                        </div>

                                    </td>

                                </tr>

                                <tr id="b6-r4">
                                    <td class="col">

                                        <p class="td-p1">Other Tasks</p>

                                    </td>

                                    <td class="col">

                                        <div id="ot">
                                    
                                        <?php echo $ot; ?>

                                        </div>

                                    </td>

                                </tr>
                </table>

                            <div id="box-2">
                            <p id="b2-r1-p1">Prepared by:</p>
                            <div id="b2-r2-name"><?php echo $registrar_name; ?></div>
                            <div id="b2-r3-pos"><p> <?php echo $position_reg; ?> </p></div>
                            </div>

                            <div id="box-3">
                            <p id="b3-r1-p1">Checked by:</p>
                            <div id="b3-r2-name"> <?php echo $sign_name1; ?> </div>
                            <div id="b3-r3-pos"><p> <?php echo $position1; ?></p></div>
                            </div>

                            <div id="box-4">
                            <p id="b4-r1-p1">Verified by:</p>
                            <div id="b4-r2-name"><?php echo $sign_name2; ?></div>
                            <div id="b4-r3-pos"> <p> <?php echo $position2; ?></p> </div>
                            </div>
            </div>
        </div>
        </div>
        </div>
        </div>
        </body>
        </html>

