<?php 
$active = "Customer";
require_once("../../include/db.php");
require_once("../templates/header.php"); 

$dat_server = mktime(date("G"),date("i"),date("s"),date("n"),date("j"),date("Y"));
$tgl = date("Y-n-j",$dat_server);
$thn = date("Y",$dat_server);

$kd_brg = "SELECT * FROM permintaan_barang ORDER BY kode_surat DESC";
$kd_brg = mysql_query($kd_brg);
$vd_brg = mysql_fetch_row($kd_brg);
$nd_brg = mysql_num_rows($kd_brg);

if($nd_brg == 0 ){
  $no_id = "SPT".$thn."-0001";
} else {
  $arr_id = explode("-", $vd_brg[0]);
  $new_id = $arr_id[1];
  $new_id = $new_id + 1;
  $count_id = strlen($new_id);

  while ($count_id < 4){
    $new_id = "0".$new_id;
    $count_id++;
  }
  $no_id = "SPT".$thn."-".$new_id;
}

if(isset($_GET["kode_barang"]) and isset($_GET["jumlah"]) and isset($_GET["no_surat"])) {
  $jumlah = $_GET["jumlah"];
  $no_surat = $_GET["no_surat"];
  $kode_barang = $_GET["kode_barang"];
  $k_surat = $no_surat;
  $no_id = $no_surat;
  if($kode_barang != ""){
    mysql_query("INSERT INTO `ozyservice`.`permintaan_barang` (`kode_surat`, `date`, `status`) VALUES ('$no_surat', '$tgl', 'belum proses')");
    mysql_query("INSERT INTO `ozyservice`.`permintaan_barang_detail` (`kode_surat`, `kode_barang`, `jumlah`, `status`) VALUES ('$no_surat', '$kode_barang', '$jumlah', 'belum proses')");
    $awal = mysql_fetch_row(mysql_query("SELECT * FROM data_barang WHERE kode_barang = '$kode_barang'"));
    $tmbh = $awal[6];
    $tmbh = $tmbh - $jumlah;
    mysql_query("UPDATE  `ozyservice`.`data_barang` SET  `stock` =  '$tmbh' WHERE  `data_barang`.`kode_barang` =  '$kode_barang'");
  } else {
    $alert = "belum memasukkan data";
  }
}

if(isset($_GET["hapus"]) and isset($_GET["kode_barang"])) {
  $no_surat = $_GET["hapus"];
  $kode_barang = $_GET["kode_barang"];
  $k_surat = $no_surat;
  $no_id = $no_surat;
  $awal = mysql_fetch_row(mysql_query("SELECT SUM( jumlah ) 
  FROM permintaan_barang_detail  WHERE kode_surat = '$no_surat' and kode_barang = '$kode_barang'"));
  
  $krng = $awal[0];
  
  $awal = mysql_fetch_row(mysql_query("SELECT * FROM data_barang WHERE kode_barang = '$kode_barang'"));
  $tmbh = $awal[6];
  $tmbh = $tmbh + $krng;
  
  mysql_query("UPDATE  `ozyservice`.`data_barang` SET  `stock` =  '$tmbh' WHERE  `data_barang`.`kode_barang` =  '$kode_barang'");

  mysql_query("DELETE FROM permintaan_barang_detail WHERE kode_surat = '$no_surat' and kode_barang = '$kode_barang'");
}

?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main"> 
<center><h4 class="page-header"></i> Surat Permintaan Barang </h4></center>
 
<h3 class="page-header"></i> Input Barang</h3>
  <div class="row">
  <div class="col-md-1">
  </div>
  <div class="col-md-9">
<form class="form-horizontal" role="form" action="index.php" method="">
  <div class="form-group">
    <label for="inputkode_barang" class="col-lg-2 control-label">No Surat</label>
    <div class="col-lg-10">
      <input type="text" class="form-control" id="inputkode_barang" placeholder="No Parts" readonly="readonly" name="no_surat" value="<?php echo $no_id;?>">
    </div>
  </div>
  <div class="form-group">
    <label for="inputkode_barang" class="col-lg-2 control-label">Kode Barang</label>
    <div class="col-sm-2">
        <select class="form-control" name="kode_barang">
          <option value=""> </option>
      <?php 
        $qbarang = "SELECT * FROM data_barang";
        $qbarang = mysql_query($qbarang);
        while($barang = mysql_fetch_array($qbarang)){
      ?>
          <option value="<?php echo $barang[0];?>"> <?php echo $barang[0];?></option>
      <?php
        }
      ?>
        </select>
      </div>
  </div>
    <div class="form-group">
    <label for="input" class="col-sm-2 control-label">Jumlah</label>
      <div class="col-sm-2">
        <select class="form-control" name="jumlah">
         <?php 
            $no = 0;
            while($no <= 100){
          ?>
              <option value="<?php echo $no;?>"><?php echo $no;?></option>
          <?php
              $no++;
            }
          ?>
        </select>
      </div>
  </div>
   </div>
      <div class="form-group">
        <div class="col-lg-offset-2 col-lg-10">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </form>

<?php
  if(isset($k_surat)){
?>
  <div class="col-md-12">
    <?php 
      if(isset($alert)){
    ?>
      <h1 align="center"><?php echo $alert;?></h1>
    <?php 
      }
    ?>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>No.</th>
          <th>Kode Barang </th>
          <th>Quantity</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        $result = mysql_query("SELECT * FROM permintaan_barang_detail WHERE kode_surat = '$k_surat'");

        while($row = mysql_fetch_array($result))
          {
        ?>
        <tr>
          <td><?php echo $no; ?>.</td>
          <td><?php echo $row[1]?></td>
          <td><?php echo $row[2]?></td>
          <td><a onclick="return confirm('Hapus Data Ini ?')" href="index.php?hapus=<?php echo $row[0]; ?>&kode_barang=<?php echo $row['kode_barang']; ?>"class="btn btn-danger">Delete</a></td>
        </tr>
        <?php
          $no++;
          }
        ?>
      </tbody>
    </table>
      <div class="row">
        <div class="col-md-3">Bagian Penjualan <textarea class="form-control" rows="3"></textarea> </div>
        <div class="col-md-6"></div>
        <div class="col-md-3">Bagian Gudang <textarea class="form-control" rows="3"></textarea> </div>
      </div>
      <center><button onClick="return window.print();" class="btn btn-default">Print</button></center>
                <a href="index.php" class="btn btn-default">Finish</a>
      
</div><!-- end main -->
<?php 
  }
?>
<?php require_once("../templates/footer.php"); ?>