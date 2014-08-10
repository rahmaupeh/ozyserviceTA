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
  if(!isset($_GET["dari_tgl"])){
     //echo "SELECT * FROM transaksi";
     //echo "SELECT * FROM faktur WHERE kode_transaksi=''";
    //echo "SELECT * FROM faktur JOIN transaksi ON (faktur.kode_transaksi = transaksi.kode_transaksi)";
?>

<center><h4 class="page-header"></i> Laporan Penerimaan Kas</h4></center>
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
            <button class="btn btn-default" type="submit">View</button>
          </span>
</form>
        </div>

<?php
  }else {
    
   
    //$surat = "SELECT surat_penagihan.no_surat_penagihan,surat_penagihan_detail.kode_faktur,pelanggan.nama_pelanggan,pelanggan.toko,transaksi.total_harga, tanggal_pesan 
    //FROM surat_penagihan JOIN surat_penagihan_detail ON (surat_penagihan.no_surat_penagihan = surat_penagihan_detail.no_surat_penagihan) JOIN faktur ON (surat_penagihan_detail.kode_faktur = faktur.kode_faktur)
    // JOIN transaksi ON (faktur.kode_transaksi = transaksi.kode_transaksi) 
    // JOIN pelanggan ON (transaksi.id_pelanggan = pelanggan.id_pelanggan) WHERE surat_penagihan_detail.kode_faktur = '$no_penagihan' LIMIT 1";
    $tg = $_GET["dari_tgl"];
      $tg2 = $_GET["sampai_tgl"];
//new id

    $result = mysql_query("SELECT * FROM penjualan JOIN transaksi ON (penjualan.kode_transaksi = transaksi.kode_transaksi) WHERE transaksi.tanggal_lunas >= '$tg' AND transaksi.tanggal_lunas <= '$tg2'");
    // echo "SELECT * FROM penjualan JOIN transaksi ON (penjualan.kode_transaksi = transaksi.kode_transaksi) WHERE transaksi.tanggal_lunas >= '$date' AND transaksi.tanggal_lunas <= '$newdate'";
      //echo "SELECT * FROM faktur JOIN transaksi ON (faktur.kode_transaksi = transaksi.kode_transaksi) WHERE transaksi.tanggal_lunas >= '$tg' AND transaksi.tanggal_lunas >= '$tg2'";
      
      $found = mysql_num_rows($result);
      if($found != 0 ){
    ?>


<!-- tabel untuk menampilkan seluruh laporan per 1 minggu -->
        <?php
        $no = 1;
        $total=0;
        while($row = mysql_fetch_array($result))
          {
        ?>
          <?php
            if($row['diskon']>=0){
              // echo "Rp ".number_format($row['diskon']); 
            } else {
              // echo "-";
            }
          ?></td> 
          <td><?php
            if($row['diskon']<0){
              // echo "Rp ".number_format($row['diskon']); 
            } else {
              // echo "-";
            }
          ?>

        <?php
          $total = $total + ($row['total_harga']-$row['diskon']);
          $no++;
          }
        }






//end id

  
?>

<center><h4 class="page-header"> Ozy Service</h4></center>
<center><h4 class="page-header"></i> Laporan Penerimaan Kas</h4></center>
  <div class="row">
  <div class="col-md-12">
    <form class="form-horizontal" role="form">
  <div class="form-group">
    <label for="input" class="col-sm-3 control-label">Periode <?php echo $tg;?> - <?php echo $tg2;?></label>
    <div class="col-sm-2">
     <!--<input type="text" class="form-control" id="input" value="<?php echo $tg;?> - <?php echo $tg2;?>" readonly="readonly">-->
    </div>
    <div class="col-sm-5">
    </div>
    </div>
   <form class="form-horizontal" role="form">
 </div>
  <div class="col-md-12">
  <blockquote>
  <p><div class="row">Laporan Penerimaan Kas</div>

<div class="row">Dari Penjualan Tunai :</div> 
<div class="row">Dari Penjualan Kredit : <?php echo "Rp ".number_format($total); ?></div>
<div class="row">Dari Pendapatan Jasa :</div>
</blockquote>
</div>
     
      <div class="row">
   
<?php
  }
?>
<?php require_once("../templates/footer.php"); ?>