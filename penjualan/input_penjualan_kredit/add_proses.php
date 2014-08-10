<?php
$active = "Customer";
require_once("../../include/db.php");
require_once("../templates/header.php"); 

$dat_server = mktime(date("G"),date("i"),date("s"),date("n"),date("j"),date("Y"));
$tgl = date("Y-n-j",$dat_server);
$thn = date("Y",$dat_server);

if(isset($_GET['kode_transaksi'])){
	$kode_transaksi= $_GET['kode_transaksi'];
}


if(isset($_POST['kode_transaksi']) and isset($_POST['id_pelanggan'])){
//simpan data ke database
	$kode_transaksi= $_POST['kode_transaksi'];
	$id_pelanggan = $_POST['id_pelanggan'];
	if($id_pelanggan!=""){
		$query = mysql_query("insert into transaksi values('$kode_transaksi', '$id_pelanggan', '$tgl','0000-00-00', '0', '0')") or die(mysql_error());	
	}
}
	

if(isset($_POST['jumlah']) and isset($_POST['kode_barang'])){
	//echo "widy ganteng";
	$kode_transaksi= $_POST['kode_transaksi'];
	$jumlah = $_POST['jumlah'];
	$kode_barang = $_POST['kode_barang'];
	
	//echo $jumlah;
	//echo $kode_barang;
	if($jumlah != "" and $kode_barang != ""){
		//echo "masuk";
		$qbrg = mysql_query("SELECT * FROM data_barang WHERE kode_barang = '$kode_barang'");
		$brg = mysql_fetch_row($qbrg);
		//echo "insert into transaksi_detail values('$kode_transaksi', '$kode_barang', '$jumlah','$brg[5]', '$brg[8]')";
		$query = mysql_query("insert into detail_penjualan values('$kode_transaksi', '$kode_barang', '$jumlah','$brg[5]', '$brg[8]')") or die(mysql_error());
		
    $tmbh = $brg[7];
    $tmbh = $tmbh - $jumlah;
    mysql_query("UPDATE  `ozyservice`.`data_barang` SET  `stock toko` =  '$tmbh' WHERE  `data_barang`.`kode_barang` =  '$kode_barang'");

    $res = mysql_fetch_row(mysql_query("SELECT SUM((harga*jumlah)-(harga*jumlah*diskon/100)) FROM detail_penjualan WHERE kode_transaksi = '$kode_transaksi'"));

		mysql_query("UPDATE  `ozyservice`.`transaksi` SET  `total_harga` =  '$res[0]' WHERE  `transaksi`.`kode_transaksi` =  '$kode_transaksi'");



	}
}

if(isset($_GET['hapus'])) {
	//echo "widy ganteng";
	$kode_transaksi= $_GET['kode_transaksi'];
	$hapus = $_GET['hapus'];
	
  $awal = mysql_fetch_row(mysql_query("SELECT SUM(jumlah) FROM detail_penjualan WHERE kode_transaksi='$kode_transaksi' AND kode_barang='$hapus'"));
  
  $krng = $awal[0];
  
  $awal = mysql_fetch_row(mysql_query("SELECT * FROM data_barang WHERE kode_barang = '$hapus'"));
  $tmbh = $awal[7];
  $tmbh = $tmbh + $krng;
  
  mysql_query("UPDATE  `ozyservice`.`data_barang` SET  `stock toko` =  '$tmbh' WHERE  `data_barang`.`kode_barang` =  '$hapus'");
	//echo $jumlah;
	//echo $kode_barang;
	mysql_query("DELETE FROM detail_penjualan WHERE kode_transaksi='$kode_transaksi' AND kode_barang='$hapus'");
}
 
//if ($query) {
	
//}
//hellow world
?>


<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<h3 class="page-header"></i> Input Penjualan Kredit</h3>
  <div class="row">
  <div class="col-md-1">
  </div>
  <div class="col-md-9">
    <form class="form-horizontal" role="form" action="add_proses.php" method="POST">
      <div class="form-group">
    <label for="no_parts" class="col-lg-2 control-label">Kode Transaksi</label>
    <div class="col-lg-10">
      <input type="varchar" class="form-control" id="no_parts" placeholder="No Transaksi" readonly="readonly" value="<?php echo $kode_transaksi; ?>" name="kode_transaksi">
    </div>
  </div>
  <div class="form-group">
    <label for="inputnama_barang" class="col-lg-2 control-label">Nama Barang</label>
    <div class="col-lg-10">
        <select class="form-control" name="kode_barang">
          <option value=""></option>
        <?php
          $pel = mysql_query("SELECT * FROM  data_barang");
          while($npel = mysql_fetch_array($pel)){
        ?>
          <option value="<?php echo $npel['kode_barang']; ?>"><?php echo $npel['nama_barang']; ?></option>
        <?php
          }
        ?>
        </select>
    </div>
  </div>
   <div class="form-group">
    <label for="inputnama_barang" class="col-lg-2 control-label">Jumlah</label>
    <div class="col-lg-10">
        <select class="form-control" name="jumlah">
          <option value=""></option>
        <?php
          $npel = 0;
          while($npel<=1000){
          	$npel++;
        ?>
          <option value="<?php echo $npel; ?>"><?php echo $npel; ?></option>
        <?php
          }
        ?>
        </select>
    </div>
  </div>
  

      <div class="form-group">
        <div class="col-lg-offset-2 col-lg-10">
          <button type="submit" class="btn btn-primary">Submit</button>
          <a href="add_proses.php?kode_transaksi=<?php echo $kode_transaksi;?>" class="btn btn-default">Cancel</a>
        </div>
      </div>
    </form>
  </div>
  <div class="col-md-2">
  </div>
  </div>
  <div class="row">
  <div class="col-md-12">
    <hr/>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>No</th>
          <th>Kode Barang</th>
          <th>Nama Barang</th>
          <th>Quantity</th>
          <th>Harga Satuan</th>
          <th>diskon</th>
          <th>Total Harga</th>
          <th colspan="3">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        $result = mysql_query("SELECT * FROM detail_penjualan JOIN data_barang ON (detail_penjualan.kode_barang = data_barang.kode_barang) WHERE detail_penjualan.kode_transaksi = '$kode_transaksi'");

        while($row = mysql_fetch_array($result))
          {
        ?>
        <tr>
          <td><?php echo $no; ?>.</td>
          <td><?php echo $row['kode_barang']; ?></td>
          <td><?php echo $row['nama_barang']; ?></td>
          <td><?php echo $row['jumlah']; ?></td> 
          <td><?php echo $row['harga']; ?></td>
          <td><?php echo $row['diskon']; ?></td>
          <td><?php echo ($row['jumlah']*$row['harga'])-($row['jumlah']*$row['harga']*$row['diskon']/100); ?></td> 
        
		  
          <td>
			<a onclick="return confirm('Hapus Data Ini ?')" href="add_proses.php?hapus=<?php echo $row['kode_barang']; ?>&kode_transaksi=<?php echo $row['kode_transaksi']; ?>" class="btn btn-danger">Delete</a></td>
        </tr>
        <?php
          $no++;
          }
        ?>
      </tbody>
    </table>
    <a href="index.php?jur=<?php echo $kode_transaksi;?>" class="btn btn-primary">Selesai</a>
  </div>
  </div>
</div><!-- end main -->
<?php require_once("../templates/footer.php"); ?>