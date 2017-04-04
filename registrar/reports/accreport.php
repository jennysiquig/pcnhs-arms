<!DOCTYPE html>
<?php require_once "../../resources/config.php"; ?>
<html>
  <head>

    <link rel="stylesheet" href="../../css/accreport.css">
    <title>Accomplishment Report</title>
    <link rel="shortcut icon" href="../../images/pines.png" type="image/x-icon" />
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

    </head>

    <body>

        <div class = "container">
        <div class = "content">
            <div class = "main">

            <div id = heading-1>

            <h4 class="inst">PINES CITY NATIONAL HIGH SCHOOL</h4>
            <h4 class="inst">REGISTRAR'S ACCOMPLISHMENT REPORT</h4>
            <div id="month"></div>
            <div id="year"></div>

            <div id ="report">
                
              <table id="acc-t">
                                
                                <tr id="b1-head">  
                                <th class="b1-col1">AREAS</th>
                                <th class="b1-col2">ACCOMPLISHMENTS</th>
                                </tr>

                                <tr id="b6-r1">
                                    <td class="col">

                                        <p id="td-1-p1">Records and Files Management</p>

                                        <p id="td-1-p2">Good records management is essential for the registrar's office to function effectively. Efficiency, effectiveness and less time consuming are some of the benefits of organized records and files (especially that the registrar's office is using the manual filing).</p>

                                    </td>

                                    <td class="col">

                                        <div id="area1">
                                    
                                 <!--php-->

                                        </div>

                                    </td>

                                </tr>

                                <tr id="b6-r2">
                                    <td class="col">

                                        <p id="td-3-p1">Registrar's Services</p>

                                        <p id="td-3-p2">The registrar's office is responsible in the maintenance of students' permanent academic records, receiving of incoming correspondence, processing of requests and issuance/releasing of school credentials.</p>

                                        <td class="col">

                                        <p id="td-4-p1">Below is the summary of accomplished and released credentials</p>

                                            <table id="item-t">
                                            <tr id="td-4-h">
                                            <th id="th-col1">ITEM</th>
                                            <th id="th-col2">PROCESSED</th>
                                            <th id="th-col3">RELEASED</th>
                                            </tr>

                                            <tr class="td-4-t">
                                            <td class="td-name"></td>
                                            <td class="td-pro"></td>
                                            <td class="td-rel"></td>
                                            </tr>

                                            <tr class="td-4-t">
                                            <td class="td-name"></td>
                                            <td class="td-pro"></td>
                                            <td class="td-rel"></td>
                                            </tr>

                                            </tr>
                                            </table>
                                            
                                        </td>

                                    </td>

                                </tr>

                                <tr id="b6-r3">
                                    <td class="col">

                                        <p id="td-5-p1">FINANCIAL MANAGEMENT</p>

                                        <p id="td-5-p2">Payments are received in the registrar's office upon request or issuance of school credentials except for school to school transaction.</p>

                                    </td>

                                    <td class="col">

                                        <div id="area3">
                                    
                                        <!--php-->

                                        </div>

                                    </td>

                                </tr>

                                <tr id="b6-r4">
                                    <td class="col">

                                        <p id="td-5-p1">Other Tasks</p>

                                    </td>

                                    <td class="td-8">

                                        <div id="area3">
                                    
                                        <!--php-->

                                        </div>

                                    </td>

                                </tr>
                </table>

                                            <div id="box-2">
                            <p id="b2-r1-p1">Prepared by:</p>
                            <div id="b2-r2-name"></div>
                            <div id="b2-r3-pos"></div>
                            </div>

                            <div id="box-3">
                            <p id="b3-r1-p1">Checked by:</p>
                            <div id="b3-r2-name"></div>
                            <div id="b3-r3-pos"></div>
                            </div>

                            <div id="box-4">
                            <p id="b4-r1-p1">Checked &amp; Verified by:</p>
                            <div id="b4-r2-name"></div>
                            <div id="b4-r3-pos"></div>
                            </div>
            </div>
        </div>
        </div>
        </div>
        </div>
        </body>
        </html>

