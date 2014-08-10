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
  if(!isset($_GET["no_penagihan"])){
     //echo "SELECT * FROM transaksi";
     //echo "SELECT * FROM faktur WHERE kode_transaksi=''";
    //echo "SELECT * FROM faktur JOIN transaksi ON (faktur.kode_transaksi = transaksi.kode_transaksi)";
?>

<center><h4 class="page-header"></i> Surat Penagihan</h4></center>
<div class="form-group">
    <form action="index.php">
    <label for="inputkode_barang" class="col-lg-2 control-label">No Faktur</label>
    <div class="col-lg-10">
      <select class="form-control" name="no_penagihan">
          <option value=""> </option>
            <?php 
              $qtransaksi = "SELECT * FROM penjualan JOIN transaksi ON (penjualan.kode_transaksi = transaksi.kode_transaksi)";;

              $qtransaksi = mysql_query($qtransaksi);
              while($row = mysql_fetch_array($qtransaksi)){
                  $tgl_awal = $row['tanggal_pesan'];
                  $tgl_akhir = $tgl;
                  //echo $tgl_awal;
                  //echo $tgl_akhir;

                  $pecah1 = explode("-", $tgl_awal);
                  $date1 = $pecah1[2];
                  $mount1 = $pecah1[1];
                  $year1 = $pecah1[0];

                  $pecah2 = explode("-", $tgl_akhir);
                  $date2 = $pecah2[2];
                  $mount2 = $pecah2[1];
                  $year2 = $pecah2[0]; 

                  $jd1 = GregorianToJD($mount1, $date1, $year1);
                  $jd2 = GregorianToJD($mount2, $date2, $year2);
                  //echo $jd1." ".$jd2." ";
                  $selisih = $jd2 - $jd1;
                  //echo $selisih;
                  if($selisih >= 30){
               
            ?>
                  <option value="<?php echo $row[0];?>"> <?php echo $row[0];?></option>
            <?php
                  }
              }
            ?>
        </select>

    </div>
    <div class="col-lg-offset-2 col-lg-10">
          <button type="submit" class="btn btn-primary">Submit</button>
          <a href="buat_surat.php" class="btn btn-success">Buat Surat Penagihan</a>
    </div>
  </form>
  </div>

<?php
  }else {
    $no_penagihan = $_GET["no_penagihan"];
    //$surat = "SELECT surat_penagihan.no_surat_penagihan,surat_penagihan_detail.kode_faktur,pelanggan.nama_pelanggan,pelanggan.toko,transaksi.total_harga, tanggal_pesan 
    //FROM surat_penagihan JOIN surat_penagihan_detail ON (surat_penagihan.no_surat_penagihan = surat_penagihan_detail.no_surat_penagihan) JOIN faktur ON (surat_penagihan_detail.kode_faktur = faktur.kode_faktur)
    // JOIN transaksi ON (faktur.kode_transaksi = transaksi.kode_transaksi) 
    // JOIN pelanggan ON (transaksi.id_pelanggan = pelanggan.id_pelanggan) WHERE surat_penagihan_detail.kode_faktur = '$no_penagihan' LIMIT 1";
    $surat = "SELECT surat_penagihan.no_surat_penagihan,surat_penagihan_detail.kode_faktur,pelanggan.nama_pelanggan,pelanggan.toko,transaksi.total_harga, tanggal_pesan 
    FROM surat_penagihan JOIN surat_penagihan_detail ON (surat_penagihan.no_surat_penagihan = surat_penagihan_detail.no_surat_penagihan) JOIN penjualan ON (surat_penagihan_detail.kode_faktur = penjualan.kode_faktur)
     JOIN transaksi ON (penjualan.kode_transaksi = transaksi.kode_transaksi) 
     JOIN pelanggan ON (transaksi.id_pelanggan = pelanggan.id_pelanggan) WHERE surat_penagihan_detail.kode_faktur = '$no_penagihan' LIMIT 1";
    
    //echo $surat;
    $surat = mysql_fetch_row(mysql_query($surat));
    //DATE_FORMAT($surat[5],'%d %b %y');
    $tg = explode("-",$surat[5]);
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
?>

<center><h4 class="page-header"></i> Surat Penagihan</h4></center>
  <div class="row">
  <div class="col-md-12">
    <form class="form-horizontal" role="form">
  <div class="form-group">
    <label for="input" class="col-sm-1 control-label">No Penagihan:</label>
    <div class="col-sm-2">
     <input type="text" class="form-control" id="input" value="<?php echo $surat[0];?>" readonly="readonly">
    </div>
    <div class="col-sm-5">
    </div>
    </div>
   <form class="form-horizontal" role="form">
  <div class="form-group">
    <label for="input" class="col-sm-1 control-label">No Faktur: </label>
    <div class="col-sm-2">
      <input type="text" class="form-control" id="input" value="<?php echo $surat[1];?>" readonly="readonly">
    </div>
  <div class="col-sm-5">
    </div>
    </div>
   <form class="form-horizontal" role="form">
  <div class="form-group">
    <label for="input" class="col-sm-1 control-label">Nama:</label>
    <div class="col-sm-2">
      <input type="text" class="form-control" id="input"  value="<?php echo $surat[2];?>" readonly="readonly">
    </div>
  </div>
  <form class="form-horizontal" role="form">
  <div class="form-group">
    <label for="input" class="col-sm-1 control-label">Nama Toko :</label>
    <div class="col-sm-2">
      <input type="text" class="form-control" id="input"  value="<?php echo $surat[3];?>" readonly="readonly">
    </div>
  </div>
  <form class="form-horizontal" role="form">
</div>
  <div class="col-md-12">
  <blockquote>
  <p><div class="row">Dengan hormat,</div>

<div class="row">Bersama surat ini kami beritahukan kepada anda, bahwa menurut pembukuan kami, Anda masih menunggak pembayaran.</div> <div class="row">Adapun perinciannya adalah sebagai berikut:
</div>
<?php
  //echo "SELECT * FROM surat_penagihan_detail JOIN faktur ON (surat_penagihan_detail.kode_faktur = faktur.kode_faktur) JOIN transaksi ON (faktur.kode_transaksi=transaksi.kode_transaksi)
   //WHERE no_surat_penagihan = '$surat[0]'";
  $qsur = mysql_query("SELECT * FROM surat_penagihan_detail JOIN penjualan ON (surat_penagihan_detail.kode_faktur = penjualan.kode_faktur) JOIN transaksi ON (penjualan.kode_transaksi=transaksi.kode_transaksi)
   WHERE no_surat_penagihan = '$surat[0]'");

  while($sur=mysql_fetch_array($qsur)){
    $tg = explode("-",$sur[7]);
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
?>
- faktur nomor <?php echo $sur[1];?> tanggal <?php echo $d." ".$mi." ".$y;?> Rp <?php echo number_format($sur[10]);?>,-</br>
<?php
  }
?>
(Faktur terlampir)

<div class="row">Kami harap anda dapat segera menyelesaikan kewajiban tersebut di atas melalui transfer ke rekening kami atas nama Ozy Service.</div>

<div class="row">Demikian pemberitahuan ini kami sampaikan, atas perhatian dan kerjasamanya kami ucapkan terima kasih</p></div>
</blockquote>
</div>
      <div class="row">
        <div class="col-md-3">Hormat Kami <textarea class="form-control" rows="3"></textarea> </div>
        </div>
      <div class="row">
      Ozy Service
       <center><button onClick="return window.print();" class="btn btn-default">Print</button></center><!-- end main -->

<?php
  }
?>
<?php require_once("../templates/footer.php"); ?>