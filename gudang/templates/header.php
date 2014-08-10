<?php
if(isset($_SESSION)) 
{
  if ($_SESSION['logged_in'] != TRUE) 
  {
    header( 'Location: http://localhost/ozyservice' ) ;
  }
}
else
{
  header( 'Location: http://localhost/ozyservice' ) ;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title>Ozy Service</title>

    <!-- Bootstrap core CSS -->
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../assets/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../../assets/css/dashboard.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
    a {
    color: #444B52;
    text-decoration: none;
    }
    </style>
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">OZY SERVICE - GUDANG</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="../logout.php"><i class="fa fa-power-off"></i> Logout</a></li>
          </ul>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <!-- <form><li <?php if (isset($active)) { if ($active == "data_master") { echo 'class="active"'; } } ?>><a href="http://localhost/ozyservice/gudang/data_master"> Data Master</a></li>
            <li <?php if (isset($active)) { if ($active == "transaksi") { echo 'class="active"'; } } ?>><a href="http://localhost/ozyservice/admin/transaksi">Transaksi</a></li>
            <li <?php if (isset($active)) { if ($active == "dokumen") { echo 'class="active"'; } } ?>><a href="http://localhost/ozyservice/admin/dokumen"> Dokumen</a></li>
            <li <?php if (isset($active)) { if ($active == "laporan") { echo 'class="active"'; } } ?>><a href="http://localhost/ozyservice/admin/laporan"> Laporan</a></li>
            -->
          <div id="MainMenu">
    <div class="list-group panel">
    <a href="#demo3" class="list-group-item list-group-item-success" data-toggle="collapse" data-parent="#MainMenu">Data Master</a>
    <div class="collapse" id="demo3">
      <a href="http://localhost/ozyservice/gudang/data_master/" class="list-group-item" data-parent="#SubMenu1">Data Master Barang </a>
      </div>
      </div>
      <div class="list-group panel">
    <a href="#demo4" class="list-group-item list-group-item-success" data-toggle="collapse" data-parent="#MainMenu">Dokumen </a>
    <div class="collapse" id="demo4">
      <a href="http://localhost/ozyservice/gudang/dokumen/" class="list-group-item">Surat Pengeluaran Barang </a>
       <a href="http://localhost/ozyservice/gudang/pengeluaran_barang/" class="list-group-item">Data Pengeluaran Barang </a>
      </div>
      </div>
      <div class="list-group panel">
    <a href="#demo5" class="list-group-item list-group-item-success" data-toggle="collapse" data-parent="#MainMenu">Laporan </a>
    <div class="collapse" id="demo5">
      <a href="http://localhost/ozyservice/gudang/laporan_persediaan/" class="list-group-item">Laporan Persediaan </a>
       
      </div>
      </div>
    
      
      </div>
          </div>
          </ul>
        </div>
      </div>
    </div>