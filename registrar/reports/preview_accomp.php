<!DOCTYPE html>
<?php include('include_files/session_check.php'); ?>
<?php require_once "../../resources/config.php"; ?>
<?php
    $r_fm = "";
    $fm   = "";
    $ot   = "";
    if (isset($_POST['r_fm'])) {
        $r_fm = $_POST['r_fm'];
    }
    if (isset($_POST['fm'])) {
        $fm = $_POST['fm'];
    }
    if (isset($_POST['ot'])) {
        $ot = $_POST['ot'];
    }

?>

<html>
  <head>

    <title>Accomplishment Report</title>
    <link rel="shortcut icon" href="../../assets/images/ico/fav.png" type="image/x-icon" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <!-- Bootstrap -->
    <link href="../../resources/libraries/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
    <link href="../../resources/libraries/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Datatables -->
    <!-- Custom Theme Style -->
    <link href="../../assets/css/custom.min.css" rel="stylesheet">
    <link href="../../assets/css/tstheme/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/accreport.css">
    <style type="text/css" media="print">
           .no-print { display: none; }
        </style>
    </head>

    <body>

        <div class = "container">
        <div class = "content">
            <div class = "main">

            <div id = heading-1>

            <h4 class="inst">PINES CITY NATIONAL HIGH SCHOOL</h4>
            <h4 class="inst">REGISTRAR'S ACCOMPLISHMENT REPORT</h4>

            <div id="month"> 
                <?php 
                    $accomplishment_date = $_POST['accomplishment_date'];
                    //echo $accomplishment_date;
                    $from_and_to_date = explode("-", $accomplishment_date);
                    $sqldate_format_from = explode("/", $from_and_to_date[0]);
                    $m = $sqldate_format_from[0];
                    $d = $sqldate_format_from[1];
                    $y = $sqldate_format_from[2];
                    $m = preg_replace('/\s+/', '', $m);
                    $d = preg_replace('/\s+/', '', $d);
                    $y = preg_replace('/\s+/', '', $y);
                    $from = $y."-".$m."-".$d;
                    $month_array = array('January','February','March','April','May','June','July','August','September','October','November','December');
                    $m = $month_array[$m-1];
                    echo $m.' '.$y; 

                ?> 

            </div>
                
              <table class="table-1">
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
                            <?php
                                echo "<p style='word-break: break-all;'>$r_fm</p>"; 
                            ?>
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
                        <table style="width: 290px; margin: 20px; text-align: center;">
                            <thead>
                                <th class="item-t-col">ITEM</th>
                                <th class="item-t-col">PROCESSED</th>
                                <th class="item-t-col">RELEASED</th>
                            </thead>
                            <tbody>
                                    <?php
    
                                         $statement = "SELECT * FROM pcnhsdb.credentials;";
                                            $result = $conn->query($statement);
                                            if($result->num_rows>0){
                                                while ($row=$result->fetch_assoc()) {
                                                    $cred_id = $row['cred_id'];
                                                    $cred_name = $row['cred_name'];

                                                    echo    '<tr class="odd pointer">';
                                                    echo        "<td class=''>$cred_name</td>";

                                                     if(isset($_POST['accomplishment_date'])) {
                                                        $accomplishment_date = $_POST['accomplishment_date'];
                                                        //echo $accomplishment_date;
                                                        $from_and_to_date = explode("-", $accomplishment_date);
                                                        $sqldate_format_from = explode("/", $from_and_to_date[0]);
                                                        $m = $sqldate_format_from[0];
                                                        $d = $sqldate_format_from[1];
                                                        $y = $sqldate_format_from[2];
                                                        $m = preg_replace('/\s+/', '', $m);
                                                        $d = preg_replace('/\s+/', '', $d);
                                                        $y = preg_replace('/\s+/', '', $y);

                                                        $from = $y."-".$m."-".$d;

                                                        $sqldate_format_to = explode("/", $from_and_to_date[1]);
                                                        $m = $sqldate_format_to[0];
                                                        $d = $sqldate_format_to[1];
                                                        $y = $sqldate_format_to[2];
                                                        $m = preg_replace('/\s+/', '', $m);
                                                        $d = preg_replace('/\s+/', '', $d);
                                                        $y = preg_replace('/\s+/', '', $y);

                                                        $to = $y."-".$m."-".$d;
                                                        //echo $accomplishment_date;

                                                        $statement = "SELECT count(date_processed) as 'date_processed_count', count(date_released) as 'date_released_count' FROM pcnhsdb.requests natural join credentials where (date_released is null or date_released is not null) and date_processed between '$from' and '$to' and credentials.cred_id = $cred_id";
                                                        }

                                                        $result_1 = $conn->query($statement);
                                                        if ($result_1->num_rows > 0) {
                                                            // output data of each row
                                                            while($row_1 = $result_1->fetch_assoc()) {
                                                                
                                                                $date_processed_count = $row_1['date_processed_count'];
                                                                $date_released_count = $row_1['date_released_count'];
                                                            echo <<<REQ
                                                                
                                                                    <td class=" ">$date_processed_count</td>
                                                                    <td class=" ">$date_released_count</td>
                                                                
REQ;
                                                                

                                                            }
                                                        }
                                                    echo    "</tr>";
                                                    }
                                                }
                                                
                                            ?>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="col">

                                        <p class="td-p1">FINANCIAL MANAGEMENT</p>

                                        <p class="td-p2">Payments are received in the registrar's office upon request or issuance of school credentials except for school to school transaction.</p>

                                    </td>

                                    <td class="col">

                                        <div id="fm">
                                            <?php
                                                echo "<p>$fm</p>"; 
                                            ?>
                                        </div>

                                    </td>

                                </tr>

                                <tr id="b6-r4">
                                    <td class="col">

                                        <p class="td-p1">Other Tasks</p>

                                    </td>

                                    <td class="col">

                                        <div id="ot">
                                        <?php
                                            echo "<p style='word-break: break-all;'>$ot</p>"; 
                                        ?>
                                        </div>

                                    </td>

                                </tr>
                            </table>
                            <?php
                            $personnel_id = $_SESSION['per_id'];
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
                                    }
                             }
                             ?>
                            <?php
                            $signatory_1 = $_POST['signatory_1'];
                             $statement1 = "SELECT * FROM signatories WHERE sign_id='$signatory_1'";
                             $result1 = $conn->query($statement1);
                             if ($result1->num_rows > 0) {
                                    while($row1 = $result1->fetch_assoc()) {
                                        $sign_id1 = $row1['sign_id'];
                                        $sign_name1 = $row1['first_name'].' '.substr($row1['mname'], 0, 1).'. '.$row1['last_name'];
                                        $sign_name1 = strtoupper($sign_name1);
                                        $position1 = $row1['position'];
                                        $position1 = strtolower($position1);
                                        $position1 = ucfirst($position1);
                                    }
                             }
                             ?>
                            <?php
                            $signatory_2 = $_POST['signatory_2'];
                             $statement2 = "SELECT * FROM signatories WHERE sign_id='$signatory_2'";
                             $result2 = $conn->query($statement1);
                             if ($result2->num_rows > 0) {
                                    while($row2 = $result2->fetch_assoc()) {
                                        $sign_id2 = $row2['sign_id'];
                                        $sign_name2 = $row2['first_name'].' '.substr($row2['mname'], 0, 1).'. '.$row2['last_name'];
                                        $sign_name2 = strtoupper($sign_name2);
                                        $position2 = $row2['position'];
                                        $position2 = strtolower($position2);
                                        $position2 = ucfirst($position2);
                                    }
                             }
                             ?>                             
                            <div id="box-2">
                                <p id="b2-r1-p1">Prepared by:</p>
                                <div id="b2-r2-name"><p><?php echo $registrar_name; ?></p></div>
                                <div id="b2-r3-pos"><p><?php echo $position_reg; ?></p></div>
                            </div>
                            <div id="box-3">
                                <p id="b3-r1-p1">Checked by:</p>
                                <div id="b3-r2-name"><p><?php echo $sign_name1; ?></p></div>
                                <div id="b3-r3-pos"><p><?php echo $position1; ?></p></div>
                            </div>
                            <div id="box-4">
                                <p id="b4-r1-p1">Checked &amp; Verified by:</p>
                                <div id="b4-r2-name"><p><?php echo $sign_name2; ?></p></div>
                                <div id="b4-r3-pos"><p><?php echo $position2; ?></p></div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                
        </div>

        <div class="row no-print">
        <br>
        <div class="col-md-8">
          <a href="../../registrar" class="btn btn-success pull-right"><i class="fa fa-home"></i> Back to Home</a>
          <button class="btn btn-success pull-right" onclick="window.print()"><i class="fa fa-print"></i> Print</button>
        </div>
      </div>
    </body>
</html>

