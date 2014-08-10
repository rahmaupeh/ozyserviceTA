<?php
require_once("../../include/db.php");

$sql="INSERT INTO pelanggan(id_pelanggan, nama_pelanggan, toko, alamat,no_telepon, email) VALUES ('$_POST[id_pelanggan]','$_POST[nama_pelanggan]','$_POST[nama_toko]','$_POST[alamat]','$_POST[no_telepon]','$_POST[email]')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
  else
  {
  	header( 'Location: http://localhost/ozyservice/penjualan/data_master' ) ;
  }
?>