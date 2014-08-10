<?php
require_once("include/db.php");
$result = mysql_query("SELECT * FROM admin where nama ='$_POST[nama]' AND password = '$_POST[password]'",$con);
if (mysql_num_rows($result) == 1) 
{
	$admin = mysql_fetch_assoc($result);
	// store session data
	$_SESSION['id_admin']=$admin['id_admin'];
	$_SESSION['nama']=$admin['nama'];
	$_SESSION['logged_in']=TRUE;
	if ($admin['bagian'] == 'gudang') 
	{
		//redirect ke gudang
		header( 'Location: http://localhost/ozyservice/gudang/data_master' ) ;
	}
	else
	{
		//redirect ke yg penjualan
		header( 'Location: http://localhost/ozyservice/penjualan/data_master' ) ;
	}
}
else
{
	header( 'Location: http://localhost/ozyservice/index.php?stat=fail');	
}
?>