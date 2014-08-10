<?php
require_once("../../include/db.php");

$sql="INSERT INTO sewa (id_admin, id_customer, id_mobil, tgl_sewa, tgl_kembali, total_bayar) VALUES ('$_SESSION[id_admin]','$_POST[id_customer]','$_POST[id_mobil]','$_POST[tgl_sewa]','$_POST[tgl_kembali]',$_POST[harga_total])";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
  else
  {
  	header( 'Location: http://localhost/sewamobil/admin/penyewaan' ) ;
  }
?>