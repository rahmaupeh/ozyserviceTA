<?php 
$active = "Customer";
require_once("../../include/db.php");
require_once("../templates/header.php"); 
$dat_server = mktime(date("G"),date("i"),date("s"),date("n"),date("j"),date("Y"));
$tgl = date("Y-n-j",$dat_server);
$thn = date("Y",$dat_server);

?>



<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  <?php

if(isset($_GET["kode_transaksi"])){
  $kode_transaksi = $_GET["kode_transaksi"];
  $trans = mysql_num_rows(mysql_query("SELECT * FROM penjualan WHERE kode_transaksi = '$kode_transaksi'"));
  if($trans <= 0){
    $kd_brg = "SELECT * FROM penjualan ORDER BY kode_faktur DESC";
    $kd_brg = mysql_query($kd_brg);
    $vd_brg = mysql_fetch_row($kd_brg);
    $nd_brg = mysql_num_rows($kd_brg);

    if($nd_brg == 0 ){
      $no_id = "FKO".$thn."-0001";
    } else {
      $arr_id = explode("-", $vd_brg[0]);
      $new_id = $arr_id[1];
      $new_id = $new_id + 1;
      $count_id = strlen($new_id);

      while ($count_id < 4){
        $new_id = "0".$new_id;
        $count_id++;
      }
      $no_id = "FKO".$thn."-".$new_id;
    }
    if($kode_transaksi != ""){
      mysql_query("INSERT INTO `ozyservice`.`penjualan` (`kode_faktur`, `kode_transaksi`, `tanggal_jatuh_tempo`) VALUES ('$no_id', '$kode_transaksi', '0000-00-00')");
    }
  }
} else {
  $kode_transaksi = "";
}

if($kode_transaksi == ""){
?>
  <div class="form-group">
    <form action="index.php">
    <label for="inputkode_barang" class="col-lg-2 control-label">No Transaksi</label>
    <div class="col-lg-10">
      <select class="form-control" name="kode_transaksi">
          <option value=""> </option>
            <?php 
              $qtransaksi = "SELECT * FROM transaksi";
              $qktransaksi = mysql_query($qtransaksi);
              print_r($qktransaksi);
              while($transaksi = mysql_fetch_array($qktransaksi)){
                $c = mysql_num_rows(mysql_query("SELECT * FROM transaksi WHERE kode_transaksi='$transaksi[kode_transaksi]'"));
                if($c != 0){
            ?>
          <option value="<?php echo $transaksi["kode_transaksi"];?>"> <?php echo $transaksi["kode_transaksi"];?></option>
            <?php
                }
              }
            ?>
        </select>

    </div>
    <div class="col-lg-offset-2 col-lg-10">
          <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </form>
  </div>
<?php
}


$view = mysql_fetch_row(mysql_query("SELECT * FROM penjualan JOIN transaksi ON (penjualan.kode_transaksi= transaksi.kode_transaksi) JOIN pelanggan ON (transaksi.id_pelanggan = pelanggan.id_pelanggan) WHERE transaksi.kode_transaksi = '$kode_transaksi'"));
$nview = mysql_num_rows(mysql_query("SELECT * FROM penjualan JOIN transaksi ON (penjualan.kode_transaksi= transaksi.kode_transaksi) JOIN pelanggan ON (transaksi.id_pelanggan = pelanggan.id_pelanggan) WHERE transaksi.kode_transaksi = '$kode_transaksi'"));

//echo "SELECT * FROM faktur JOIN transaksi ON (faktur.kode_transaksi= transaksi.kode_transaksi) JOIN pelanggan ON (transaksi.id_pelanggan = pelanggan.id_pelanggan) WHERE transaksi.kode_transaksi = '$kode_transaksi'";
if($nview != 0){
?>
<center><h3 class="page-header">Faktur</h3></center>
  <h3><tr>Ozy Service</tr></h3>
  <h4><tr>Jalan Pematang Pasir no 121 Tanjung Mulia Hilir</tr></h4>
  <h4><tr>Telp 061-6614627</tr></h4>
  <div class="row">
  <div class="col-md-12">
    <form class="form-horizontal" role="form">
  <div class="form-group">
    <label for="input" class="col-sm-1 control-label">No Faktur:</label>
    <div class="col-sm-2">
      <input type="text" class="form-control" id="input" value="<?php echo $view[0];?>" readonly="readonly">
    </div>

    <div class="col-sm-5">
    </div>
    <label for="input" class="col-sm-1 control-label">Tanggal Faktur:</label>
    <div class="col-sm-3">
       <input type="date" class="form-control" id="input"  value="<?php echo $view[5];?>" readonly="readonly">
    </div>
  </div>


  <form class="form-horizontal" role="form">
  <div class="form-group">
    <label for="input" class="col-sm-1 control-label">Customer:</label>
    <div class="col-sm-2">
      <input type="text" class="form-control" id="input" value="<?php echo $view[10];?>" readonly="readonly">
    </div>
  <div class="col-sm-5">
    </div>
    <label for="input" class="col-sm-1 control-label">Jatuh Tempo:</label>
    <div class="col-sm-3">
  <?php
    $date=$view[5];
    //echo $date;
    $new_date = date('Y-m-j',strtotime('+30 day', strtotime($date)));
    $tg = explode("-",$new_date);
    $d = $tg[2];
    $m = $tg[1];
    $y = $tg[0];
    $dn = strlen($d);
    $dm = strlen($m);
    
    if($dn == 1){
      $d = "0".$d;
    }
    if($dm == 1){
      $m = "0".$m;
    }
    $new_date = $y."-".$m."-".$d;
    mysql_query("UPDATE  `ozyservice`.`penjualan` SET  `tanggal_jatuh_tempo` =  '$new_date' WHERE  `penjualan`.`kode_faktur` =  '$view[0]'");
    //echo "UPDATE  `ozyservice`.`faktur` SET  `tanggal_jatuh_tempo` =  '$new_date' WHERE  `faktur`.`kode_faktur` =  '$view[0]'";
  ?>
      <input type="date" class="form-control" id="input" placeholder="2/10n/30"  value="<?php echo $new_date;?>" readonly="readonly">
    
</div>
<div class="form-group">
    <div class="col-sm-2"></div>
    <div class="col-sm-5"></div>
    <div class="col-sm-3"></div>
  </div>

  <form class="form-horizontal" role="form">
  <div class="form-group">
    <label for="input" class="col-sm-1 control-label">Alamat:</label>
    <div class="col-sm-2">
      <input type="text" class="form-control" id="input" value="<?php echo $view[12];?>" readonly="readonly">
    </div>
  <div class="col-sm-5">
    </div>
    <label for="input" class="col-sm-1 control-label">Syarat Pembayaran:</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" id="input"  value="2/10n/30" readonly="readonly">
    </div>
  </div>


  
  </div>
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

        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        $result = mysql_query("SELECT * FROM detail_penjualan JOIN data_barang ON (detail_penjualan.kode_barang=data_barang.kode_barang) WHERE kode_transaksi = '$kode_transaksi'");
        $total = 0;
        while($row = mysql_fetch_array($result))
          {
        ?>
        <tr>
          <td><?php echo $no; ?>.</td>
          <td><?php echo $row['kode_barang']; ?></td>
          <td><?php echo $row['nama_barang']; ?></td>
          <td><?php echo $row['jumlah']; ?></td> 
          <td>Rp <?php echo number_format($row['harga']); ?></td>
          <td><?php echo $row['diskon']; ?>%</td>
          <td>Rp <?php echo number_format(($row['jumlah']*$row['harga'])-($row['jumlah']*$row['harga']*$row['diskon']/100)); ?></td> 
        </tr>
        <?php
          $total = $total + ($row['jumlah']*$row['harga'])-($row['jumlah']*$row['harga']*$row['diskon']/100);
          $no++;
          }
        ?>
      </tbody>
    </table>
    <div class="row">
    <div class="col-md-12">
    <div class="col-md-8">
    </div>
    <form class="form-horizontal" role="form">
  
  </div>
  <div class="col-md-12">
    <div class="col-md-8">
    </div>
    <form class="form-horizontal" role="form">
  <div class="form-group">
    <label for="input" class="col-sm-2 control-label">Total :</label>
    <div class="col-sm-2">
      <input type="text" class="form-control" id="input"  value="Rp <?php echo number_format($total);?>" readonly="readonly">
    </div>
  </div>
  </div>
  </div>
 <div class="form-group"> </div>
  <div class="form-group"> </div>

   <div class="row">
        <div class="col-md-3">Diterima Oleh <textarea class="form-control" rows="3"></textarea> </div>
        <div class="col-md-6"></div>
        <div class="col-md-3">Bagian Penjualan <textarea class="form-control" rows="3"></textarea> </div>
      </div>
      <center><button onClick="return window.print();" class="btn btn-default">Print</button></center>
      
  </div>
</div><!-- end main -->

<?php require_once("../templates/footer.php"); ?>
<?php }?>