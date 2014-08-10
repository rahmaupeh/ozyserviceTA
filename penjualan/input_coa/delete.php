<?php
require_once("../../include/db.php");

if (!mysql_query("DELETE FROM input_coa WHERE kode_akun='$_GET[id]'",$con))
  {
  die('Error: ' . mysql_error());
  }
  else
  {
  	header( 'Location: http://localhost/ozyservice/penjualan/input_coa' ) ;
  }
?>