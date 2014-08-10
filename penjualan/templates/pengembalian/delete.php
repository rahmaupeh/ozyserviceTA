<?php
require_once("../../include/db.php");

if (!mysql_query("DELETE FROM sewa WHERE id_sewa=$_GET[id]",$con))
  {
  die('Error: ' . mysql_error());
  }
  else
  {
  	header( 'Location: http://localhost/sewamobil/admin/pengembalian' ) ;
  }
?>