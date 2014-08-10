<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.png">

    <title>Login Admin</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <style type="text/css">
    body {
      background-image: url("images/home.jpg");
      padding-top: 40px;
      padding-bottom: 40px;
      background-color: #eee;
    }

    .form-signin {
      max-width: 330px;
      padding: 15px;
      margin: 0 auto;
      background-color: white;
      border-radius: 15px;
      margin-top: 65px;
    }
    .form-signin .form-signin-heading,
    .form-signin .checkbox {
      margin-bottom: 10px;
    }
    .form-signin .checkbox {
      font-weight: normal;
    }
    .form-signin .form-control {
      position: relative;
      font-size: 16px;
      height: auto;
      padding: 10px;
      -webkit-box-sizing: border-box;
         -moz-box-sizing: border-box;
              box-sizing: border-box;
    }
    .form-signin .form-control:focus {
      z-index: 2;
    }
    .form-signin input[type="text"] {
      margin-bottom: -1px;
      border-bottom-left-radius: 0;
      border-bottom-right-radius: 0;
    }
    .form-signin input[type="password"] {
      margin-bottom: 10px;
      border-top-left-radius: 0;
      border-top-right-radius: 0;
    }
    </style>

  </head>

  <body>

    <div class="container">
      <!-- <img src="" width="100%"/> -->
      <form class="form-signin" method="POST" action="login_proses.php">
        <h3 class="form-signin-heading text-center">Admin Login</h3>
        <?php
        if (isset($_GET['stat'])) 
        {
          if ($_GET['stat'] == 'fail') 
          {
          ?>
          <div class="alert alert-warning">Login Gagal!</div>
          <?php
          }
        }
        ?>
        <input name="nama" type="text" class="form-control" placeholder="Nama" autofocus>
        <input name="password" type="password" class="form-control" placeholder="Password">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
      </form>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>

</html>
