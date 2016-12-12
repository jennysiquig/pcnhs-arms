<!DOCTYPE html>
<html lang="en">
  <head>
    <?php
    include 'resources/templates/registrar/header.php';
    $base_url =  "http://".$_SERVER['SERVER_NAME']."/pcnhs.sis";
    ?>
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
                
                <div class="clearfix"></div>
                <br />
                <div>
                  <h1><i class="fa fa-book"></i> Pines City National Highshool</h1>
                  <p>Student Information System</p>
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