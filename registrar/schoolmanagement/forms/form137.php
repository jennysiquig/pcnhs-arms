<!DOCTYPE html>
<?php require_once "../../../resources/config.php"; ?>

<?php 


if (!$conn) { 
 die('Could not connect to MySQL: ' . mysqli_error());
}

?>

<html>
  <head>

  <link rel="stylesheet" href="../../../css/form137print.css">

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    
    
    <!-- Bootstrap -->
    <link href="../../../resources/libraries/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../../../resources/libraries/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    
    <!-- Datatables -->
    <link href="../../../resources/libraries/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom Theme Style -->
    <link href="../../../css/custom.min.css" rel="stylesheet">
    <link href="../../../css/tstheme/style.css" rel="stylesheet">

    </head>

    <body>

        <div class = "container">
        <div class = "content">
            <div class = "main">
                    <img src="../../../images/doe.png" id="img-1"></img>
                    <img src="../../../images/p.jpg" id="img-2"></img>
                <div id = heading-1>
                    <!--DepEd logo and PCNHS logo-->
                    
                    <h4 class = "inst">Republic of the Philippines</h4>
                    <h4 class = "inst">Department of Education</h4>
                    <h4 class = "inst">Cordillera Administrative Region</h4>
                    <h4 class = "inst">PINES CITY NATIONAL HIGH SCHOOL</h4>
                    <h3 class = "info">Palma Street,     Baguio City</h3>
                    <h3 class = "info">Tel.Nos. (074) 445-5937 / (074) 304-1124</h3>
                </div>


                <p id = "formname">FORM 137-A (K-12 Curriculum)</p>

                <!--box-1-->
                <div id = "box-1">
                    
                    <p id = "b1-r1-p1">Name:</p>            
                        <div id = "b1-r1-d1" class="underline">
                            
                        </div>

                    <p id = "b1-r1-p2">Date of Birth:</p>

                    <p id="b1-r1-p3">Year:</p>
                        <div id ="b1-r1-d2" class="underline">
                            
                        </div>
                    
                    <p id="b1-r1-p4">Month:</p>
                        <div id="b1-r1-d3" class="underline">
                            
                        </div>

                    <p id="b1-r1-p5">Day:</p>
                        <div id="b1-r1-d4" class="underline">
                            
                        </div>
                   

                    <p id="b1-r2-p1">Place of Birth:</p>
                    

                    <p id="b1-r2-p2">Province:</p>
                        <div id="b1-r2-d1" class="underline">
                            
                        </div>
                    

                    <p id="b1-r2-p3">Municipality/City:</p>
                        <div id="b1-r2-d2" class="underline">
                            
                        </div>
                    

                    <p id="b1-r2-p4">Barangay:</p>
                        <div id="b1-r2-d3" class="underline">
                            
                        </div>
                       
                    

                    <p id="b1-r3-p1">Parent/Guardian:</p>
                        <div id="b1-r3-d1" class="underline">
                            
                        </div>
                    

                    <p id="b1-r3-p2">Occupation:</p>
                        <div id="b1-r3-d2" class="underline">
                            
                        </div>
                    

                    <p id="b1-r4-p1">Address of Parent/Guardian:</p>
                        <div id="b1-r4-d1" class="underline">
                            
                        </div>
                    

                    <p id="b1-r5-p1">Elementary Course Completed:</p>
                        <div id="b1-r5-d1" class="underline">
                            
                        </div>
                    

                    <p id="b1-r5-p2"></p>
                        <div id="b1-r5-d2" class="underline">
                            
                        </div>
                    

                    <p id="b1-r5-p3">Year:</p>
                        <div id="b1-r5-d3" class="underline">
                            
                        </div>
                    

                    <p id="b1-r6-p1">LRN:</p>
                        <div id="b1-r6-d1" class="underline">
                            
                        </div>
                    
                   </div>

                   <span></span>
                   <!--end of box-1-->

                   <!--box-2-->
                    <div id = "box-2" class="gr">

                            <div id="info">

                                <p id="b2-r1-p1">School:</p>
                                    <div id="b2-r1-d1" class="underline"></div>
                                

                                <p id="b2-r2-p1">Grade:</p>
                                    <div id="b2-r2-d1" class="underline"></div>
                                

                                <p id="b2-r2-p2">School Year:</p>
                                    <div id="b2-r2-d2" class="underline"></div>
                                

                            </div>

                            <div id="1st-yr">

                                <table id="1st-t">
                                
                                <tr id="b2-r3-head">  
                                <th class="col1">SUBJECT</th>
                                <th class="col2">Final Rating</th>
                                <th class="col3">Action Taken</th>
                                </tr>

                                <tr id="b2-r4">  
                                <td class="subj">sample</td> <!-- subject -->
                                <td class="fr"></td> <!-- final rating -->
                                <td class="at"></td> <!-- Action Taken -->
                                </tr>

                                <tr id="b2-r5">  
                                <td class="subj"></td> <!-- subject -->
                                <td class="fr"></td> <!-- final rating -->
                                <td class="at"></td> <!-- Action Taken -->
                                </tr>

                                <tr id="b2-r6">  
                                <td class="subj"></td> <!-- subject -->
                                <td class="fr"></td> <!-- final rating -->
                                <td class="at"></td> <!-- Action Taken -->
                                </tr>

                                <tr id="b2-r7">  
                                <td class="subj"></td> <!-- subject -->
                                <td class="fr"></td> <!-- final rating -->
                                <td class="at"></td> <!-- Action Taken -->
                                </tr>

                                <tr id="b2-r8">  
                                <td class="subj"></td> <!-- subject -->
                                <td class="fr"></td> <!-- final rating -->
                                <td class="at"></td> <!-- Action Taken -->
                                </tr>

                                <tr id="b2-r9">  
                                <td class="subj"></td> <!-- subject -->
                                <td class="fr"></td> <!-- final rating -->
                                <td class="at"></td> <!-- Action Taken -->
                                </tr>

                                <tr id="b2-r10">  
                                <td class="subj"></td> <!-- subject -->
                                <td class="fr"></td> <!-- final rating -->
                                <td class="at"></td> <!-- Action Taken -->
                                </tr>

                                <tr id="b2-r11">  
                                <td class="subj"></td> <!-- subject -->
                                <td class="fr"></td> <!-- final rating -->
                                <td class="at"></td> <!-- Action Taken -->
                                </tr>

                                <tr id="b2-r12">  
                                <td class="subj"></td> <!-- subject -->
                                <td class="fr"></td> <!-- final rating -->
                                <td class="at"></td> <!-- Action Taken -->
                                </tr>

                                <tr id="b2-r13">  
                                <td class="subj"></td> <!-- subject -->
                                <td class="fr"></td> <!-- final rating -->
                                <td class="at"></td> <!-- Action Taken -->
                                </tr>

                                <tr id="b2-r14">  
                                <td class="subj"></td> <!-- subject -->
                                <td class="fr"></td> <!-- final rating -->
                                <td class="at"></td> <!-- Action Taken -->
                                </tr>

                                <tr id="b2-r15">  
                                <td class="subj"></td> <!-- subject -->
                                <td class="fr"></td> <!-- final rating -->
                                <td class="at"></td> <!-- Action Taken -->
                                </tr>

                                <tr id="b2-r16">  <!-- additional subject -->
                                <td class="subj"></td> <!-- subject -->
                                <td class="fr"></td> <!-- final rating -->
                                <td class="at"></td> <!-- Action Taken -->
                                </tr>

                                <tr id="b2-r17">  <!-- additional subject -->
                                <td class="subj"></td> <!-- subject -->
                                <td class="fr"></td> <!-- final rating -->
                                <td class="at"></td> <!-- Action Taken -->
                                </tr>

                            </table>

                                <p id="b2-r18-p1">Days of School:</p>
                                <div id="b2-r18-d1" class="underline"></div>

                                <p id="b2-r18-p2">Days Present:</p>
                                <div id="b2-r18-d2" class="underline"></div>

                                <p id="b2-r19-p1">Total Number of Years in School:</p>
                                <div id="b2-r19-d1" class="underline"></div>
                        </div>

                    </div>

                    <div id = "box-3" class="gr">

                            <div id="info">

                                <p id="b2-r1-p1">School:</p>
                                    <div id="b2-r1-d1" class="underline"></div>
                                

                                <p id="b2-r2-p1">Grade:</p>
                                    <div id="b2-r2-d1" class="underline"></div>
                                

                                <p id="b2-r2-p2">School Year:</p>
                                    <div id="b2-r2-d2" class="underline"></div>
                                

                            </div>
                            <div id="2nd-yr">

                                <table id="2nd-t">
                                
                                <tr id="b3-r3-head">  
                                <th class="col1">SUBJECT</th>
                                <th class="col2">Final Rating</th>
                                <th class="col3">Action Taken</th>
                                </tr>

                                <tr id="b3-r4">  
                                <td class="subj">sample</td> <!-- subject -->
                                <td class="fr"></td> <!-- final rating -->
                                <td class="at"></td> <!-- Action Taken -->
                                </tr>

                                <tr id="b3-r5">  
                                <td class="subj"></td> <!-- subject -->
                                <td class="fr"></td> <!-- final rating -->
                                <td class="at"></td> <!-- Action Taken -->
                                </tr>

                                <tr id="b3-r6">  
                                <td class="subj"></td> <!-- subject -->
                                <td class="fr"></td> <!-- final rating -->
                                <td class="at"></td> <!-- Action Taken -->
                                </tr>

                                <tr id="b3-r7">  
                                <td class="subj"></td> <!-- subject -->
                                <td class="fr"></td> <!-- final rating -->
                                <td class="at"></td> <!-- Action Taken -->
                                </tr>

                                <tr id="b3-r8">  
                                <td class="subj"></td> <!-- subject -->
                                <td class="fr"></td> <!-- final rating -->
                                <td class="at"></td> <!-- Action Taken -->
                                </tr>

                                <tr id="b3-r9">  
                                <td class="subj"></td> <!-- subject -->
                                <td class="fr"></td> <!-- final rating -->
                                <td class="at"></td> <!-- Action Taken -->
                                </tr>

                                <tr id="b3-r10">  
                                <td class="subj"></td> <!-- subject -->
                                <td class="fr"></td> <!-- final rating -->
                                <td class="at"></td> <!-- Action Taken -->
                                </tr>

                                <tr id="b3-r11">  
                                <td class="subj"></td> <!-- subject -->
                                <td class="fr"></td> <!-- final rating -->
                                <td class="at"></td> <!-- Action Taken -->
                                </tr>

                                <tr id="b3-r12">  
                                <td class="subj"></td> <!-- subject -->
                                <td class="fr"></td> <!-- final rating -->
                                <td class="at"></td> <!-- Action Taken -->
                                </tr>

                                <tr id="b3-r13">  
                                <td class="subj"></td> <!-- subject -->
                                <td class="fr"></td> <!-- final rating -->
                                <td class="at"></td> <!-- Action Taken -->
                                </tr>

                                <tr id="b3-r14">  
                                <td class="subj"></td> <!-- subject -->
                                <td class="fr"></td> <!-- final rating -->
                                <td class="at"></td> <!-- Action Taken -->
                                </tr>

                                <tr id="b3-r15">  
                                <td class="subj"></td> <!-- subject -->
                                <td class="fr"></td> <!-- final rating -->
                                <td class="at"></td> <!-- Action Taken -->
                                </tr>

                                <tr id="b3-r16">  <!-- additional subject -->
                                <td class="subj"></td> <!-- subject -->
                                <td class="fr"></td> <!-- final rating -->
                                <td class="at"></td> <!-- Action Taken -->
                                </tr>

                                <tr id="b3-r17">  <!-- additional subject -->
                                <td class="subj"></td> <!-- subject -->
                                <td class="fr"></td> <!-- final rating -->
                                <td class="at"></td> <!-- Action Taken -->
                                </tr>

                            </table>

                                <p id="b2-r18-p1">Days of School:</p>
                                <div id="b2-r18-d1" class="underline"></div>

                                <p id="b2-r18-p2">Days Present:</p>
                                <div id="b2-r18-d2" class="underline"></div>

                                <p id="b2-r19-p1">Total Number of Years in School:</p>
                                <div id="b2-r19-d1" class="underline"></div>
                        </div>

                        
                    </div>

                        <!--end of box-2-->

                     <!--box-3-->

                     <div id = "box-4-5">
                    <div id = "box-4" class="gr">

                            <div id="info">

                                <p id="b2-r1-p1">School:</p>
                                    <div id="b2-r1-d1" class="underline"></div>
                                

                                <p id="b2-r2-p1">Grade:</p>
                                    <div id="b2-r2-d1" class="underline"></div>
                                

                                <p id="b2-r2-p2">School Year:</p>
                                    <div id="b2-r2-d2" class="underline"></div>
                                

                            </div>
                            <div id="3rd-yr">

                                <table id="3rd-t">
                                
                                <tr id="b3-r3-head">  
                                <th class="col1">SUBJECT</th>
                                <th class="col2">Final Rating</th>
                                <th class="col3">Action Taken</th>
                                </tr>

                                <tr id="b3-r4">  
                                <td class="subj">sample</td> <!-- subject -->
                                <td class="fr"></td> <!-- final rating -->
                                <td class="at"></td> <!-- Action Taken -->
                                </tr>

                                <tr id="b3-r5">  
                                <td class="subj"></td> <!-- subject -->
                                <td class="fr"></td> <!-- final rating -->
                                <td class="at"></td> <!-- Action Taken -->
                                </tr>

                                <tr id="b3-r6">  
                                <td class="subj"></td> <!-- subject -->
                                <td class="fr"></td> <!-- final rating -->
                                <td class="at"></td> <!-- Action Taken -->
                                </tr>

                                <tr id="b3-r7">  
                                <td class="subj"></td> <!-- subject -->
                                <td class="fr"></td> <!-- final rating -->
                                <td class="at"></td> <!-- Action Taken -->
                                </tr>

                                <tr id="b3-r8">  
                                <td class="subj"></td> <!-- subject -->
                                <td class="fr"></td> <!-- final rating -->
                                <td class="at"></td> <!-- Action Taken -->
                                </tr>

                                <tr id="b3-r9">  
                                <td class="subj"></td> <!-- subject -->
                                <td class="fr"></td> <!-- final rating -->
                                <td class="at"></td> <!-- Action Taken -->
                                </tr>

                                <tr id="b3-r10">  
                                <td class="subj"></td> <!-- subject -->
                                <td class="fr"></td> <!-- final rating -->
                                <td class="at"></td> <!-- Action Taken -->
                                </tr>

                                <tr id="b3-r11">  
                                <td class="subj"></td> <!-- subject -->
                                <td class="fr"></td> <!-- final rating -->
                                <td class="at"></td> <!-- Action Taken -->
                                </tr>

                                <tr id="b3-r12">  
                                <td class="subj"></td> <!-- subject -->
                                <td class="fr"></td> <!-- final rating -->
                                <td class="at"></td> <!-- Action Taken -->
                                </tr>

                                <tr id="b3-r13">  
                                <td class="subj"></td> <!-- subject -->
                                <td class="fr"></td> <!-- final rating -->
                                <td class="at"></td> <!-- Action Taken -->
                                </tr>

                                <tr id="b3-r14">  
                                <td class="subj"></td> <!-- subject -->
                                <td class="fr"></td> <!-- final rating -->
                                <td class="at"></td> <!-- Action Taken -->
                                </tr>

                                <tr id="b3-r15">  
                                <td class="subj"></td> <!-- subject -->
                                <td class="fr"></td> <!-- final rating -->
                                <td class="at"></td> <!-- Action Taken -->
                                </tr>

                                <tr id="b3-r16">  <!-- additional subject -->
                                <td class="subj"></td> <!-- subject -->
                                <td class="fr"></td> <!-- final rating -->
                                <td class="at"></td> <!-- Action Taken -->
                                </tr>

                                <tr id="b3-r17">  <!-- additional subject -->
                                <td class="subj"></td> <!-- subject -->
                                <td class="fr"></td> <!-- final rating -->
                                <td class="at"></td> <!-- Action Taken -->
                                </tr>

                            </table>

                                <p id="b2-r18-p1">Days of School:</p>
                                <div id="b2-r18-d1" class="underline"></div>

                                <p id="b2-r18-p2">Days Present:</p>
                                <div id="b2-r18-d2" class="underline"></div>

                                <p id="b2-r19-p1">Total Number of Years in School:</p>
                                <div id="b2-r19-d1" class="underline"></div>
                        </div>

                        
                    </div>

                    <div id = "box-5" class="gr">

                            <div id="info">

                                <p id="b2-r1-p1">School:</p>
                                    <div id="b2-r1-d1" class="underline"></div>
                                

                                <p id="b2-r2-p1">Grade:</p>
                                    <div id="b2-r2-d1" class="underline"></div>
                                

                                <p id="b2-r2-p2">School Year:</p>
                                    <div id="b2-r2-d2" class="underline"></div>
                                

                            </div>
                            <div id="4th-yr">

                                <table id="4th-t">
                                
                                <tr id="b3-r3-head">  
                                <th class="col1">SUBJECT</th>
                                <th class="col2">Final Rating</th>
                                <th class="col3">Action Taken</th>
                                </tr>

                                <tr id="b3-r4">  
                                <td class="subj">sample</td> <!-- subject -->
                                <td class="fr"></td> <!-- final rating -->
                                <td class="at"></td> <!-- Action Taken -->
                                </tr>

                                <tr id="b3-r5">  
                                <td class="subj"></td> <!-- subject -->
                                <td class="fr"></td> <!-- final rating -->
                                <td class="at"></td> <!-- Action Taken -->
                                </tr>

                                <tr id="b3-r6">  
                                <td class="subj"></td> <!-- subject -->
                                <td class="fr"></td> <!-- final rating -->
                                <td class="at"></td> <!-- Action Taken -->
                                </tr>

                                <tr id="b3-r7">  
                                <td class="subj"></td> <!-- subject -->
                                <td class="fr"></td> <!-- final rating -->
                                <td class="at"></td> <!-- Action Taken -->
                                </tr>

                                <tr id="b3-r8">  
                                <td class="subj"></td> <!-- subject -->
                                <td class="fr"></td> <!-- final rating -->
                                <td class="at"></td> <!-- Action Taken -->
                                </tr>

                                <tr id="b3-r9">  
                                <td class="subj"></td> <!-- subject -->
                                <td class="fr"></td> <!-- final rating -->
                                <td class="at"></td> <!-- Action Taken -->
                                </tr>

                                <tr id="b3-r10">  
                                <td class="subj"></td> <!-- subject -->
                                <td class="fr"></td> <!-- final rating -->
                                <td class="at"></td> <!-- Action Taken -->
                                </tr>

                                <tr id="b3-r11">  
                                <td class="subj"></td> <!-- subject -->
                                <td class="fr"></td> <!-- final rating -->
                                <td class="at"></td> <!-- Action Taken -->
                                </tr>

                                <tr id="b3-r12">  
                                <td class="subj"></td> <!-- subject -->
                                <td class="fr"></td> <!-- final rating -->
                                <td class="at"></td> <!-- Action Taken -->
                                </tr>

                                <tr id="b3-r13">  
                                <td class="subj"></td> <!-- subject -->
                                <td class="fr"></td> <!-- final rating -->
                                <td class="at"></td> <!-- Action Taken -->
                                </tr>

                                <tr id="b3-r14">  
                                <td class="subj"></td> <!-- subject -->
                                <td class="fr"></td> <!-- final rating -->
                                <td class="at"></td> <!-- Action Taken -->
                                </tr>

                                <tr id="b3-r15">  
                                <td class="subj"></td> <!-- subject -->
                                <td class="fr"></td> <!-- final rating -->
                                <td class="at"></td> <!-- Action Taken -->
                                </tr>

                                <tr id="b3-r16">  <!-- additional subject -->
                                <td class="subj"></td> <!-- subject -->
                                <td class="fr"></td> <!-- final rating -->
                                <td class="at"></td> <!-- Action Taken -->
                                </tr>

                                <tr id="b3-r17">  <!-- additional subject -->
                                <td class="subj"></td> <!-- subject -->
                                <td class="fr"></td> <!-- final rating -->
                                <td class="at"></td> <!-- Action Taken -->
                                </tr>

                            </table>

                                <p id="b2-r18-p1">Days of School:</p>
                                <div id="b2-r18-d1" class="underline"></div>

                                <p id="b2-r18-p2">Days Present:</p>
                                <div id="b2-r18-d2" class="underline"></div>

                                <p id="b2-r19-p1">Total Number of Years in School:</p>
                                <div id="b2-r19-d1" class="underline"></div>
                        </div>

                        
                    </div>
                    </div>

                        <div id="box-6">

                            <p id="b6-r1-p1">SUMMER/REMEDIAL CLASS</p>

                            <p id="b6-r1-p2">School:</p>
                            <div id="b6-r1-d1"></div>

                            <p id="b6-r1-p3">School Year:</p>
                            <div id="b6-r1-d2"></div>

                            <!-- <p id="b6-r2-p1">Subject</p> 
                            <p id="b6-r2-p2">Final Rating</p> 
                            <p id="b6-r2-p3">Action Taken</p> -->

                            <table id="additional-t">
                                
                                <tr id="b6-r2-head">  
                                <th class="add-col1">SUBJECT</th>
                                <th class="add-col2">Final Rating</th>
                                <th class="add-col3">Action Taken</th>
                                </tr>

                                <tr id="b6-r3">  <!-- additional subject -->
                                <td class="add-subj"></td> <!-- subject -->
                                <td class="add-fr"></td> <!-- final rating -->
                                <td class="add-at"></td> <!-- Action Taken -->
                                </tr>

                            </table>

                            <!-- <div class="subject-name">
                                    
                                </div>

                                <div class="final-rating">
                                    
                                </div>

                                <div class="action-taken"> -->                           
                        
                            <p id="b6-r3-p4">Days of School:</p>
                                <div id="b6-r3-d1"></div>

                            <p id="b6-r3-p5">Days Present:</p>
                                <div id="b6-r3-d2"></div>
                            <!-- </div> -->

                        </div>

                        <div id="box-7">

                            <div id="b7-d1"></div>

                            <p id="b7-r1-p1">REMARKS:</p>
                            <div id="b7-r1-d1"></div>

                            <p id="b7-r1-p2">ISSUED TO:</p>
                            <div id="b7-r1-d2"></div>


                            <p id="b7-r2-p1">NOTE: A mark, erasure or alternation of any entry invalidates this form.</p>

                            <p id="b7-r4-p1">not valid without seal</p>

                            <div id="box-8">
                            <p id="b8-r1-p1">Prepared by:</p>
                            <div id="b8-r2-name"></div>
                            <div id="b8-r3-pos"></div>
                            </div>

                            <div id="box-9">
                            <p id="b9-r1-p1">Checked &amp; Verified by:</p>
                            <div id="b9-r2-name"></div>
                            <div id="b9-r3-pos"></div>
                            </div>

                        </div>



                    </div>

                </div>
            </div>
</body>
</html>