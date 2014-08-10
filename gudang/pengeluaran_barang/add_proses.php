<?php
require_once("../../include/db.php");

$kode_barang= $_POST['kode_barang'];
$nama_barang = $_POST['nama_barang'];
$quantity = $_POST['quantity'];
$date= $_POST['date'];


//simpan data ke database
$query = mysql_query("insert into pengeluaran_barang values('$kode_barang', '$nama_barang', '$quantity','$date')") or die(mysql_error());
 
if ($query) {
	header('location: http://localhost/ozyservice/gudang/pengeluaran_barang');
}
?>
