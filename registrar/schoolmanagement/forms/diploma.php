<? php
require_once "../../../resources/config.php";

if (!$conn) { 
 die('Could not connect to MySQL: ' . mysqli_error());
}
  //queru to get student's name
 $query = mysql_query("SELECT first_name,mid_name,last_name FROM students");
 mysql_select_db('pcnhsdb');
 



  ?>
<html>

<title></title>
<head>
      <link rel="stylesheet" href="../../../css/diploma.css">

</head>
<body>


     
<div id="outer">
      
      
      <img src="../../../images/deped.png" id="img1"> 
      
      <img src="../../../images/pines.png" id="img2"> 
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

      <h1> PINES CITY NATIONAL HIGH SCHOOL </h1>
      <span class="text1"> PAARALAN (School) </span><br/><br/>
      <span class="text3"> Pinatutunayan nito na si </span><br/>
      <span class="text2"> This certifies that </span><br/><br/>
      <form method=" " id="form1">
      <input type="text" action=""?></input></form><br/>
    
       <span class="text3">ay kasiya-siyang nakatupad sa mga kinakailangan sa pagtatapas sa kurikulum ng</span><br/>
       <span class="text2"> has satisfactorily completed the requirements for graduation from the</span><br/>
        <span class="text3">Edukasyong Sekundarya na itinakda para sa Mataas na Paaralan ng Republika ng</span><br/>
        <span class="text2"> Secondary Education Curriculum prescribed for High Schools of the Republic of</span><br/>
         <span class="text3">Pilipinas kaya siya'y karapat-dapat na tumanggap nitong</span><br/>
        <span class="text2">The Philippines and is therefore entitled to receive this</span><br/>
        <br/>

        <img src="../../../images/katunayan.png" id="img3"> <br/>

        <span class="text3"> Nilagdaan sa Lungsod ng Baguio,Pilipinas ngayong ika-<input type="text" id="dd" name="date"></input> ng <input type="text" id="mm" name="month"></input>,<input type="text" id="dd" name="year"></input></span><br/>
        <span class="text2"> Signed in Baguio City, Philippines this <input type="text" id="dd1" name="date"></input> day of <input type="text" id="mm1" name="month"></input>,<input type="text" id="dd1" name="year"></input></span><br/><br/>

  
        </form>
       
</div>
</div>

</body>





</html>