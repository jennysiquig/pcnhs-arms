<!DOCTYPE html>
<!-- Session Check -->
  <?php
    date_default_timezone_set('Asia/Manila');
    session_start();


    if(!isset($_SESSION['logged_in']) && !isset($_SESSION['account_type'])){
      //header('Location: login.php');
    }else {
      $account_type = $_SESSION['account_type'];
      header("Location: $account_type/index.php");
    }
    

    

  ?>

<!-- Session Check -->
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    
    
    <!-- Bootstrap -->
    <link href="resources/libraries/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="resources/libraries/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    
    <!-- Datatables -->
    <link href="resources/libraries/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom Theme Style -->
    <link href="css/custom.min.css" rel="stylesheet">
    <link href="css/tstheme/style.css" rel="stylesheet">

    <style>
      .login { 
  background: url('images/pinetree.png') no-repeat center center fixed; 
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;

} 
 #transparent{
  content: "";
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  background: rgba(0,0,0,0.5);
  width: auto;
  height: auto;
}
    h2,p, .ps{
 color:#FFFFFF;
 text-shadow: 0 1px 0 #ccc,
        0 2px 0 #c9c9c9,
              0 3px 0 #bbb,
              0 4px 0 #b9b9b9,
              0 5px 0 #aaa,
              0 6px 1px rgba(0,0,0,.1),
              0 0 5px rgba(0,0,0,.1),

    }

    .form-control{
       background-color:rgba(250,0,0,0) !important;
       border:none !important;
       font-family: arial;
       font-size: 14px;
       color:#fff;
   }

    </style>
    
  </head>
  <body class="login">
    <div id="transparent">
    <div class="clearfix">
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form action="resources/verify.php" method="post">
             <img src = "images/front.png">
             <h2>Academic Records <br/>Mananagement System</h2><br/>

              <!-- Generate Error Message -->
                <?php
                  if(isset($_SESSION['error_message'])) {
                    $error_message = $_SESSION['error_message'];
                    echo "<p style='color: red'>$error_message</p>";

                    session_unset();
                    session_destroy();
                  }

                ?>
              <!-- Generate Error Message -->

              <div>
                <input type="text" class="form-control" placeholder="Username" name="username"/>
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" name="password"/>
              </div>
              
              <div>
                <button class="btn btn-primary submit" href="index.html">Log in</button>
                 
              </div>

              <div class="clearfix"></div>
              <div class="separator">
                <a class="ps" href="#">Forgot your password?</a>
                <div class="clearfix"></div>
                <br />
                <div>
                 
                  
                  <p>To login as Registrar, use the Registrar credential.</p>
                  <p>To login as System Admin, use the System Admin credential.</p>
                </div>
              </div>
              </div>
            </form>
          </section>
        </div>
        
      </form>
    </section>
  </div>
</div>
</div>
</body>
</html>