<?php
$active = "Customer";
require_once("../../include/db.php");

$dat_server = mktime(date("G"),date("i"),date("s"),date("n"),date("j"),date("Y"));
$tgl = date("Y-n-j",$dat_server);
$thn = date("Y",$dat_server);

if(isset($_GET['kode_retur'])){
	$kode_retur= $_GET['kode_retur'];
}




if(isset($_POST['kode_retur']) and isset($_POST['no_faktur'])){
//simpan data ke database
	$kode_retur= $_POST['kode_retur'];
  
  $no_faktur = $_POST['no_faktur'];


  $qcek = mysql_query("SELECT * FROM penjualan WHERE kode_faktur = '$no_faktur'");
  $cek = mysql_fetch_row($qcek);
  $ncek = mysql_num_rows($qcek);
	if($ncek != 0){
		$query = mysql_query("INSERT INTO `ozyservice`.`retur` (`kode_retur`, `kode_faktur`, `tanggal_retur`) VALUES ('$kode_retur', '$no_faktur', '$tgl')") or die(mysql_error());	
	} else {

		header('location: http://localhost/ozyservice/penjualan/retur_penjualan/add.php');
		die();
	}
}
require_once("../templates/header.php");



//$qcek = mysql_query("SELECT * FROM  `transaksi_detail` JOIN input_barang_masuk ON (transaksi_detail.kode_barang = input_barang_masuk.kode_barang)  WHERE transaksi.kode_transaksi = '$cek[1]'");
//echo "SELECT * FROM  `transaksi_detail` JOIN input_barang_masuk ON (transaksi_detail.kode_barang = input_barang_masuk.kode_barang)  WHERE transaksi_detail.kode_transaksi = '$cek[1]'";
//$cek = mysql_fetch_row($qcek);

if(isset($_POST['jumlah']) and isset($_POST['kode_barang'])){
	//echo "widy ganteng";
	$kode_retur= $_POST['kode_retur'];
	$jumlah = $_POST['jumlah'];
	$kode_barang = $_POST['kode_barang'];
  $keterangan = $_POST['keterangan'];
  $cek[1]= $_POST['kode_transaksi'];
	
	//echo $jumlah;
	//echo $kode_barang;
	if($jumlah != "" and $kode_barang != ""){
    $qtran1 = mysql_query("SELECT * FROM  `detail_penjualan` JOIN `data_barang` ON (detail_penjualan.kode_barang = data_barang.kode_barang)  WHERE detail_penjualan.kode_transaksi = '$cek[1]' AND detail_penjualan.kode_barang = '$kode_barang'");
    //echo "SELECT * FROM  `transaksi_detail` JOIN `input_barang_masuk` ON (transaksi_detail.kode_barang = input_barang_masuk.kode_barang)  WHERE transaksi_detail.kode_transaksi = '$cek[1]' AND transaksi_detail.kode_barang = '$kode_barang'";
    $tran1 = mysql_fetch_row($qtran1);

		//echo "masuk";
    //$qret = mysql_query("SELECT * FROM input_barang_masuk WHERE kode_barang = '$kode_barang'");
    //$ret = mysql_fetch_row($qret);

		$qbrg = mysql_query("SELECT * FROM data_barang WHERE kode_barang = '$kode_barang'");
		$brg = mysql_fetch_row($qbrg);
		//echo "insert into transaksi_detail values('$kode_transaksi', '$kode_barang', '$jumlah','$brg[5]', '$brg[8]')";
		$query = mysql_query("insert into retur_detail values('$kode_retur', '$kode_barang', '$tran1[2]','$jumlah','$keterangan')") or die(mysql_error());
		//echo "insert into retur_detail values('$kode_retur', '$kode_barang', '$tran1[2]','$jumlah','$keterangan')";
    $tmbh = $brg[7];
    $tmbh = $tmbh - $jumlah;
    mysql_query("UPDATE  `ozyservice`.`data_barang` SET  `stock toko` =  '$tmbh' WHERE  `data_barang`.`kode_barang` =  '$kode_barang'");

   

	}
}

if(isset($_GET['hapus'])) {
  $kode_retur= $_GET['kode_retur'];
	$hapus = $_GET['hapus'];
  $cek[1]= $_GET['kode_transaksi'];
	
  $awal = mysql_fetch_row(mysql_query("SELECT SUM(jumlah_retur) FROM retur_detail WHERE kode_retur='$kode_retur' AND kode_barang='$hapus'"));
  
  $krng = $awal[0];
  
  $awal = mysql_fetch_row(mysql_query("SELECT * FROM data_barang WHERE kode_barang = '$hapus'"));
  $tmbh = $awal[7];
  $tmbh = $tmbh + $krng;
  
  mysql_query("UPDATE  `ozyservice`.`data_barang` SET  `stock toko` =  '$tmbh' WHERE  `data_barang`.`kode_barang` =  '$hapus'");
	//echo $jumlah;
	//echo $kode_barang;
	mysql_query("DELETE FROM retur_detail WHERE kode_retur='$kode_retur' AND kode_barang='$hapus'");
}

//echo $kode_retur;

$qcek = mysql_query("SELECT * FROM retur WHERE kode_retur = '$kode_retur'");
//echo "SELECT * FROM retur WHERE kode_retur = '$kode_retur'";
$cek = mysql_fetch_row($qcek);

$qcek = mysql_query("SELECT * FROM `penjualan` JOIN transaksi ON (penjualan.kode_transaksi = transaksi.kode_transaksi) WHERE penjualan.kode_faktur = '$cek[1]'");
//echo "SELECT * FROM `faktur` JOIN transaksi ON (faktur.kode_transaksi = transaksi.kode_transaksi) WHERE faktur.kode_faktur = '$cek[1]'";
$cek = mysql_fetch_row($qcek);
 
//if ($query) {
	
//}
//hellow world
?>


<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<h3 class="page-header"></i> Input Retur</h3>
  <div class="row">
  <div class="col-md-1">
  </div>
  <div class="col-md-9">
    <form class="form-horizontal" role="form" action="add_proses.php" method="POST">
  <div class="form-group">
    <label for="no_parts" class="col-lg-2 control-label">Kode Retur</label>
    <div class="col-lg-10">
      <input type="varchar" class="form-control" id="no_parts" placeholder="No Transaksi" readonly="readonly" value="<?php echo $kode_retur; ?>" name="kode_retur">
    </div>
  </div>
  <div class="form-group">
    <label for="inputnama_barang" class="col-lg-2 control-label">Nama Barang</label>
    <div class="col-lg-10">
        <select class="form-control" name="kode_barang">
          <option value=""></option>
        <?php
          //$qcek = mysql_query("SELECT * FROM  `transaksi_detail` JOIN input_barang_masuk ON (transaksi_detail.kode_barang = input_barang_masuk.kode_barang)  WHERE transaksi.kode_transaksi = '$cek[1]'");
          //$cek = mysql_fetch_row($qcek);
          //$pel = mysql_query("SELECT * FROM  `input_barang_masuk` WHERE kode_barang LIKE '%2'");
          $pel = mysql_query("SELECT * FROM  `detail_penjualan` JOIN `data_barang` ON (detail_penjualan.kode_barang = data_barang.kode_barang)  WHERE detail_penjualan.kode_transaksi = '$cek[1]'");
          
          //echo "SELECT * FROM  `input_barang_masuk` WHERE kode_barang = '$cek[1]'";
          while($npel = mysql_fetch_array($pel)){
        ?>
          <option value="<?php echo $npel[1];?>"><?php echo $npel[7]; ?></option>
        <?php
          }
        ?>
        </select>
    </div>
  </div>
  <?php
    //echo "SELECT * FROM  `transaksi_detail` JOIN `input_barang_masuk` ON (transaksi_detail.kode_barang = input_barang_masuk.kode_barang)  WHERE transaksi_detail.kode_transaksi = '$cek[1]'";
  ?>
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
    <label for="no_parts" class="col-lg-2 control-label">Keterangan</label>
    <div class="col-lg-10">
      <input type="varchar" class="form-control" id="no_parts" placeholder="Keterangan" value="" name="keterangan">
    </div>
  </div>
  <div class="form-group">
    <label for="no_parts" class="col-lg-2 control-label"></label>
    <div class="col-lg-10">
      <input type="hidden" class="form-control" id="no_parts" placeholder="No Transaksi" readonly="readonly" value="<?php echo $cek[1]; ?>" name="kode_transaksi">
    </div>
  </div>

      <div class="form-group">
        <div class="col-lg-offset-2 col-lg-10">
          <button type="submit" class="btn btn-primary">Submit</button>
          <a href="simpan_retur.php?kode_retur=<?php echo $kode_retur;?>" class="btn btn-default">Proses Retur</a>
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
          <th>Jumlah Beli</th>
          <th>Jumlah Retur</th>
          <th>Keterangan</th>
          <th colspan="3">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        $result = mysql_query("SELECT * FROM retur_detail JOIN data_barang ON (retur_detail.kode_barang = data_barang.kode_barang) WHERE retur_detail.kode_retur = '$kode_retur'");
        // echo "SELECT * FROM retur_detail JOIN input_barang_masuk ON (retur_detail.kode_barang = input_barang_masuk.kode_barang) WHERE retur_detail.kode_retur = '$kode_retur'";
        //echo "SELECT * FROM retur_detail JOIN input_barang_masuk ON (retur_detail.kode_barang = input_barang_masuk.kode_barang) WHERE retur_detail.kode_retur = '$kode_retur'";
        while($row = mysql_fetch_array($result))
          {
        ?>
        <tr>
          <td><?php echo $no; ?>.</td>
          <td><?php echo $row['kode_barang']; ?></td>
          <td><?php echo $row['nama_barang']; ?></td>
          <td><?php echo $row[2]; ?></td> 
          <td><?php echo $row[3]; ?></td>
          <td><?php echo $row[4]; ?></td>
         
        
		  
          <td>
			<a onclick="return confirm('Hapus Data Ini ?')" href="add_proses.php?hapus=<?php echo $row['kode_barang']; ?>&kode_transaksi=<?php echo  $cek[1];?>&kode_retur=<?php echo $row['kode_retur']; ?>" class="btn btn-danger">Delete</a></td>
        </tr>
        <?php
          $no++;
          }
        ?>
      </tbody>
    </table>
  </div>
  </div>
</div><!-- end main -->
<?php require_once("../templates/footer.php"); ?>