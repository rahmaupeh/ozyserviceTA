<?php
require_once("../../include/db.php");

$kode_barang= $_POST['kode_barang'];
$nama_barang = $_POST['nama_barang'];
$harga_satuan= $_POST['harga_satuan'];
$quantity = $_POST['quantity'];
$total_harga= $quantity * $harga_satuan;
$date= $_POST['date'];


//simpan data ke database
$query = mysql_query("insert into data_barang values('$kode_barang', '$nama_barang','$harga_satuan', '$quantity', '$total_harga','$date')") or die(mysql_error());

mysql_query("insert into laporan_persediaan (kode_barang,nama_barang,harga_satuan,quantity,harga_total,date) values('$kode_barang', '$nama_barang','$harga_satuan', '$quantity', '$total_harga','$date')") or die(mysql_error());
 
if ($query) {
	header('location: http://localhost/ozyservice/penjualan/input_barang');
}
?>
