<?php
require_once("../../include/db.php");
//echo $_POST[id_pelanggan];
//echo "UPDATE pelanggan SET nama_pelanggan='$_POST[nama_pelanggan]', alamat='$_POST[alamat]', no_telepon='$_POST[no_telepon]', email='$_POST[email]' WHERE id_pelanggan='$_POST[id_pelanggan]'";
$sql="UPDATE pelanggan SET nama_pelanggan='$_POST[nama_pelanggan]', toko = '$_POST[nama_toko]', alamat='$_POST[alamat]', no_telepon='$_POST[no_telepon]', email='$_POST[email]' WHERE id_pelanggan='$_POST[id_pelanggan]'";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
  else
  {
  	header( 'Location: http://localhost/ozyservice/penjualan/data_master' ) ;
  }
?>