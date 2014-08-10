<?php
require_once("../../include/db.php");

$sql="UPDATE data_barang SET nama_barang='$_POST[nama_barang]', kategori='$_POST[kategori]',no_parts='$_POST[kode_parts]' WHERE kode_barang='$_POST[kode_barang]'";
//print_r($sql);
if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
  else
  {
  	header( 'Location: http://localhost/ozyservice/gudang/data_master' ) ;
  }
?>