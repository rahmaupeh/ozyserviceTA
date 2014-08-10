<?php
require_once("../../include/db.php");

$kode_barang= $_POST['kode_barang'];
$nama_barang = $_POST['nama_barang'];
$no_parts = $_POST['no_parts'];
$kategori = $_POST['kategori'];
$quantity = $_POST['quantity'];
$harga_jual= $_POST['harga_jual'];
$total_harga= $quantity * $harga_satuan;
$date= $_POST['date'];


//simpan data ke database
$query = mysql_query("insert into data_barang 
	values('$kode_barang', '$no_parts', '$nama_barang', '$kategori', '0','0','0','0','0')") or die(mysql_error());
 
if ($query) {
	header('location: http://localhost/ozyservice/penjualan/input_barang/');
}
?>
