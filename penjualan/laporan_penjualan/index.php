<?php 
$active = "Customer";
require_once("../../include/db.php");
require_once("../templates/header.php");
$dat_server = mktime(date("G"),date("i"),date("s"),date("n"),date("j"),date("Y"));
$tgl = date("Y-n-j",$dat_server);
$thn = date("Y",$dat_server);

if(!isset($_GET['cari'])){
  $_GET['cari'] = "";
} 
?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<h3 class="page-header"></i> Laporan Penjualan Toko</h3>
    <div class="row">
      <div class="col-lg-7">
      <?php if($_GET['dari_tgl'] != 0){
          $tg = $_GET["dari_tgl"];
          $tg2 = $_GET["sampai_tgl"];
          //$tg2 = date ( 'Y-m-j' , $tg2 );

          $tg = explode("-",$tg);
          $d = $tg[2];
          $m = $tg[1];
          $y = $tg[0];
          $m = $m +0;
          switch  ($m){
            case  1: $mi = "Januari";break;
            case  2: $mi = "Februari";break;
            case  3: $mi = "Maret";break;
            case  4: $mi = "April";break;
            case  5: $mi =  "Mei";break;
            case  6: $mi =  "Juni";break;
            case  7: $mi =  "Juli";break;
            case  8: $mi =  "Agustus";break;
            case  9: $mi =  "September";break;
            case  10: $mi =  "Oktober";break;
            case  11: $mi =  "November";break;
            case  12: $mi =  "Desember";break;
          }

          $tg2 = explode("-",$tg2);
          $d2 = $tg2[2];
          $m2 = $tg2[1];
          $y2 = $tg2[0];
          $m2 = $m2 +0;
          switch  ($m2){
            case  1: $mi2 = "Januari";break;
            case  2: $mi2 = "Februari";break;
            case  3: $mi2 = "Maret";break;
            case  4: $mi2 = "April";break;
            case  5: $mi2 =  "Mei";break;
            case  6: $mi2 =  "Juni";break;
            case  7: $mi2 =  "Juli";break;
            case  8: $mi2 =  "Agustus";break;
            case  9: $mi2 =  "September";break;
            case  10: $mi2 =  "Oktober";break;
            case  11: $mi2 =  "November";break;
            case  12: $mi2 =  "Desember";break;
          }


      ?>
        Laporan Penjualan Dari Tanggal <b><?php echo $d." ".$mi." ".$y;?></b> sampai dengan tanggal <b><?php echo $d2." ".$mi2." ".$y2;?></b>
      <?php } ?>
      </div>
        <div class="col-lg-3">
        <form class="form-inline" method="GET" action="index.php">
        <div class="input-group">
          Dari Tanggal :
          <input type="date" class="form-control" name="dari_tgl" value="<?php echo $_GET['dari_tgl']; ?>">
        </div>
        <div class="input-group">
          Sampai Tanggal :
          <input type="date" class="form-control" name="sampai_tgl" value="<?php echo $_GET['sampai_tgl']; ?>">
        </div>
          <span class="input-group-btn">
            <button class="btn btn-default" type="submit">Search</button>
          </span>

        </div><!-- /input-group -->
        </form>
      </div><!-- /.col-lg-6 -->
    </div><!-- /.row -->
  <div class="row">
  <div class="col-md-12">
    <hr/>
    <?php
      $cari = "";
      $tg = $_GET["dari_tgl"];
      $tg2 = $_GET["sampai_tgl"];
      //$tg2 = date ( 'Y-m-j' , $tg2 ); 

      $result = mysql_query("SELECT * FROM penjualan JOIN transaksi ON (penjualan.kode_transaksi = transaksi.kode_transaksi) WHERE transaksi.tanggal_lunas >= '$tg' AND transaksi.tanggal_lunas <= '$tg2'");
      //echo "SELECT * FROM faktur JOIN transaksi ON (faktur.kode_transaksi = transaksi.kode_transaksi) WHERE transaksi.tanggal_lunas >= '$tg' AND transaksi.tanggal_lunas >= '$tg2'";
      
      $found = mysql_num_rows($result);
      if($found != 0 ){
    ?>


<!-- tabel untuk menampilkan seluruh laporan per 1 minggu -->
    <table class="table table-hover">
      <thead>
        <tr>
          <th>No</th>
          <th>Kode faktur </th>
          <th>Tanggal Faktur </th>
          <th>Tanggal Pembayaran </th>
          <th>Total Pembelian </th>
          <th>Diskon</th>
          <th>Denda</th>
          <th>Total Pembayaran</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        $total=0;
        while($row = mysql_fetch_array($result))
          {
        ?>
        <tr>
          <td><?php echo $no; ?>.</td>
          <td><?php echo $row['kode_faktur']; ?></td>
          <td><?php echo $row['tanggal_pesan']; ?></td>
          <td><?php echo $row['tanggal_lunas']; ?></td>
          <td>Rp <?php echo number_format($row['total_harga']); ?></td>
          <td><?php
            if($row['diskon']>=0){
              echo "Rp ".number_format($row['diskon']); 
            } else {
              echo "-";
            }
          ?></td> 
          <td><?php
            if($row['diskon']<0){
              echo "Rp ".number_format($row['diskon']*-1); 
            } else {
              echo "-";
            }
          ?></td>
          <td><?php echo "Rp ".number_format($row['total_harga']-$row['diskon']); ?></td> 
         
        </tr>
        <?php
          $total = $total + ($row['total_harga']-$row['diskon']);
          $no++;
          }
        ?>
        <tr>
          <td colspan="7">Total</td>
          <td><?php echo "Rp ".number_format($total); ?></td>
        </tr>
      </tbody>
    </table>
    <?php } else {?>
      <h1 align="center">Not Found...!!!</h1>
    <?php } ?>
  </div>
  </div>
</div><!-- end main -->
<?php require_once("../templates/footer.php"); ?>