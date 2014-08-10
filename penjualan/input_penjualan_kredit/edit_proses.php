<?php
require_once("../../include/db.php");

$sql="UPDATE penjualan_kredit SET nama_barang='$_POST[nama_barang]',quantity='$_POST[quantity]', harga_satuan='$_POST[harga_satuan]', diskon='$_POST[diskon]' WHERE no_parts='$_POST[no_parts]'";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
  else
  {
  	header( 'Location: http://localhost/ozyservice/penjualan/penjualan_kredit/' ) ;
  }
?>