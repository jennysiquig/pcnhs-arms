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
    <title>User Login</title>
    <link rel="shortcut icon" href="images/pines.png" type="image/x-icon" />
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
    
  </head>
  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form action="resources/verify.php" method="post">
              <h1>Please Login</h1>

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
                <button class="btn btn-default submit" href="index.html">Log in</button>
                 
              </div>

              <div class="clearfix"></div>
              <div class="separator">
                <a class="" href="#">Forgot your password?</a>
                <div class="clearfix"></div>
                <br />
                <div>
                  <h1><i class="fa fa-book"></i> Pines City National Highshool</h1>
                  <h2>Academic Records Mananagement System</h2>
                  <p>To login as Registrar, use the Registrar credential.</p>
                  <p>To login as System Admin, use the System Admin credential.</p>
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