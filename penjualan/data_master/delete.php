<?php
require_once("../../include/db.php");

if (!mysql_query("DELETE FROM pelanggan WHERE id_pelanggan='$_GET[id]'",$con))
  {
  die('Error: ' . mysql_error());
  }
  else
  {
  	header( 'Location: http://localhost/ozyservice/penjualan/data_master' ) ;
  }
?>