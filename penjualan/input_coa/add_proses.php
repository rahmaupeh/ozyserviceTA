<?php
require_once("../../include/db.php");

$sql="INSERT INTO input_coa (reff, type, nama_akun) VALUES ('$_POST[kode_akun]','$_POST[jenis]','$_POST[nama_akun]')";
//INSERT INTO `ozyservice`.`input_coa` (`kode_akun`, `reff`, `type`, `nama_akun`) VALUES (NULL, 'fa', 'fsa', 'fas');
if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
  else
  {
  	header( 'Location: http://localhost/ozyservice/penjualan/input_coa' ) ;
  }
?>