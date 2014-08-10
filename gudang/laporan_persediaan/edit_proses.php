<?php
require_once("../../include/db.php");
$total_harga=$_POST['harga_satuan']*$_POST['quantity'];
$sql="UPDATE data_barang SET nama_barang='$_POST[nama_barang]', harga_satuan='$_POST[harga_satuan]',quantity='$_POST[quantity]', total_harga=$total_harga , date='$_POST[date]' WHERE kode_barang='$_POST[kode_barang]'";

mysql_query("insert into laporan_persediaan (kode_barang,nama_barang,harga_satuan,quantity,harga_total,date) values('$_POST[kode_barang]', '$_POST[nama_barang]','$_POST[harga_satuan]', '$_POST[quantity]', $total_harga,'$_POST[date]' )") or die(mysql_error());

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
  else
  {
  	header( 'Location: http://localhost/ozyservice/penjualan/input_barang/' ) ;
  }
?>