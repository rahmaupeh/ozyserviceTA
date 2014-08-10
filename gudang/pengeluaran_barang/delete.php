<?php
require_once("../../include/db.php");

if (!mysql_query("DELETE FROM pengeluaran_barang WHERE kode_barang = '$_GET[kode_barang]'",$con))
  {
  die('Error: ' . mysql_error());
  }
  else
  {
  	header( 'Location: http://localhost/ozyservice/gudang/pengeluaran_barang' ) ;
  }
?>