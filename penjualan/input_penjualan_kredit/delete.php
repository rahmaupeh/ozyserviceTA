<?php
require_once("../../include/db.php");
mysql_query("DELETE FROM detail_penjualan WHERE kode_transaksi = '$_GET[kode_transaksi]'");

if (!mysql_query("DELETE FROM transaksi WHERE kode_transaksi = '$_GET[kode_transaksi]'",$con))
  {
  die('Error: ' . mysql_error());
  }
  else
  {
  	header( 'Location: http://localhost/ozyservice/penjualan/input_penjualan_kredit' ) ;
  }
?>