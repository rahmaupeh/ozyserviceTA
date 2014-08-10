<?php
require_once("../../include/db.php");

$sql="UPDATE data_barang SET nama_barang='$_POST[nama_barang]', kategori='$_POST[kategori]',no_parts='$_POST[no_parts]',diskon='$_POST[diskon]',harga_jual='$_POST[harga_jual]',harga_beli='$_POST[harga_beli]' WHERE kode_barang='$_POST[kode_barang]'";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
  else
  {
  	
  	header( 'Location: http://localhost/ozyservice/penjualan/input_barang/' ) ;
  }
?>