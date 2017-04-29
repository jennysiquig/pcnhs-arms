<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="resources/assets/css/custom.min.css" rel="stylesheet"> -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="assets/images/ico/fav.png">
    <title>
        Web Application Configuration
    </title>
  </head>
  <body>
    <div class="container">
      <form class="form-horizontal" action="saveconfig.php" method="POST">
        <fieldset>

        <!-- Form Name -->
        <legend>Edit Confguration Files</legend>
        <center><h3>The default values are already set. Change values only if necessary.</h3></center>
        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label"><h3>Main Configuration</h3></label>
        </div>
        <div class="form-group">
          <label class="col-md-4 control-label"><h4>Protocol Settings</h4></label>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label" for="textinput">Protocol</label>
          <div class="col-md-4">
          <input name="protocol" type="radio" onclick="enableURL();" checked="" value="http://">HTTP *Default
          <br/>
          <input name="protocol" type="radio" onclick="disableURL();" value="https://">HTTPS
          </div>
        </div>

        <div id="urlfield" class="form-group">
          <label class="col-md-4 control-label" for="textinput">URL Path</label>
          <div class="col-md-4">
          <input id="urlpath" name="urlpath" type="text" class="form-control input-md" value="pcnhs-arms" placeholder="Default: pcnhs-arms" required="">
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label"><h4>Database Settings</h4></label>
        </div>
        <div class="form-group">
          <label class="col-md-4 control-label" for="textinput">Database Host</label>
          <div class="col-md-4">
          <input id="textinput" name="dbhost" type="text" class="form-control input-md" value="localhost" placeholder="Default: localhost" required="">
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-4 control-label" for="textinput">Database Name</label>
          <div class="col-md-4">
          <input id="textinput" name="dbname" type="text" class="form-control input-md" value="pcnhsdb" placeholder="Default: pcnhsdb" required="">
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-4 control-label" for="textinput">Database Username</label>
          <div class="col-md-4">
          <input id="textinput" name="dbuser" type="text" class="form-control input-md" value="root" placeholder="Default: pcnhs or root" required="">
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-4 control-label" for="textinput">Database Password</label>
          <div class="col-md-4">
          <input id="textinput" name="dbpass" type="text" class="form-control input-md">
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-5">
          </div>
          <a href="login.php" class="btn btn-default">Cancel</a>
          <button type="submit" class="btn btn-success">Save Changes</button>
        </div>


        </fieldset>
      </form>

      </div>
  </body>
  <script>
    function enableURL() {
      document.getElementById("urlfield").innerHTML = '<label class="col-md-4 control-label" for="textinput">URL Path</label><div class="col-md-4"><input id="urlpath" name="urlpath" type="text" class="form-control input-md" placeholder="Default: pcnhs-arms" required=""></div>';
    }
    function disableURL() {
        document.getElementById("urlfield").innerHTML = "";
    }
  </script>
</html>
