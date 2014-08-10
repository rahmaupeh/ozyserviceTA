<?php
require_once("../../include/db.php");

$sql="UPDATE sewa SET status = '$_POST[status]' WHERE id_sewa=$_POST[id_sewa]";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
  else
  {
  	header( 'Location: http://localhost/sewamobil/admin/pengembalian' ) ;
  }
?>