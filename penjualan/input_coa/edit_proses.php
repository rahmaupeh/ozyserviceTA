<?php
require_once("../../include/db.php");

$sql="UPDATE input_coa SET nama_akun='$_POST[nama_akun]' WHERE kode_akun='$_POST[kode_akun]'";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
  else
  {

  	header( 'Location: http://localhost/ozyservice/penjualan/input_coa' ) ;
  }
?>